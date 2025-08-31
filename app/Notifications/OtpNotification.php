<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class OtpNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $otp;
    protected $channel; // sms or whatsapp

    public function __construct($otp, $channel = 'sms')
    {
        $this->otp = $otp;
        $this->channel = $channel;
    }

    public function via($notifiable)
    {
        return ['twilio'];
    }

    public function toTwilio($notifiable)
    {
        try {
            $twilio = new Client(
                env('TWILIO_SID'),
                env('TWILIO_AUTH_TOKEN')
            );

            $to = $this->channel === 'whatsapp'
                ? "whatsapp:{$notifiable->phone}"
                : $notifiable->phone;

            $from = $this->channel === 'whatsapp'
                ? env('TWILIO_WHATSAPP')
                : env('TWILIO_PHONE');

            $message = "Your OTP is {$this->otp}. It will expire in 10 minutes.";

            $response = $twilio->messages->create($to, [
                'from' => $from,
                'body' => $message
            ]);

            Log::info("Twilio SMS/WhatsApp sent", [
                'to' => $to,
                'from' => $from,
                'body' => $message,
                'sid' => $response->sid,
                'status' => $response->status,
            ]);

        } catch (\Exception $e) {
            Log::error("Twilio failed to send message", [
                'error' => $e->getMessage(),
                'phone' => $notifiable->phone,
                'channel' => $this->channel,
            ]);
        }
    }
}
