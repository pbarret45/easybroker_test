<?php

namespace Src\Shared\Http;

use GuzzleHttp\Client;
use stdClass;

/** Clase que realiza las llamadas a las apis. */
class Http extends Client
{
    public function __construct(private string $host, private ?string $token)
    {
        $this->host = $host;
        $this->token = $token;
        parent::__construct();
    }

    /** Opciones de request creadas para el api.
     * @param  array $payload
     * @return array
     */
    private function getOptionRequest(array $payload): array
    {
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'json' => $payload
        ];
        if ($this->token !== null) {
            $options['headers']['X-Authorization'] = $this->token;
        }
        return $options;
    }

    /** Realiza una petición get al api.
     * @param  string $uri
     * @return mixed
     */
    public function getApi(string $uri): stdClass
    {
        $host = $this->host . $uri;
        $optionsRequest = $this->getOptionRequest([]);
        $response = $this->get($host, $optionsRequest);
        return json_decode($response->getBody());
    }
}
