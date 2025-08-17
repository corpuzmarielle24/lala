<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class PayPalController extends Controller
{
    public function createPayment(Request $request)
    {
        // Create PayPal client and set credentials
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // Create an order
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "PHP",
                        "value" => $request->input('amount'), // Use dynamic amount
                    ]
                ]
            ]
        ]);

        // Check if the payment creation was successful
        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    // Store necessary information in session
                    session(['paypal_order_id' => $response['id'], 'amount' => $request->input('amount'), 'subscription_type' => $request->input('subscription_type')]);
                    return redirect($link['href']);
                }
            }
        }

        return redirect('/')->with('error', 'Subscription Not Successful. Please Try Again!');
    }

    public function executePayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // Capture the payment
        $response = $provider->capturePaymentOrder(session('paypal_order_id'));

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            // Payment successful, save subscription to database
            $table = new Subscription;
            $table->amount = session('amount'); // Get the amount from session
            $table->subscription_type = session('subscription_type'); // Get the subscription type from session
            $table->date = today();
            $table->user_id = auth()->user()->id;
            $table->save();


DB::table('users')
    ->where('id', auth()->user()->id)
    ->update([
        'generate_no' => 0,
        'generate_date' => null,
    ]);
            // Clear session data
            session()->forget(['paypal_order_id', 'amount', 'subscription_type']);

            return redirect('/')->with('success', 'Successfully Subscribed!');
        }

        return redirect('/')->with('error', 'Unable to create PayPal order. Please try again.');
    }

    public function cancelPayment()
    {
        return redirect('/')->with('error', 'Payment was canceled. Please try again.');
    }
}
