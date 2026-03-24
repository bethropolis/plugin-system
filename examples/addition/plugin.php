<?php
// File: examples/addition/plugin.php

namespace Bethropolis\PluginSystem\AdditionPlugin;

use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin 
{
    protected $name = "Addition Plugin";
    protected $version = "1.0.0";

    public function initialize() 
    {
        // Modern array syntax []
        $this->linkHook('calculate_addition', [$this, 'calculateAddition']);
    }

    public function calculateAddition($args) 
    {
        if (!isset($args[0]) || !isset($args[1])) {
            $this->error('Invalid arguments provided to addition plugin.', 'WARNING');
            return null;
        }
        
        $result = $args[0] + $args[1];
        return "The sum of {$args[0]} and {$args[1]} is {$result}";
    }
}
