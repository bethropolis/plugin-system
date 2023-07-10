<?php

namespace PluginManager\AnotherPlugin;

use PluginManager\Plugin;

class Load
{
    public function setupHooks()
    {
        Plugin::linkPluginToHook('my_hook', array($this, 'myCallback'));
    }

    public function myCallback()
    {
        return 'My other callback';
    }
}
