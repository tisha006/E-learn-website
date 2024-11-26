<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Reg;
use App\Mail\ReminderEmail;

class SubscriptionController extends Controller
{
    public function checkAndSendReminder()
    {
        // Define the threshold for sending the reminder
        $reminderThreshold = Carbon::now()->addMinutes(1);

        // Get users with an expiration date within the threshold
        $users = Reg::where('expiration_date', '<=', $reminderThreshold)
                    ->where('reminder_sent', 0)
                    ->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new ReminderEmail($user));
            $user->reminder_sent = 1;
            $user->save();
        }

        return response()->json(['status' => 'Reminder emails sent if needed']);
    }
}
