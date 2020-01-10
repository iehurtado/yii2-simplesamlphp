<?php
/**
 * User Object as per yii2, minor changes to the yii\web\User
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-security-authentication.html
 * @author     Lucid Programmer<lucidprogrammer@hotmail.com>
 * @copyright  2017 Lucid Programmer
 * @license    https://github.com/lucidprogrammer/yii2-simplesamlphp/blob/master/README.md
 * @link       https://github.com/lucidprogrammer/yii2-simplesamlphp
 */

namespace lucidprogrammer\simplesamlphp\models;

use yii\web\User;
use yii\helpers\Url;

use ArrayObject;
use lucidprogrammer\simplesamlphp\traits\ContainerAwareTrait;
use lucidprogrammer\simplesamlphp\traits\ModuleAwareTrait;


class SamlUser extends User
{
    use ContainerAwareTrait;
    use ModuleAwareTrait;
    
    public $loginUrl = ['_saml/login'];
    public $identityClass = 'lucidprogrammer\simplesamlphp\SamlIdentity';
    public $enableAutoLogin = true;
    
    function __construct($attributes=[]) 
    {   
        $idAttribute = null;
        $mappings = null;
        
        if(array_key_exists('idAttribute', $attributes)){
            $idAttribute = $attributes['idAttribute'];
            $mappings = (new ArrayObject($attributes))->getArrayCopy();
            unset($mappings['idAttribute']);
            $mappings = array_values($mappings);
        }
        
        $samlSettings = $this->get('samlsettings');
        
        $samlSettings->idAttribute = $idAttribute;
        $samlSettings->mappings = $mappings;

        parent::__construct();
    }
    
//    public function init () {
//        if (!isset($this->loginUrl)) {
//            $this->loginUrl = Url::toRoute("{$this->getModuleInstance()->id}/login");
//        }
//    }

    public function logout($destroySession = true)
    {
      $this->get('saml')->logout('/');
      parent::logout($destroySession);

    }


}
