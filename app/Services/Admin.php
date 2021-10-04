<?php

namespace App\Service;

class Admin
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    public function appKey()
    {
        return $this->apiKey;
    }
}
