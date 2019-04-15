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

### Markup

```html
<!-- This element will be replaced with the SVG markup. The element does not matter – just the class name --> 
<span class="dsvgicon--umbrella"></span>
```

```html
<!-- This contents of this element will be replaced with the SVG markup. The element does not matter – just the class name --> 
<div class="dsvgicon--umbrella-wrap"></div>
```