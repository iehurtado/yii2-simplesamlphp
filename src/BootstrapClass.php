<?php
/**
 * Bootstrap class for the extension.
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-runtime-bootstrapping.html
 *
 * @author     Lucid Programmer<lucidprogrammer@hotmail.com>
 * @copyright  2017 Lucid Programmer
 * @license    https://github.com/lucidprogrammer/yii2-simplesamlphp/blob/master/README.md
 * @link       https://github.com/lucidprogrammer/yii2-simplesamlphp
 */

namespace lucidprogrammer\simplesamlphp;

use yii\base\BootstrapInterface;
use lucidprogrammer\simplesamlphp\components\Saml;
use lucidprogrammer\simplesamlphp\components\SamlSettings;
use lucidprogrammer\simplesamlphp\traits\ContainerAwareTrait;

class BootstrapClass implements BootstrapInterface
{
    use ContainerAwareTrait;
    
    public function bootstrap($app)
    {
        if (!$app instanceof \yii\console\Application) {
            $this->initContainer();
        }
    }
    
    protected function initContainer() {
        //a globally accessible instance of saml
        $this->set('saml', Saml::class);
        $this->set('samlsettings', SamlSettings::class);
    }

}
