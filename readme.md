## Basic Usage

To use this plugin you need to:

1. Specify which icons you want to load into the DOM via a PHP filter
1. Add markup where you wish the icons to appear

### Specifying which icons to load

There are two ways to do this:

1. You can add a `dsvgicons/active-icons.php` file to your theme directory which returns an array of icon names to load:

```php
<?php

return [
	'twitter', 'umbrella', 'ambulance'
];
```

2. You can specify which icons to load via a PHP filter:

```php
<?php
 
add_filter( 'dsvgicons/active_icons', function ( $icons ) {
	$icons[] = 'twitter';
	$icons[] = 'umbrella';
	$icons[] = 'ambulance';
	
    return $icons;
} );
```

**Note:** These can both be used at the same time but the filter will override the theme configuration file.

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

## Using custom SVGs

It is possible to use custom SVGs. To do so:

1. Copy the SVG file to the `dsvgicons/icons` directory and rename it as a `.php` file. e.g; `my-svg.svg` will become 
`my-svg.php`
1. Add the file name to the icons-to-load array. See _Specifying which icons to load_
1. Place an icon placeholder anywhere in your HTML using the same prefixed markup but using the custom file name in the 
class name.
  - e.g; `<i class="dsvgicon--my-svg"></i>`

**Important:** the PHP file must contain a single `<svg />` element as the only top level node. If you are exporting 
SVGs from Illustrator or downloading them from an online service, the file may very well contain an XML declaration that 
look something like `<?xml version="1.0" encoding="iso-8859-1"?>`. This needs to be removed from the PHP file.

### What if the custom SVG doesn't resize to fill its containing element? 

The SVG likely has `height` and `width` attributes. Remove these but leave the `viewbox` attribute intact. 