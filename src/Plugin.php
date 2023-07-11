<?php

namespace Bethropolis\PluginSystem; 

abstract class Plugin
{
    protected $name;
    protected $version;
    protected $author;
    protected $description;
    public function getInfo()
    {
        return array(
            'name' => $this->name,
            'version' => $this->version,
            'author' => $this->author,
            'description' => $this->description
        );
    }
}
