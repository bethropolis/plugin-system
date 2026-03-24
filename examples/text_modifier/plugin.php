<?php

namespace Bethropolis\PluginSystem\Text_modifierPlugin;

use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin
{
    protected $name = "Text Modifier";

    public function initialize()
    {
        // Listen to a hook that formats strings
        $this->linkHook('format_output_text',[$this, 'capitalizeText']);
    }

    public function capitalizeText($args)
    {
        $text = $args[0] ?? '';
        // Return the modified string
        return strtoupper($text);
    }
}
