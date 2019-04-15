## View System

The ViewRenderer can be used on its own:

```php
$view = new \DsvgIcons\Framework\View\ViewRenderer();
$view->set_view_base_dir('/some/dir');

$view->render('some/template', ['var' => 'data']);
```

For static access, define one or more custom view objects at the app level and extend the View class as follows:

```php
class View extends \DsvgIcons\Framework\View\ViewBase {

	protected function setup() {
		$this->set_view_base_dir( DSVGI_PLUGIN_DIR . 'templates' );
		$this->set_view_override_base_dir( get_stylesheet_directory() . '/dsvgicons' );
		//$this->make_all_templates_overridable();
		//$this->add_overridable_template_dir( 'icons' );
		//$this->add_overridable_template( 'icons/umbrella' );
	}

}

$markup = View::get('some/template', [...]);

View::echo('some/template', [...]);
```