<?php

namespace lucidprogrammer\simplesamlphp;

use yii\base\Module as BaseModule;
use lucidprogrammer\simplesamlphp\components\Saml;
use lucidprogrammer\simplesamlphp\components\SamlSettings;


class Module extends BaseModule {
    public $controllerNamespace = 'lucidprogrammer\simplesamlphp\controllers';
}
