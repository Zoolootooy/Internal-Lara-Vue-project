<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Notification;
use App\Models\Setting;

class NotificationService
{
    /**
     * @return mixed|null
     */
    public static function getAdminEmail()
    {
        return Setting::getValue('admin_email') ?? env('MAIL_FROM_ADDRESS');
    }

    /**
     * @param $mail
     * @return bool
     */
    public static function sendContactNotification($mail)
    {
        Notification::route('mail', static::getAdminEmail())
            ->notify(new ContactNotification($mail));

        return true;
    }
}
