## A Laravel 4.1 Bootstrap CMS
--------------------------------------
**Screencasts:** [Laravel Bootstrap YouTube Playlist](http://www.youtube.com/playlist?list=PL8isL2kTKzMOm1MBVGYSbBuRN3Yi0i7wu)

A Laravel 4.1 **PHP 5.4** CMS using Bootstrap 3. Laravel Bootstrap does not handle the front-end of your site. It merely provides a CRUD framework with some predefined systems (image gallery, pages etc) for you to enter and edit your data with.

![Laravel Bootstrap Screenshot](http://i.imgur.com/CiUa8wt.png "Laravel Bootstrap Screenshot")

It uses Redactor JS for content editing and provides a really simple way to prototype new 'objects'. You can make objects 'taggable' and 'uploadable' which means you can have unlimited number of tags associated with an item and also unlimited number of image uploads too.

## Composer Require
Nice and simple

    "davzie/laravel-bootstrap": "1.*"

### Linking The Service Provider To Your Installation
Add this string to your array of providers in app/config/app.php

    Davzie\LaravelBootstrap\LaravelBootstrapServiceProvider

### Publishing The Configuration
Publish the configurations for this package in order to change them to your liking:

    php artisan config:publish davzie/laravel-bootstrap

### Publishing The Assets
You need assets bro!

    php artisan asset:publish davzie/laravel-bootstrap

### Migrating and Seeding The Database
Seed the database, this pretty much just seeds an example user and settings. Migration is pretty simple, ensure your database config is setup and run this:

    php artisan migrate --package="davzie/laravel-bootstrap"
    php artisan db:seed --class="Davzie\LaravelBootstrap\Seeds\DatabaseSeeder"

## Implementing Custom CMS Modules
The following steps are for creating your own module that works off of the Davzie Laravel Bootstrap CMS.  With all files created in this manner, namespacing will always be the same as the default modules provide on installation.

### Create the Controller
The controller is identical to those found in `vendor/davzie/laravel-bootstrap/src/controllers`.  Place them in `app/controllers`.

### Create the Views
Create the directory structure for `app/views/packages/laravel-bootstrap` and add a directory for your views.  The directory name is determined by the `$view_key` property of your controller (e.g. for the posts module, it is specified as `'posts'`).  For a module called events with a `$view_key` property of `'events'`, your directory structure for the views would then be `app/views/packages/laravel-bootstrap/events`.  Here you will want to create three files: `edit.blade.php`, `index.blade.php`, and `new.blade.php`.  These can reflect the same development style as the default modules packaged with davzie/laravel-bootstrap.

### Create the Models
These can be placed in the `app/models` directory (don't forget to run `composer dump-autoload` when needed).  The three files you will need to create are `{module name}.php`, `{module name}Repository.php`, and `{module name}Interface.php`.  For a module named events, this would be `Events.php`, `EventsRepository.php`, and `EventsInterface.php`.

### Routing and Configuration
Lastly, you will need to add the routing and Inversion of Control snippets.  For our hypothetical events module this would look like the following:

####Routing
    Route::group(array('namespace' => 'Davzie\LaravelBootstrap\Controllers', 'prefix' => Config::get('laravel-bootstrap::app.access_url')), function()
    {
        Route::controller( '/events', 'EventsController' );
    });

####IoC
    App::bind('Davzie\LaravelBootstrap\Events\EventsInterface', function(){
        return new Davzie\LaravelBootstrap\Events\EventsRepository( new Davzie\LaravelBootstrap\Events\Events );
    });
