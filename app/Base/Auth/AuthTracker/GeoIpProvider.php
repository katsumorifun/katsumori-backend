<?php

namespace App\Base\Auth\AuthTracker;

use ALajusticia\AuthTracker\Interfaces\IpProvider;
use ALajusticia\AuthTracker\Traits\MakesApiCalls;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Support\Facades\Request;

class GeoIpProvider implements IpProvider
{
    use MakesApiCalls;

    /**
     * @var object|null
     */
    protected $result;

    public function __construct()
    {
        $this->result = geoip(\request()->getClientIp());
    }

    /**
     * Get the Guzzle request.
     *
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getRequest(): GuzzleRequest
    {
        return new GuzzleRequest('GET', '/');
    }

    /**
     * Get the country name.
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->result->country;
    }

    /**
     * Get the region name.
     *
     * @return string
     */
    public function getRegion(): string
    {
        return $this->result->country;
    }

    /**
     * Get the city name.
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->result->city;
    }
}
