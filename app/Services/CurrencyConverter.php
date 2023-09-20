<?php

namespace App\Services;
class CurrencyConverter
{
    private $apiKey;
    protected $baseUrl = 'https://free.currconv.com/api/v7';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
public function convert(string $from, string $to, float $amount = 1)
    {

    }
}