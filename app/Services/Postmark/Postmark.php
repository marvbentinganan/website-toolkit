<?php


namespace App\Services\Postmark;

use Illuminate\Support\Facades\Http;

class Postmark
{
    /**
     *
     * @param int $count 500 is the max limit we can query from postmark
     * @param int $offset
     * @return object
     */
    public function getAccountsServers($count = 500, $offset = 0)
    {
        return Http::withHeaders([
            'X-Postmark-Account-Token' => env('POSTMARK_TOKEN'),
            'Accept' => 'application/json'
        ])->get('https://api.postmarkapp.com/servers', [
            'count' => $count,
            'offset' => $offset
        ])->object();
    }

    /**
     * @param $fromDate
     * @param $toDate
     * @param $serverToken
     * @param mixed $severId
     * @param mixed $token
     * @return object
     */
    public function getServerStats($fromDate, $toDate, $token)
    {
        $url = 'https://api.postmarkapp.com/stats/outbound';

        return Http::withHeaders([
            'X-Postmark-Server-Token' => $token,
            'Accept' => 'application/json'
        ])->get($url, [
            'fromdate' => $fromDate,
            'todate' => $toDate
        ])->object();
    }

    public function getServerApiToken($serverID)
    {
        $cacheKey = 'postmark.' . $serverID;

        if (cache()->has($cacheKey)) {
            return cache()->get($cacheKey);
        }

        $url = 'https://api.postmarkapp.com/servers/' . $serverID;
        $token = Http::withHeaders([
            'X-Postmark-Account-Token' => env('POSTMARK_TOKEN'),
            'Accept' => 'application/json'
        ])->get($url)->object()->ApiTokens[0];

        cache()->put($cacheKey, $token, now()->addDays(7));

        return $token;
    }
}
