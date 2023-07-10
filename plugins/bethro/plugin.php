<?php

namespace PluginManager\BethroPlugin;

use PluginManager\Plugin;

class Load {
    public function setupHooks() {
        Plugin::linkPluginToHook('my_hook', array($this, 'myCallback'));
    }

    public function myCallback() {
        return 'hello this is from bethro script';
    }
}