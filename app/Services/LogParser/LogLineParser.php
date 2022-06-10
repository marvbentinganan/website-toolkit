<?php


namespace App\Services\LogParser;

use App\Services\LogParser\Models\DomainUrl;
use App\Services\LogParser\Models\HttpMethod;
use App\Services\LogParser\Models\HttpReferrer;
use App\Services\LogParser\Models\HttpResponse;
use App\Services\LogParser\Models\ImportWebServerLog;
use App\Services\LogParser\Models\IpAddress;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LogLineParser
{
    public $import;
    public $log;

    public function __construct(ImportWebServerLog $import)
    {
        $this->import = $import;
        $this->log = collect($import->data);
    }

    /**
     * Create Domain URL record and return ID
     *
     * @return Integer
     */
    public function getUrl()
    {
        // Remove Query Parameters
        $request = strtok($this->log['request'], '?');
        // Remove HTTP Method
        $url = Str::remove(['HTTP/1.0', 'HTTP/2.0'], substr(strstr($request, ' '), 1));

        $domain_url = DomainUrl::updateOrCreate(
            [
                'domain_id' => $this->import->domain_id,
                'url' => trim($url)
            ],
            [
                'domain_id' => $this->import->domain_id,
                'url' => trim($url)
            ]
        );

        return $domain_url->getKey();
    }

    /**
     * Create HTTP Method record and return ID
     *
     * @return Integer
     */
    public function getMethod()
    {
        // Get Method from Request
        $method = explode(' ', trim($this->log['request']))[0];

        $method_data = HttpMethod::firstOrCreate(
            [
                'name' => $method
            ]
        );

        return $method_data->getKey();
    }

    /**
     * Create Status Code record and return ID
     *
     * @return Integer
     */
    public function getStatusCode()
    {
        $status = HttpResponse::firstOrCreate(
            [
                'name' => $this->log['status']
            ]
        );

        return $status->getKey();
    }

    /**
     * Create IP Address record and return ID
     *
     * @return Integer
     */
    public function getIpAddress()
    {
        $ip = IpAddress::firstOrCreate(
            [
                'ip_address' => $this->log['host']
            ]
        );

        return $ip->getKey();
    }

    /**
     * Return Bytes Sent
     *
     * @return Integer
     */
    public function getBytes()
    {
        return $this->log['sentBytes'];
    }

    public function getTimeStamp()
    {
        return Carbon::parse($this->log['time'])->toDateTimeString();
    }

    public function getReferrer()
    {
        $referrer = HttpReferrer::firstOrCreate(
            [
                'name' => $this->log['HeaderReferer']
            ]
        );

        return $referrer->getKey();
    }
}
