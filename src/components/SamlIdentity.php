<?php

/**
 * Identity Object as per yii2
 *
 * @see http://www.yiiframework.com/doc-2.0/guide-security-authentication.html
 * @author     Lucid Programmer<lucidprogrammer@hotmail.com>
 * @copyright  2017 Lucid Programmer
 * @license    https://github.com/lucidprogrammer/yii2-simplesamlphp/blob/master/README.md
 * @link       https://github.com/lucidprogrammer/yii2-simplesamlphp
 */

namespace lucidprogrammer\simplesamlphp\components;


use yii\base\BaseObject;
use yii\web\IdentityInterface;
use lucidprogrammer\simplesamlphp\traits\ContainerAwareTrait;

class SamlIdentity extends BaseObject implements IdentityInterface {
    use ContainerAwareTrait;
    
    public $id;
    public $attributes;


    public function __construct($id,$attributes, $config = [])
    {
      $this->id = $id;
      $this->attributes = $attributes;
      parent::__construct($config);
    }


    /**
    * Finds an identity by the given ID.
    *
    * @param string|int $id the ID to be looked for
    * @return IdentityInterface|null the identity object that matches the given ID.
    */
    public static function findIdentity($id)
    {
        $saml = $this->get('saml');
        
        $attributes = $saml->getAttributes();
        if(sizeof($attributes) > 0){
            // just in case the user didn't set idAttribute, give something anyway, he can troubleshoot later instead of throwing errors here
            $id = mt_rand();
            
            $samlSettings = $this->get('samlsettings');
            
            $uniqueIdentifierFromIdp = $samlSettings->idAttribute ? $samlSettings->idAttribute : '';
            if($uniqueIdentifierFromIdp){
                $id = $attributes[$uniqueIdentifierFromIdp] && count($attributes[$uniqueIdentifierFromIdp]) > 0 ? 
                    $attributes[$uniqueIdentifierFromIdp][0]
                    : $id;
            }
            return new SamlIdentity($id,$attributes);
        }
        return null;
    }

    /**
     * @return int|string current user ID
    */
    public function getId()
    {
        return $this->id;
    }

    public function __get($name)
    {
        $samlSettings = $this->get('samlsettings');      
        $result = null;
        $mappings = $samlSettings->mappings;
        
        if(isset($mappings[$name]))
        {
            $result = isset($this->attributes[$mappings[$name]]) ? $this->attributes[$mappings[$name]][0] : null;
        } else {
            $result = isset($this->attributes[$name]) ? $this->attributes[$name][0] : null;
        }
        
        return $result;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {

    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {

    }
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }


}
