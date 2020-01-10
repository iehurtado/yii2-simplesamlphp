<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace lucidprogrammer\simplesamlphp\traits;

trait ContainerAwareTrait {
    public function get($depName) {
        return Yii::$container->get($depName);
    }
}