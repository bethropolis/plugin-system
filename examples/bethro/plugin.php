<?php

namespace Bethropolis\PluginSystem\BethroPlugin;

use Bethropolis\PluginSystem\System;
use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin{
    public function setupHooks() {
        System::linkPluginToHook('test_hook', array($this, 'myCallback'));
    }

    public function myCallback($arg) {
        return "hello $arg[0] this is from Another script";
    }
}