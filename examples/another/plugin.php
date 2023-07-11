<?php

namespace Bethropolis\PluginSystem\AnotherPlugin;

use Bethropolis\PluginSystem\System;
use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin
{
    public function setupHooks()
    {
        System::linkPluginToHook('my_hook', array($this, 'myCallback'));
    }

    public function myCallback()
    {
        return 'My other callback';
    }
}
