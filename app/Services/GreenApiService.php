<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GreenApiService
{
    protected $idInstance;
    protected $apiTokenInstance;

    public function __construct()
    {
        $this->idInstance = env('GREEN_API_ID_INSTANCE');
        $this->apiTokenInstance = env('GREEN_API_TOKEN_INSTANCE');
    }

    public function sendMessage($phoneNumber, $message)
    {
        // Si no hay credenciales, no intentar enviar
        if (!$this->idInstance || !$this->apiTokenInstance) {
            return false;
        }

        // Formatear el número si es necesario
        // GreenAPI usa el formato <numero>@c.us
        // Si el número tiene 10 dígitos (ej. México), le añadimos '521'
        if (preg_match('/^\d{10}$/', $phoneNumber)) {
            $phoneNumber = '521' . $phoneNumber;
        }

        // Asegurarse de que el número no tenga signos especiales
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        $chatId = $phoneNumber . '@c.us';

        $url = "https://api.green-api.com/waInstance{$this->idInstance}/sendMessage/{$this->apiTokenInstance}";

        $response = Http::post($url, [
            'chatId' => $chatId,
            'message' => $message,
        ]);

        return $response->successful();
    }
}
