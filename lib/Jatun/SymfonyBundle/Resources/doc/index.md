Symfony Bundle
==============

>#Note
>This documentation only describes the addition of the Symfony bundle the the 
>Jatun library, for the full library documentation see [full docs][1]


This bundle adds Jatun functionality to a Symfony project. The environment
will be added to the Service Container as 'jatun.enviroment' and the events are 
added using 'jatun.event' tag. Also custom events can be added this way.

Also the Jatun javascript library is, using a symlink, added to the Resources/js/
directory.


Bundle installation
-------------------
To install the bundle, follow the installation manual from the library documentation 
and in addition to that add the following lines to your app/AppKernel.php:

```php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        //...
        new Jatun\SymfonyBundle\JatunSymfonyBundle(),
    );
}
```


Twig extension
--------------

Instead of building the Jatun response in the controller, this can be done in 
your Twig template using the Twig extension:

```html
{{
    jatun({
        'html': {
           'id':      'html-node-id',
           'content': 'Content of the element'
        }
    })
}}
```

Because the content of the html event can be quite large, it's recommanded to use
a set-block:

```html
{% set content %}
    Content of your dialog
{% endset %}
{{
    jatun({
        'html': {
           'id':      'html-node-id',
           'content': content
        }
    })
}}
```



[1]: https://github.com/arnogeurts/Jatun/blob/master/README.md
