<?php

namespace App\Notifications;

use App\Models\Resume;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResumeCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Resume $resume
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Resume Created Successfully! 🎉')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your resume "' . $this->resume->title . '" has been created successfully.')
            ->line('You can now view, edit, and optimize your resume using our AI-powered features.')
            ->action('View Resume', route('resumes.show', $this->resume->id))
            ->line('Thank you for using our AI Resume Builder!')
            ->salutation('Best regards, The Resume Builder Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'resume_id' => $this->resume->id,
            'resume_title' => $this->resume->title,
            'message' => 'Resume "' . $this->resume->title . '" created successfully',
        ];
    }
}
