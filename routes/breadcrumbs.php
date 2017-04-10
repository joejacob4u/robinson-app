<?php

use App\Document;
use App\DocumentPages;

$doc=new Document;
$page=new DocumentPages;


Breadcrumbs::register('admin', function($breadcrumbs)
{
    $breadcrumbs->push('Admin', route('admin'));
});

 Breadcrumbs::register('documents.index', function($breadcrumbs)
{
    $breadcrumbs->push('Documents', route('documents.index'));
});


 Breadcrumbs::register('documents.create', function($breadcrumbs)
{
    $breadcrumbs->parent('documents.index');
    $breadcrumbs->push('Create', route('documents.create'));
});

 Breadcrumbs::register('documents.edit', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('documents.index');
    $breadcrumbs->push('Edit', route('documents.edit',$id));
});

 Breadcrumbs::register('pages.index', function($breadcrumbs,$id) use($doc)
{
	$data=$doc->where('id',$id)->first(); 
    $breadcrumbs->parent('documents.index');
    $breadcrumbs->push($data->doc_name, route('pages.index',$id));
});

  Breadcrumbs::register('pages.create', function($breadcrumbs,$id)
{

    $breadcrumbs->parent('pages.index',$id);
    $breadcrumbs->push('Create', route('pages.index',$id));
});

  Breadcrumbs::register('pages.edit', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('pages.index',$id);
    $breadcrumbs->push('Edit', route('pages.index',$id));
});

  Breadcrumbs::register('pages.show', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('pages.index',$id);
    $breadcrumbs->push('View', route('pages.index',$id));
});


  


 