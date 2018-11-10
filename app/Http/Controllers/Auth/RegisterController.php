<?php

namespace App\Http\Controllers\Auth;

use App\Models\QuizHistory;
use App\Models\User;
use App\Http\Controllers\Controller;
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
         * Changed block. We keep previous session token tu current user
         */
        $sessionIdBefore = request()->session()->getId();
        foreach(QuizHistory::where('session', $sessionIdBefore)->get() as $item) {
            $item->user = $user->id;
            $item->save();
        }
        ///////////////////// end

        $this->guard()->login($user);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
//            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
//            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }



    public function redirectTo()
    {
        //if used passed QUiz, he has results in special input on the registartion page
        if ($this->quizResults) {
            $attribures = [];
            parse_str($this->quizResults, $attribures);
            return route('quiz-results', $attribures);
        }

        return route('profile.products');
    }
}
