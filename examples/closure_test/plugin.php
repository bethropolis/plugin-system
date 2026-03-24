<?php

namespace Bethropolis\PluginSystem\Closure_testPlugin;

use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin
{
    protected $name = "Closure Test";

    public function initialize()
    {
        // Testing an anonymous function (Closure) instead of [$this, 'methodName']
        $this->linkHook('test_closure_hook', function($args) {
            $name = $args[0] ?? 'Guest';
            return "Hello from an anonymous function, {$name}!";
        });

        // Testing a standard PHP string function callback
        $this->linkHook('test_string_hook', 'strtoupper');
    }
}
