<?php
return array(         
	'package' => 'blog', 
	'Model' => 'Blog',
	'code' => 'blog',
	'name' => 'Blog',   
	'singular' => 'Blog Entry',
	'plural' => 'Blog Entries',
	'uri' => 'blog',
	'searchable' => array(
		'name',
		'slug',
		'html'
	),
	'log_change' => true
);