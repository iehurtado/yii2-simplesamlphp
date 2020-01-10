<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace lucidprogrammer\simplesamlphp\traits;

use Yii;

trait ContainerAwareTrait {
    public function get($class) {
        return Yii::$container->get($class);
    }
    public function set($class, $definition = [], $params = []) {
        Yii::$container->set($class, $definition, $params);
    }
}