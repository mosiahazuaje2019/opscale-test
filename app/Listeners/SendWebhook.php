<?php

namespace App\Listeners;

use App\Models\Webhook;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookServer\WebhookCall;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWebhook
{
    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $webhooks = Webhook::all();

        foreach ($webhooks as $webhook) {

            if (!$webhook) {
                Log::error('Webhook not found.');
                return;
            }
    
            // Log the raw headers to debug
            Log::info('Raw headers: ' . $webhook->headers);
    
            $headers = json_decode($webhook->headers, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Error decoding JSON: ' . json_last_error_msg());
                return;
            }
    
            if (!is_array($headers)) {
                Log::error('Decoded headers are not an array.');
                return;
            }

            WebhookCall::create()
                ->url($webhook->url)
                ->useHttpVerb($webhook->http_verb)
                ->withHeaders($headers)
                ->payload(['user' => $event->user])
                ->useSecret(env('WEBHOOK_SECRET'))
                ->dispatch();

            Log::info('Webhook dispatched to URL: ' . $webhook->url);
        }
    }
}
