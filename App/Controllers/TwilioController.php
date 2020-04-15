<?php

namespace App\Controllers;

use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;

class TwilioController
{
    private $from;
    private $twilioClient;

    public function __construct($sid, $token, $from) {
      $this->twilioClient = new Client($sid, $token);
      $this->from = $from;
    }

    /**
     * Send Message function
     */
    public function sendMessage($list, $messageTxt)
    {
      $path = 'lists/' . $list . '.php';

      if (!file_exists($path))
        return 'List "' . $list . '" not exist<br />';

      $phones = require($path);

      if (!is_array($phones) || !count($phones))
        return 'List "' . $list . '" is empty<br />';

      $returnString = '';

      foreach($phones as $phone) {
        try {
          $message = $this->twilioClient->messages->create(
            $phone,
            [
              'from' => $this->from,
              'body' => $messageTxt
            ]
          );
          $returnString .= $phone . ' - 200 - ' . $message->sid . '<br />';
        } catch (RestException $e) {
          $returnString .= $phone . ' - ' . $e->getStatusCode() . ' - ' . $e->getMessage() . '<br />';
        }
      }

      return $returnString;
    }
}
