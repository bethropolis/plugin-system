<?php

namespace Bethropolis\PluginSystem\AdditionPlugin;

use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin {
    public function initialize() {
        $this->linkHook('calculate_addition', array($this, 'calculateAddition'));
    }

    public function calculateAddition($args) {

        if (!isset($args[0]) || !isset($args[1])) {
            $this->error('Invalid arguments');
            return;
        }
        $result = $args[0] + $args[1];
        return "The sum of $args[0] and $args[1] is $result";
    }
}
