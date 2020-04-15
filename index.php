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

  $link = $bitly->prepareLink(getenv('LINK'));

  if (is_string($link))
    foreach(explode(',', getenv('LISTS')) as $list)
      print $twilio->sendMessage(
        trim($list),
        str_replace('[link]', $link, getenv('MESSAGE')),
      );
  else
    print $link['status'] . ' - ' . $link['description'];
?>
