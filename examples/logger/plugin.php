<?php

namespace Bethropolis\PluginSystem\LoggerPlugin;

use Bethropolis\PluginSystem\Plugin;

class Load extends Plugin
{
    protected $name = "Activity Logger";

    public function initialize()
    {
        // Listens to the 'user_login' event
        $this->linkEvent('user_login', [$this, 'onUserLogin']);
    }

    public function onUserLogin($username)
    {
        // In a real app, you would append this to a file or database.
        // For testing, we will just echo or return it.
        $time = date('Y-m-d H:i:s');
        error_log("[{$time}] Event Triggered: User '{$username}' logged in.");
    }
}
