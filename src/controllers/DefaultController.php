<?php

/**
 * Adding a controller which is going to give a login route which is _saml/login
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-structure-controllers.html
 *
 * @author     Lucid Programmer<lucidprogrammer@hotmail.com>
 * @copyright  2017 Lucid Programmer
 * @license    https://github.com/lucidprogrammer/yii2-simplesamlphp/blob/master/README.md
 * @link       https://github.com/lucidprogrammer/yii2-simplesamlphp
 */

namespace lucidprogrammer\simplesamlphp\controllers;

use yii\web\Controller;
use lucidprogrammer\simplesamlphp\SamlIdentity;
use lucidprogrammer\simplesamlphp\traits\ContainerAwareTrait;

class DefaultController extends Controller {
    use ContainerAwareTrait;
    
    public function actionLogin(){
        $saml = $this->get('saml');

        if ($saml->isAuthenticated()) {
            $saml->requireAuth();
        } else {
            $attributes = $saml->getAttributes();

            // just in case the user didn't set idAttribute, give something anyway, he can troubleshoot later instead of throwing errors here
            $id = mt_rand();

            $samlSettings = $this->get('samlsettings');

            $uniqueIdentifierFromIdp = $samlSettings->idAttribute ? $samlSettings->idAttribute : '';
            
            if ($uniqueIdentifierFromIdp) {
              $id = $attributes[$uniqueIdentifierFromIdp] && count($attributes[$uniqueIdentifierFromIdp]) > 0 ? 
                    $attributes[$uniqueIdentifierFromIdp][0] 
                    : $id;
            }

            Yii::$app->user->login(new SamlIdentity($id, $attributes), 0);

            $this->goBack();
        }
    }

}
