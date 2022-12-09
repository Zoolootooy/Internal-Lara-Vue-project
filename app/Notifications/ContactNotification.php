<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactNotification extends Notification
{
    use Queueable;

    /**
     * @var
     */
    public $mail;

    /**
     * ContactNotification constructor.
     * @param $mail
     */
    public function __construct($mail)
    {
        if (empty($mail)) {
            throw new Exception(__('Empty email'));
        }

        $this->mail = $mail;
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
        $mail = $this->mail;
        $subject = __('New email from') . ' '
            . config('app.name')
            . (!empty($mail->subject) ? ': ' . $mail->subject : '');

        return (new MailMessage)
            ->from($mail->sender_email, $mail->sender_name)
            ->subject($subject)
            ->markdown('mail.contact', ['mail' => $mail]);

        /*return (new MailMessage)
            ->from($mail->sender_email, $mail->sender_name)
            ->subject($subject)
            ->greeting(__('Hello Admin'))
            ->line(__('You have received a new email:'))
            ->line(__('Email') . ': ' . ($mail->sender_email) ?? '-')
            ->line(__('Name') . ': ' . ($mail->sender_name) ?? '-')
            ->line(__('Subject') . ': ' . ($mail->subject) ?? '-')
            ->line(__('Body') . ': ' . ($mail->body) ?? '-')
            ->action(config('app.name'), url('/'));*/
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
            'mail' => $this->mail->toArray(),
        ];
    }
}
