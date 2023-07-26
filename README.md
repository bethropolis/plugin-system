# A PHP Plugin System
[![PHP test](https://github.com/bethropolis/plugin-system/actions/workflows/main.yml/badge.svg?event=push)](https://github.com/bethropolis/plugin-system/actions/workflows/main.yml) [![CodeFactor](https://www.codefactor.io/repository/github/bethropolis/plugin-system/badge)](https://www.codefactor.io/repository/github/bethropolis/plugin-system) [![Contributions](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/dopecodez/Wikipedia/issues) [![GitHub version](https://badge.fury.io/gh/bethropolis%2Fplugin-system.svg)](https://badge.fury.io/gh/bethropolis%2Fplugin-system)


This is a lightweight, flexible, hook and event based  plugin manager and system.

It allows you to easily integrate plugins feature into your PHP applications, providing a modular and extensible architecture.



## Features

- Easy integration
- Dynamic loading
- Hook-based architecture
- Event-driven programming
- Flexible and extensible
- plugin manager included
- plugin life cycle


## Installation

you will require composer to install. Run the following command in your project directory:
```php
composer require bethropolis/plugin-system
```

you can also download the latest release and add it to your project directory.
> not you will have to require the autoloader file into your project scripts.
example
```php
require "plugin-system/src/autoload.php";
```


## Usage

### Loading Plugins
To load plugins from a specific directory, use the `loadPlugins` method:


```php

require "vendor/autoload.php"; // for download installed method just replace this line with the autoloader.

use Bethropolis\PluginSystem\System;

$dir = __DIR__ . "/examples/"; # directory to load plugins from
System::loadPlugins($dir);

```

## Linking Plugins to Hooks
Plugins functions can be linked to hooks using the `linkPluginToHook` method. This allows you to define actions that will be executed when a particular hook is triggered:
```php
use Bethropolis\PluginSystem\System;

// Link a plugin function to a hook
System::linkPluginToHook('my_hook', $callback);
```

### Triggering Hooks and Events
Hooks can be triggered using the `executeHook()` method, and events can be triggered using the `triggerEvent()` method. Here's an example:

```php
use Bethropolis\PluginSystem\System;

// Trigger a hook
System::executeHook('my_hook', $pluginName, ...$args);

// trigger multiple hooks
System::executeHooks(['my_hook1', 'my_hook2'], $pluginName, ...$args);

# Events
// Register an event
System::registerEvent('my_event');

// Add an action to the event
System::addAction('my_event', function ($arg) {
    // Action code here
});

// Trigger the event
System::triggerEvent('my_event', ...$args);
```

## plugin

here is an example of a plugin:
```php

// eg. FILE: /plugins-folder/examplepugin.php

class ExamplePlugin extends \Bethropolis\PluginSystem\Plugin
{

    public function initialize()
    {
        $this->linkHook('my_hook', array($this, 'myCallback'));
    }



    public function myCallback($name = [])
    {
        $name = array_shift($name);
        return "hello {$name}";
    }
}
```

## more Examples

The [examples](examples/) directory contains sample plugins that demonstrate the usage of the Plugin System. 

## Contributing

Contributions to the project are welcome! If you encounter any issues, have suggestions for improvements, or would like to add new features, please feel free to open an issue or submit a pull request.


## About

this project was made to be a plugin management system for another one of my [project](https://github.com/bethropolis/suplike-social-website) but I hope it can help someone else out there.

## License

this project is released under the [MIT License](https://opensource.org/licenses/MIT). You can find more details in the [LICENSE](LICENSE) file.