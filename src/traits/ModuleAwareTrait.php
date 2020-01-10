<?php

namespace lucidprogrammer\simplesamlphp\traits;

use lucidprogrammer\simplesamlphp\Module;

trait ModuleAwareTrait {
    public function getModuleInstance() {
        return Module::getInstance();
    }
}