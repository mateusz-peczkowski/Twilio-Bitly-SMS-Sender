<?php
  require('vendor/autoload.php');
  require('App/Controllers/TwilioController.php');
  require('App/Controllers/BitlyController.php');

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
  $dotenv->load();

  use \App\Controllers\TwilioController;
  use \App\Controllers\BitlyController;

  $twilio = new TwilioController(
    getenv('TWILIO_SID'),
    getenv('TWILIO_TOKEN'),
    getenv('TWILIO_FROM_NUMBER'),
  );

  $bitly = new BitlyController(
    getenv('BITLY_ACCESS_TOKEN'),
  );

  $link = $bitly->prepareLink('https://google.com');

  if (is_string($link))
    print $twilio->sendMessage(
      'me', //me, us, managers, clients
      "FLASH FEEDBACK. BARE International is collecting data about your recent task. Please take a moment to respond to this short survey. $link. To opt-out reply STOP, Msg & Data rates may apply.",
    );
  else
    print $link['status'] . ' - ' . $link['description'];
?>