<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class AnalyticsService
{
    public function track(string $event, array $payload = []): void
    {
        // MVP placeholder: log events. Replace with PostHog/Mixpanel/GA later.
        Log::info("Analytics event: {$event}", $payload);
    }
}
