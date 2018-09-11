# RRWI
RepRap Web Interface to interfejs webowy do sterowania drukarką 3D inspirowany projektem "Printerface" (https://github.com/w-A-L-L-e/printerface). Projekt łączy w sobie kilka technologii. CMS łączy się z aplikacją NodeJS uruchominonej na Raspberry Pi. Mikrokomputer podłączony jest do drukarki 3D za pomocą kabla USB oraz musi być widoczny w sieci lokalnej.

Zalecane wymagania:
- zdalny serwer www oraz baza danych umożliwiająca instalację frameworka Yii2
- raspberry Pi 3 B+ wraz z kartą microSD 16GB
- zestaw elementów elektronicznych potrzebnych do budowy przystawki (zestawienie na diagramie w pliku diagram.pdf)


Interfejs składa się z dwóch części:

1) System CMS na bazie frameworka Yii2 (https://www.yiiframework.com/). System należy zaisntalować zgodnie zasadami instalacji framworka Yii2. Następnie po instalacji, w panelu administratora (/admin , Login: admin@admin.com, Password: asd123) należy skonfigurowac dane niezbędne do połączenia z Aplikacją 2).

2) Skonfigurowany obraz systemu Raspbian z aplikacją NodeJS wraz z biblioteką Pronsole. Obraz należy nanieść na kartę micro SD i uruchomić w Raspberry Pi (testowano na Raspberry 3 B+). Nieodłącznym elementem systemu jest proste urządzenie umożliwiające zdalne sterowanie zasilaniem drukarki. Szkic połączeń elementów układu znajduje się w pliku pdf (diagram.pdf). Instrukcja nagrywania dowolnego obrazu systemu na kardtę SD znajduję się np. pod tym adresem: http://uczymy.edu.pl/wp/mini-kurs-obslugi-raspberry-pi/raspberry-pi-raspbian/


Więcej szczegółowych informacji na temat interfejsu oraz przystawki zdalnego sterowania można znaleźć w dokumencie dostępnym pod adresem: https://www.thesis.maciejborowiec.pl/rrwi-maciejborowiec.pdf

Autor nie ponosi odpowiedzialności za ewentualnie powstałe uszkodzenia oprzyrządowania drukarki, mikrokoputera i innych elementów sprzętowych oraz programowych wykorzystywanych w projekcie. Wszystko co użytkownik wykonuje, robi na własną odpowiedzialność.

Interfejs można dowolnie wykorzystywać i rozwijać na własne potrzeby.





RepRap Web Interface is a web interface for controlling a 3D printer inspired by the "Printerface" project (https://github.com/w-A-L-L-e/printerface). The project combines several technologies. CMS connects to the NodeJS application launched on Raspberry Pi. The microcomputer is connected to a 3D printer using a USB cable and must be visible on the local network.

Recommended requirements:
- remote www server and database enabling the installation of the Yii2 framework
- raspberry Pi 3 B + with 16GB microSD card
- a set of electronic components needed to build a snap (shown in the diagram in the file diagram.pdf)


The interface consists of two parts:

1) CMS based on the Yii2 framework (https://www.yiiframework.com/). The system should be installed in accordance with the installation rules of the Yii2 framework. Then after installation, in the admin panel (/ admin, Login: admin@admin.com, Password: asd123), you must configure the data necessary to connect to Application 2).

2) Configured image of the Raspbian system with the NodeJS application works with the Pronsole library. The image should be applied to the micro SD card and run in Raspberry Pi (tested on Raspberry 3 B +). An inherent element of the system is a simple device enabling remote control of the printer's power supply. The sketch of connection of system elements can be found in the pdf file (diagram.pdf). The instructions for recording any system image on the SD card can be found, for example, at this address: http://uczymy.edu.pl/wp/mini-kurs-obslugi-raspberry-pi/raspberry-pi-raspbian/


More detailed information on the interface and remote control adapter can be found in the document available at: https://www.thesis.maciejborowiec.pl/rrwi-maciejborowiec.pdf

The author is not responsible for any damage to printer tooling, microcopier and other hardware and software components used in the project. Everything that the user does is done at his own risk.

The interface can be freely used and developed for your own needs.










Maciej Borowiec
mb.fizyka@gmail.com
https://maciejborowiec.pl





RUN SOCKECTS SERVER:

php yii server/start







Yii 2 Basic Project Template
============================

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-basic/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-basic/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install via Composer
composer global require "fxp/composer-asset-plugin:^1.3.1"

composer install or composer update

mkdir upload
mkdir temp

change default parameters for db connection

create db on your server

run scripts from command

php yii mb/addstore
php yii mb/setparams



CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

Edit the file `config/params.php` with real data for email account, for example:
  'email-notifications' => "xyyy0107@gmail.com",
  
  'email-host' => 'smtp.gmail.com',
  'email-username' => 'lorem.ipsum.dnd@gmail.com',
  'email-password' => 'zaq12wsxcde3',
  'email-port' => '587',
  'email-encryption' => 'tls',
  'email-subject' => "Your selfie!!"

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.



SIMPLY MANUAL IS IN web DIR
