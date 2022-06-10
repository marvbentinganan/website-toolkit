<?php

namespace App\Services\Datadog;

use Illuminate\Support\Facades\Http;

class Datadog
{
    /**
     * The Datadog Http Client.
     *
     * @var object
     */
    protected $client;

    public function __construct()
    {
        $this->client = Http::acceptJson()
        ->withHeaders(
            [
                'DD-API-KEY' => config('services.datadog.apikey'),
                'DD-APPLICATION-KEY' => config('services.datadog.appkey'),
            ]
        );
    }

    /**
     * Get list of hosts from Datadog.
     *
     * @return Response
     */
    public function getInfrastructure()
    {
        return $this->client->get('https://app.datadoghq.com/api/v1/hosts')->object();
    }

    /**
     * Get all logs.
     */
    public function getLogsQueriesList($query = [])
    {
        return $this->client->post('https://api.datadoghq.com/api/v1/logs-queries/list', $query)->object();
    }
}
