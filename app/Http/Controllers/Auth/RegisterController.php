<?php

namespace App\Http\Controllers\Auth;

use App\Models\QuizHistory;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Notifications\NewUserRegisteredNotification;
use App\Services\AdminNotifications;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    protected $redirectTo = '/profile';
    protected $quizResults;
    protected $activityAnswers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function register(Request $request)
    {
        $this->quizResults = $request->input('quiz-results');
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        /*
         * After registration (but BEFORE auth) we take user's session id.
         * And relate his answer from History with userId
         */
        $sessionIdBefore = request()->session()->getId();
        $this->activityAnswers = QuizHistory::where('session', $sessionIdBefore)->get();
        foreach($this->activityAnswers as $item) {
            $item->user = $user->id;
            $item->save();
        }

        //notify about new user registration
        $this->notifyAdmin($user);

        $this->guard()->login($user);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }



    public function redirectTo()
    {
        //if used passed Quiz , he has results in special input on the registartion page
        if ($this->quizResults) {
            $attribures = [];
            parse_str($this->quizResults, $attribures);
            return route('quiz-results', $attribures);
        }

        return route('profile.products');
    }

    protected function notifyAdmin($newUser)
    {
        //we have to transfer activityAnswers and quizResults, because user has not logged in yet and search hasn't applied
        //=>
        //user's info still empty. we need take data fron session.
        $attribures = [];
        parse_str($this->quizResults, $attribures);
        try {
            AdminNotifications::AdminNotify(new NewUserRegisteredNotification($newUser, $this->activityAnswers,
                $attribures));
        } catch (Exception $exception) {

        }
    }
}
