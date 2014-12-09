Angel News
==============
This is a blog module for the [Angel CMS](https://github.com/CharlesAV/angel).

Installation
------------
Add the following requirements to your `composer.json` file:
```javascript
"require": {
  "angel/blog": "dev-master"
},
```

Issue a `composer update` to install the package.

Add the following service provider to your `providers` array in `app/config/app.php`:
```php
'Angel\Blog\BlogServiceProvider'
```

Issue the following command:
```bash
php artisan migrate --package="angel/blog"  # Run the migrations
```

Open up your `app/config/packages/angel/core/config.php` and add the blog routes to the `menu` array:
```php
'menu' => array(
	'Pages' => 'pages',
	'Menus' => 'menus',
	'Blog' => 'blog', // <--- Add this line
	'Users' => 'users',
	'Settings' => 'settings'
),
```
...and the menu-linkable models to the `linkable_models` array:
```php
'linkable_models' => array(
	'Page' => 'pages',
	'Blog' => 'blog' // <--- Add this line
)
```
