Jatun Documentation
=====================

This library implements a low level communication interface between your 
(server-side) PHP project and your (client-side) jQuery application.


Installation
------------

Follow these steps to install the library in your php project. 
Add the following to your ``composer.json`` file:

```json
{
    "require": {
        "aygon/jatun": "dev-master"
    }
}
```

Update the vendor libraries:

```bash
$ php composer.phar update
```



Application - PHP
-----------------

The Jatun environment validates and parses an array of events you want to send 
to the client using generic event classes. These events are encoded using an 
encoder (by default JSON encoder) and send to the client.


### Building the Environment

The environment is the base object of the library. It handles all validation,
parsing and encoding of the event array. Generic events can be added to this 
object to extend the support of events:

```php
$env = new \Jatun\Environment()
$env->addEvent(\Jatun\Event\HtmlEvent())
$env->addEvent(\Jatun\Event\FlashmessageEvent())
...
```


### Default Events

The library already includes some basic events, in this section these events are
explained:


#### Html

The html event adds the functionality to change the inner html of an html node 
based on its id.

##### Usage
```php
$env->addEvent(\Jatun\Event\HtmlEvent())

echo $env->parse(array(
    'html' => array(
        'id'      => 'html-node-id',
        'content' => 'new html content of the node'
    )
);
```

#### Flash message

The flash message event adds the functionality pop up a flash message inside a 
html node based on its id.

##### Usage
```php
$env->addEvent(\Jatun\Event\FlashmessageEvent())

echo $env->parse(array(
    'flashmessage' => array(
        'id'       => 'html-node-id',
        'level'    => 'error|notice|success',
        'text'     => 'the text of the flashmessage',
        [optional]
        'duration' => 3000 // ms
    )
);
```


#### Dialog open

The dialog open event adds the functionality to open a jQuery dialog with a 
given id, title and content

##### Usage
```php
$env->addEvent(\Jatun\Event\DialogOpenEvent())

echo $env->parse(array(
    'dialog.open' => array(
        'id'       => 'dialog-id',
        'title'    => 'the title of the dialog',
        'content'  => 'the html content of the dialog',
        [optional]
        'width'    => 800, // px
        'height'   => 600  // px
    )
);
```


#### Dialog title

The dialog title event adds the functionality to change the title of a jQuery 
dialog based on its id.

##### Usage
```php
$env->addEvent(\Jatun\Event\DialogTitleEvent())

echo $env->parse(array(
    'dialog.title' => array(
        'id'       => 'dialog-id',
        'title'    => 'the title of the dialog'
    )
);
```


#### Dialog close

The dialog close event adds the functionality to close a jQuery dialog based on
its id.

##### Usage
```php
$env->addEvent(\Jatun\Event\DialogCloseEvent())

echo $env->parse(array(
    'dialog.close' => array(
        'id'       => 'dialog-id',
    )
);
```


Application - Javascript
------------------------

At client side the JSON response from the server is parsed back to an array of 
events, which are fired sequentially, prefixed with "jatun."

In order to make the basic Jatun functionality work at client-side, jQuery, 
jQuery-UI and the Jatun library should be included:

```html
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
<script src="public/js/jatun.js"></script>
```

In order to change click behavior on an element, or submit behavior of a form 
the following javascript can be used. If the selected element is not an a or
form tag, Jatun tries to find a data-path attribute on the element:

```javascript
$(selector).jatun()
```

Also a custom Jatun request can be done in the same way as a jQuery ajax request, 
but in this case the success handler does not have to be implemented:

```javascript
$.jatunRequest({
   url: '/index.php',
   ...
});
```


Symfony Bundle
--------------

Jatun also comes with a built in Symfony Bundle for easy integration in your
Symfony project. For the Symfony bundle documentation see 
[bundle docs][https://github.com/arnogeurts/Jatun/blob/master/lib/Jatun/SymfonyBundle/Resources/doc/index.md]