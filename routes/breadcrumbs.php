<?php

 Breadcrumbs::register('index', function($breadcrumbs)
{
	$breadcrumbs->parent('documents.index');
    $breadcrumbs->push('Add Documents', route('documents.create'));
});

 