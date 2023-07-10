<?php

namespace PluginManager\MyPlugin;

use PluginManager\Plugin;
class Load {
    public function setupHooks() {
        Plugin::linkPluginToHook('my_hook', array($this, 'myCallback'));
    }

    public function myCallback($name = []) {
        $name = array_shift($name);
        return "hello {$name}";
    }
}
