# Terminus #

Terminus is a simple WordPress theme designed to act as a foundation for theme development. It should not be customized directly. Instead, you should create a child theme with your own templates and styles.

## What's in the box? ##

Terminus is designed to act as a starting point for theme development. Any of its features can be overridden by a child theme. However, here is what you get by default:

*   An editable navigation menu called `main-nav`.
*   A widget area (sidebar) called `main-sidebar`.

## Utilities ##

Terminus provides the `\Cgit\Terminus` class, which contains various static methods that make child theme development easier:

*   `Terminus::enqueue($src, $deps = [], $script = false, $parent = false)` lets you enqueue one or more CSS or JavaScript files without having to think of a unique handle or specifying the resource type. It also generates version numbers based on file modified times to avoid caching issues.

*   `Terminus::getResourceHandle($src)` provides access to the resource handles generated by the enqueue method.

*   `Terminus::pagination($args = [])` generates pagination links with sensible default options, using the [WordPress pagination function](https://codex.wordpress.org/Function_Reference/paginate_links). The default options can be overridden by providing an array options.

*   `Terminus::taxonomy($args = [])` generates a comma-separated string of HTML taxonomy links for a particular post, without the annoying `rel` attributes.

## Child themes ##

The best way to customize Terminus is to use a child theme. You can use this to replace any of the template files in Terminus. The file `functions.php` is a special case: the parent version will always be loaded, but only _after_ the child version.

### Overriding behaviour with functions ###

For compatibility with previous versions of Terminus, defining certain functions in the child theme `functions.php` will override the default theme behaviour:

*   `terminus_init()` is used to add theme features, such as editor styles, feed links, and featured images.
*   `terminus_head_init()` removes certain WordPress header actions.
*   `terminus_scripts_init()` loads CSS and JavaScript files. You should always enqueue CSS and JavaScript files properly. By default, this function will load a basic CSS reset. When used _without_ a child theme, it will also load a simple layout for Terminus.
*   `terminus_nav_init()` registers the navigation menu(s).
*   `terminus_widgets_init()` registers the widget area(s).
*   `terminus_title()` is used to generate the page title.

Since version 2.0, these functions are no longer defined in Terminus but have equivalent methods in the `\Cgit\Terminus\Theme` class. However, defining the functions in the child theme will still have the expected result.

### Overriding behaviour with a theme class ###

You can also override the default behaviour of Terminus by replacing the default `\Cgit\Terminus\Theme` class. You can extend the default class or define an entirely new class with a similar singleton structure. You can then define a constant in the child theme `functions.php` with the fully qualified class name:

~~~ php
define('TERMINUS_THEME_CLASS', '\Foo\Bar\Baz');
~~~

This will cause that class to be used instead of the default Terminus theme class.

## Development ##

Terminus should act as a foundation and it should be possible to update it in place without breaking child themes and plugins. Therefore, please be careful not to change core parts of theme in a way that will break other sites. Before making any changes, you should also read the official WordPress guidelines for theme development:

*   [Theme Check](http://make.wordpress.org/themes/guidelines/guidelines-theme-check/)
*   [Plugin Territory](http://make.wordpress.org/themes/guidelines/guidelines-plugin-territory/)

The most important thing is to remember that themes are only for presentation. They should not add functions or content. Anything that changes how something works, rather than how it looks, should be part of a plugin. You can test Terminus (and child themes) using the WordPress test data and theme check plugin:

*   [Theme Unit Test](http://codex.wordpress.org/Theme_Unit_Test)
*   [Theme Check](http://wordpress.org/plugins/theme-check/)

## Changes since version 2.0 ##

The basic theme configuration is now carried out by `\Cgit\Terminus\Theme`, which can be extended or replaced by a class defined in the child theme. This provides an alternative way of overriding the default Terminus behaviour and is documented above.

The enqueue, pagination, and taxonomy functions from previous versions of Terminus have become static methods of the `\Cgit\Terminus` class. The original functions are still provided in version 2.0, but they simply wrappers for the corresponding static class methods and they may be removed in future versions.

Previous versions of Terminus provided separate `author.php`, `category.php`, and `tag.php` templates. From version 2.0, it only provides `archive.php` for all archive types. This makes it easier to override the archive template(s) in child themes.
