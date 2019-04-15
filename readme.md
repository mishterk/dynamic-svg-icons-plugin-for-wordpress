## Basic Usage

To use this plugin you need to:

1. Specify which icons you want to load into the DOM via a PHP filter
1. Add markup where you wish the icons to appear

### Specifying which icons to load

```php
<?php
 
add_filter( 'dsvgicons/active_icons', function ( $icons ) {
    return [ 'twitter', 'umbrella', 'ambulance' ];
} );
```

### Placeholder markup

The following element will be replaced with the SVG markup. The element does not matter – just the class name – so you 
can use any element you wish.

```html
<span class="dsvgicon--umbrella"></span>
```

If you have a situation where the icon SVG needs to be injected inside your placeholder, add the `-wrap` suffix. The 
following example will have the `<svg />` element placed inside it. Note: all other content will be replaced.

Again, the element does not matter, only the class name.  

```html
<div class="dsvgicon--umbrella-wrap"></div>
```