<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserRegisteredNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $newUser;
    protected $activityAnswers;
    protected $quizResults;

    public function __construct(User $user, $activityAnswers, $quizResults)
    {
        $this->newUser = $user;
        $this->activityAnswers = $activityAnswers;
        $this->quizResults = $quizResults;
//        dd('test2');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('"Experience this travel" - there is new user registered')
            ->view('mail.admin-new-user', [
                'user' => $this->newUser,
                'activityAnswers' => $this->activityAnswers,
                'quizResults' => $this->quizResults
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
