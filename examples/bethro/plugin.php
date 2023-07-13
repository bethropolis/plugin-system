<?php

namespace Bethropolis\PluginSystem\BethroPlugin;

use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin{
    public function setupHooks() {
        $this->linkHook('test_hook', array($this, 'myCallback'));
    }

    public function myCallback($arg) {
        return "hello $arg[0] this is from Another script";
    }
}