TimelineJSBundle
================

TimelineJS Symfony2 bundle. Provides easy integration of [TimelineJS][tlhp].

[![Build Status](https://secure.travis-ci.org/ChubV/TimelineJSBundle.png)](http://travis-ci.org/ChubV/TimelineJSBundle)

About TimelineJS
----------------

There are lots of timeline tools on the web but they are almost all either hard on the eyes or hard to use. Create timelines that are at the same time beautiful and intuitive for users.

Installation
------------

### Download bundle

First of all, download bundle using one of common ways:

#### Using deps file

Add the following lines to your `deps` file and run `php bin/vendors install`

```
[TimelineJSBundle]
    git=https://github.com/ChubV/TimelineJSBundle.git
    target=bundles/ChubProduction/TimelineJSBundle
```

#### Using composer

### Register the namespaces

Add the following namespace entry to the `registerNamespaces` call
in your autoloader:

``` php
<?php
// app/autoload.php
$loader->registerNamespaces(array(
    // ...
    'ChubProduction\TimelineJSBundle' => __DIR__.'/../vendor/bundles',
    // ...
));
```

This is unnecessary step if you use Composer's automaticaly generated autoload file

### Register the bundle

To start using the bundle, register it in your Kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new ChubProduction\TimelineJSBundle\TimelineJSBundle(),
    );
    // ...
}
```

### Create your first Timeline

#### Create an entity that implements TimelineEntityInterface

``` php
<?php
// TimelineEntity.php
// ...
class TimelineEntity implements TimelineEntityInterface
{
    // ...
}
```

#### Fetch an array of your entities

Array will represent the points on your Timeline. Create timeline and pass it to your view.

``` php
<?php
// TimelineController.php
// ...
/**
 * @Route("/timeline", name="_timeline")
 * @Template()
 */
public function timelineAction()
{
    $ts = $this->get('timelinejs');
    $timeline = $ts->createTimeline('myTimeline', $this->fetchTimelineEntities());
    return compact('timeline');
}
```

Render timeline in your template

``` twig
{# timeline.html.twig #}
{% import "TimelineJSBundle::macro.html.twig" as t %}
{{ t.head() }}
<div id="timeline"></div>
{{ t.show(timeline, {'embed_id': 'timeline', 'debug': true}) }}
```


[tlhp]: https://github.com/VeriteCo/TimelineJS