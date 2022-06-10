<?php

namespace App\Services\Forge;

use Illuminate\Support\Facades\Http;

class LaravelForge
{
    protected $client;

    public function __construct()
    {
        $this->client = Http::acceptJson()
        ->withHeaders(
            [
                'Authorization' => sprintf('%s %s', 'Bearer', config('services.forge.key'))
            ]
        );
    }

    /**
     * Get a Lis of Servers from Laravel Forge
     *
     * @return void
     */
    public function getServers()
    {
        return $this->client->get('https://forge.laravel.com/api/v1/servers')->object();
    }

    /**
     * Get Server Details from Laravel Forge
     *
     * @param integer $serverID
     * @return void
     */
    public function getServer(int $serverID)
    {
        return $this->client->get("https://forge.laravel.com/api/v1/servers/{$serverID}")->object();
    }

    /**
     * Get Firewall Rules for Server
     *
     * @param integer $serverID
     * @return void
     */
    public function getFirewallRules(int $serverID)
    {
        return $this->client->get("https://forge.laravel.com/api/v1/servers/{$serverID}/firewall-rules")->object();
    }

    /**
     * Get Daemons running on the server
     *
     * @param integer $serverID
     * @return void
     */
    public function getDaemons(int $serverID)
    {
        return $this->client->get("https://forge.laravel.com/api/v1/servers/{$serverID}/daemons")->object();
    }

    /**
     * Get Scheduled Jobs on the Server
     *
     * @param integer $serverID
     * @return void
     */
    public function getScheduledJobs(int $serverID)
    {
        return $this->client->get("https://forge.laravel.com/api/v1/servers/{$serverID}/jobs")->object();
    }

    /**
     * Get List of Databases on the Server
     *
     * @param integer $serverID
     * @return void
     */
    public function getDatabases(int $serverID)
    {
        return $this->client->get("https://forge.laravel.com/api/v1/servers/{$serverID}/databases")->object();
    }

    /**
     * Get Websites from the Server
     *
     * @param integer $serverID
     * @return void
     */
    public function getSites(int $serverID)
    {
        return $this->client->get("https://forge.laravel.com/api/v1/servers/{$serverID}/sites")->object();
    }
}
