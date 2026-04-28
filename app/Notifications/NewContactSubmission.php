<?php

namespace App\Notifications;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactSubmission extends Notification
{
    use Queueable;

    public function __construct(public ContactSubmission $submission) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $s = $this->submission;
        $interest = match($s->interest) {
            'voice_otp' => 'Voice OTP',
            'voice_survey' => 'Surveys',
            'voice_broadcast' => 'Broadcast',
            default => 'Other',
        };

        $cmsUrl = config('app.url').'/admin/contact-submissions/'.$s->id;

        return (new MailMessage)
            ->subject("[Protiddhoni] New {$interest} lead — {$s->name}")
            ->greeting("New contact submission")
            ->line("**From:** {$s->name} ({$s->email})")
            ->line("**Company:** ".($s->company ?: '—'))
            ->line("**Phone:** ".($s->phone ?: '—'))
            ->line("**Industry:** ".($s->industry ?: '—'))
            ->line("**Volume:** ".($s->expected_volume ?: '—'))
            ->line("**Interest:** {$interest}")
            ->line("**Message:**")
            ->line($s->message ?: '(no message)')
            ->action('Open in CMS', $cmsUrl);
    }
}
