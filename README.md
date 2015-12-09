REQUIREMENTS
------------
Shoud be installed [virtualbox](https://www.virtualbox.org/) and [vagrant](https://www.vagrantup.com/)

The minimum requirement by this application template that your Web server supports PHP 5.4.0.

INSTALLATION
------------
```
git clone https://eawapownikov@bitbucket.org/eawapownikov/medclever.ru.git
cd medclever.com
vagrant up
vagrant ssh
cd /var/www/medclever.com
composer update
php init --env=Production --overwrite=All
    or for develop
    php init --env=Development --overwrite=All
php yii migrate
```
Site will be available on [192.168.100.101](http://192.168.100.101) or [medclever.dev](http://medclever.dev), [admin.medclever.dev](http://admin.medclever.dev)

add to hosts file the following lines
```
192.168.100.101 medclever.dev
192.168.100.101 admin.medclever.dev
```

Data base management system available on [192.168.100.101/adminer](http://192.168.100.101/adminer)
        

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```