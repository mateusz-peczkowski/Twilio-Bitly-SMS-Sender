<?php

namespace App\Controllers;

use PHPLicengine\Api\Api;
use PHPLicengine\Service\Bitlink;

class BitlyController
{
    private $api;
    private $bitlink;

    public function __construct($accessToken) {
      $this->api = new Api($accessToken);
      $this->bitlink = new Bitlink($this->api);
    }

    /**
     * Prepare Bitly shorten link
     */
    public function prepareLink($link)
    {
      if (!getenv('BITLY_ENABLED'))
        return $link;

      $resultLink = $this->bitlink->createBitlink(['long_url' => $link]);

      if ($this->api->isCurlError()) // if cURL error occurs
        return [
          'status' => $this->api->getCurlErrno(),
          'description' => $this->api->getCurlError(),
        ];

      if ($resultLink->isSuccess()) // if Bitly response is 200 or 201
        return $resultLink->getResponseArray()['link'];

      return [
        'status' => $resultLink->getResponse(),
        'description' => $resultLink->getDescription(),
      ];
    }
}
