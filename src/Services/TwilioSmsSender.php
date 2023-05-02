<?php 
// src/Service/TwilioSmsSender.php

namespace App\Service;

use Twilio\Rest\Client;
use Twilio\Http\CurlClient;

class TwilioSmsSender
{
    private $client;
    private $twilioPhoneNumber;

    public function __construct(string $accountSid, string $authToken, string $twilioPhoneNumber)
    {
        $client = new Client($accountSid, $authToken);
        $client->setHttpClient(new CurlClient([
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]));
        $this->client = $client;
        $this->twilioPhoneNumber = $twilioPhoneNumber;
    }

    public function sendSms(string $recipientPhoneNumber, string $message): void
    {
        $this->client->messages->create(
            $recipientPhoneNumber,
            [
                'from' => $this->twilioPhoneNumber,
                'body' => $message,
            ]
        );
    }
}
