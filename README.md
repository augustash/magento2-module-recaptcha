# Magento 2 Recaptcha

[![Build Status](https://travis-ci.org/DerekMarcinyshyn/module-recaptcha.svg?branch=master)](https://travis-ci.org/DerekMarcinyshyn/module-recaptcha)

Magento 2 module that adds the Google Recaptcha on Contact Form, Customer create and Forgot Password pages.

## Screenshot

![settings screenshot](https://raw.githubusercontent.com/DerekMarcinyshyn/module-recaptcha/master/settings-screenshot.png)

## Register

You need to register your site with Google Recaptcha.

https://www.google.com/recaptcha/

Under Stores -> Configuration -> August Ash Extensions -> Recaptcha Configuration -> Extension Settings

+ Enabled -> Yes/No
+ Site Key -> from Recaptcha website
+ Secret Key -> from Recaptcha website
+ Enabled for Customer Registration -> Yes/No
+ Enabled for Forgot Password -> Yes/No
+ Enabled for Contact Form -> Yes/No

## Install

### Composer

```bash
composer config repositories.monashee-recaptcha vcs https://github.com/augustash/magento2-module-recaptcha.git
composer require monashee/module-recaptcha:dev-master
```

Enable Module

```php
php bin/magento module:enable Monashee_Recaptcha
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

You may need to Flush Magento Cache after installation.
