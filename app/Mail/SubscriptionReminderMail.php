<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $plan_name;
    public $expiration_date;

    public function __construct($plan_name, $expiration_date)
    {
        $this->plan_name = $plan_name;
        $this->expiration_date = $expiration_date;
    }

    public function build()
    {
        return $this->subject('Subscription Reminder')
                    ->view('emails.subscription_reminder'); // Create this view
    }
}
