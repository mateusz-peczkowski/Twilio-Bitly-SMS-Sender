# Twilio Bitly SMS Sender

This small app was created to send SMS, via Twilio, to multiple customers at the same time with a link shortened by Bit.ly service.

## Getting Started

Below you will find some instructions about how to start with this small application and send your first SMS.

### Prerequisites

To start working with this app you need to have prepared a local environment with preinstalled PHP (tested at PHP 7.3.13), or stage if you want and domain pointed to the main folder of the application. Also, the composer is required

### Installing

1. Download repository (or clone)
2. Using bash go to the downloaded folder and run `composer install`
3. After installation copy `.env.example` into `.env` and configure all necessary data (below more informations)
4. Create a php file inside the `lists` folder with an array of numbers for whom you want to send SMS.
5. Point your domain into that folder
6. Go to this folder from website and magic will begin ;)

### ENV settings
```
TWILIO_SID -> SID from Twilio account
TWILIO_TOKEN -> Token from Twilio account
TWILIO_FROM_NUMBER -> Number that you have bought at Twilio from which you will send SMS

BITLY_ENABLED -> Option to make shorten links optional (0|1)
BITLY_ACCESS_TOKEN -> Token from Bitly service

LISTS -> names of files from the `lists` folder for which you want to send SMS. Can be multiply divided by `,`
LINK -> Full, long URL that you want to share inside SMS. This will be shortened by Bit.ly if enabled
MESSAGE -> Copy of an SMS that will go to your lists people. If you want to use the link from an above place somewhere `[LINK]` inside this copy
```

## Packages used

* [twilio/sdk](https://github.com/twilio/twilio-php) - To do Twilio part
* [phplicengine/bitly](https://github.com/phplicengine/bitly) - To enable Bit.ly shorten links
* [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) - To get variables from .env instead of editing php files

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Mateusz Pęczkowski** - [peczis](https://peczis.pl)

See also the list of [contributors](https://github.com/mateusz-peczkowski/Twilio-Bitly-SMS-Sender/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
