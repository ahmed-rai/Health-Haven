<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class NotificationServer
{
    private $httpClient;
    private $socketServerUrl;

    public function __construct(string $socketServerUrl)
    {
        $this->httpClient = HttpClient::create();
        $this->socketServerUrl = $socketServerUrl;
    }

    public function sendNotification(array $payload): bool
    {
        try {
            $response = $this->httpClient->request('POST', $this->socketServerUrl . '/send-notification', [
                'json' => [
                    'payload' => $payload,
                ],
            ]);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            return false;
        }
    }
}
