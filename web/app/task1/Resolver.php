<?php

class Resolver
{
    private $serverAddress;
    private $handler;

    public function __construct(string $serverAddress)
    {
        $this->serverAddress = $serverAddress;

        $handler = curl_init();

        if (!$handler) {
            throw new ResolvingException('Curl session can not be initialized');
        }

        $this->handler = $handler;
    }

    public function __destruct()
    {
        curl_close($this->handler);
    }

    public function resolve(string $ip): string
    {
        session_write_close();

        curl_setopt($this->handler, CURLOPT_RETURNTRANSFER, true);

        $url = "http://{$this->serverAddress}/task1/server.php?ip={$ip}";
        curl_setopt($this->handler, CURLOPT_URL, $url);

        $sessionId = session_id();
        curl_setopt($this->handler, CURLOPT_COOKIE, "PHPSESSID={$sessionId}");

        $curlResponse = curl_exec($this->handler);

        if (curl_errno($this->handler)) {
            throw new ResolvingException('It is not possible to resolve IP address');
        }

        $responseData = json_decode($curlResponse);

        return $this->prepareResult($responseData);
    }

    private function prepareResult(\stdClass $responseData): string
    {
        switch ($responseData->status) {
            case 'success':
                $cityName = !$responseData->isCached ?
                    $responseData->cityName :
                    "{$responseData->cityName} (Закэшированный результат)";
                break;
            case 'error':
            default:
                throw new ResolvingException('It is not possible to resolve IP address');
        }

        return $cityName;
    }
}
