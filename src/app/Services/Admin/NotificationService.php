<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function notifyUser(User $user, string $role, bool $isNew): void
    {
        if ($isNew) {
            $message = "Welcome! You have been assigned the role of {$role}. Your temporary password is: {$user->temporary_password}";
        } else {
            $message = "You have been assigned the role of {$role}.";
        }

        Mail::raw($message, function ($mail) use ($user) {
            $mail->to($user->email)
                ->subject('Account Information');
        });
    }
}
