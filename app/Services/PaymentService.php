<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function createCheckout(int $userId, string $plan): string
    {
        // MVP placeholder: simulate checkout; replace with Paddle/Dodo later.
        Log::info("PaymentService::createCheckout", compact('userId', 'plan'));
        return url('/pricing'); // or a thank-you page
    }
}
