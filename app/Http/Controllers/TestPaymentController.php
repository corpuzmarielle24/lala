<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class TestPaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        // For testing purposes - simulate successful payment
        // In production, this should integrate with real payment gateway
        
        $subscription = new Subscription;
        $subscription->amount = $request->input('amount');
        $subscription->subscription_type = $request->input('subscription_type');
        $subscription->date = today();
        $subscription->user_id = auth()->user()->id;
        $subscription->save();

        // Reset user's generation limits
        DB::table('users')
            ->where('id', auth()->user()->id)
            ->update([
                'generate_no' => 0,
                'generate_date' => null,
            ]);

        return redirect('/')->with('success', 'Successfully Subscribed! (Test Mode)');
    }
}
