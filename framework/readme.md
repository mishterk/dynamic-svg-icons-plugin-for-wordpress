## View System

The ViewRenderer can be used on its own:

```php
<?php 
$view = new \DsvgIcons\Framework\View\ViewRenderer();
$view->set_view_base_dir('/some/dir');

$view->render('some/template', ['var' => 'data']);
```

For static access, define one or more custom view objects at the app level and extend the View class as follows:

```php
<?php 
class View extends \DsvgIcons\Framework\View\ViewBase {

	protected function setup() {
		$this->set_view_base_dir( DSVGI_PLUGIN_DIR . 'templates' );
		$this->set_view_override_base_dir( get_stylesheet_directory() . '/dsvgicons' );
		
		// make all templates overridable
        $this->make_all_templates_overridable();

        // OR, specify which directories contain overridable templates
        $this->set_overridable_template_dirs( [ 'dir', 'some/dir' ] );
        $this->add_overridable_template_dir( 'icons' );
        $this->add_overridable_template_dir( 'widgets' );

        // AND/OR, mark specific templates as overridable
        $this->set_overridable_templates( [ 'icons/umbrella', 'icons/tophat' ] );
        $this->add_overridable_template( 'icons/umbrella' );
        $this->add_overridable_template( 'icons/tophat' );
	}

}

// print the markup
View::echo('some/template', [...]);

// get the markup
$markup = View::get('some/template', [...]);

```