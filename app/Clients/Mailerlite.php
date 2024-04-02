<?php

namespace App\Clients;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MailerLite
{
    public static function addSubscriber($email)
    {
        // Add subscriber to MailerLite

        try {
            $response = Http::withToken(config('mail.mailerlite.api_key'))->post('https://connect.mailerlite.com/api/subscribers', [
                'email' => $email,
            ]);

            if (($response->status() <= 299) && ($response->status() >= 200)) {
                Log::info('success!');
                return true;
            }

            Log::error('Failed to add subscriber to MailerLite: ' . $response->status());
            return false;
        } catch (Exception $e) {
            Log::error('Failed to add subscriber to MailerLite: ' . $e->getMessage());
            return false;
        }
    }
}