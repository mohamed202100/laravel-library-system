<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Reservation;

class PaymentController extends Controller
{
    public function checkout(Reservation $reservation)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $reservation->book->title,
                    ],
                    'unit_amount' => $reservation->book->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', $reservation),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success(Reservation $reservation)
    {
        $reservation->update(['status' => 'paid']);
        return redirect()->route('reservations.my')->with('status', 'تم الدفع بنجاح!');
    }

    public function cancel()
    {
        return redirect()->route('reservations.my')->with('error', 'تم إلغاء عملية الدفع.');
    }
}
