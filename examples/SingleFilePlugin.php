<?php


class SingleFilePlugin extends \Bethropolis\PluginSystem\Plugin
{

    public function initialize()
    {
        $this->linkHook('js_hook', array($this, 'myCallback'));
    }



    public function myCallback($name = [])
    {
        $name = array_shift($name);
        return "hello {$name}";
    }
}
