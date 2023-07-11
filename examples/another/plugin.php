<?php

namespace Bethropolis\PluginSystem\AnotherPlugin;

use Bethropolis\PluginSystem\System;
use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin
{
    protected  $name = "dis app";
    public function setupHooks()
    {
        System::linkPluginToHook('other_hook', array($this, 'myCallback'));
    }

    public function myCallback()
    {
        return $this->getInfo();
    }
}
