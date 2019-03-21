<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CategoryRequest as StoreRequest;
use App\Http\Requests\CategoryRequest as UpdateRequest;

/**
 * Class ActivityCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PagesController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Page');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/pages');
        $this->crud->setEntityNameStrings('page', 'pages');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */


        $this->crud->addColumn('name');
        $this->crud->addColumn('slug');
        $this->crud->addColumn('content');

        $this->crud->addColumn([
            'name' => 'enabled', // The db column name
            'label' => "Enabled", // Table column heading
            'type' => 'check'
        ]);

        /**
         * fields
         */

        $this->crud->addField([
            'label' => "Name",
            'name' => "name",
            'type' => 'text',
            'tab' => 'Content'
        ]);
        $this->crud->addField([
            'label' => "Enabled",
            'name' => "enabled",
            'type' => 'checkbox',
            'tab' => 'Content'
        ]);
        $this->crud->addField([
            'label' => "Slug",
            'name' => "slug",
            'type' => 'slug',
            'tab' => 'Content'
        ]);
        $this->crud->addField([
            'label' => "Image",
            'name' => "image",
            'type' => 'image',
            'aspect_ratio' => 1,
            'tab' => 'Content'
        ]);
        $this->crud->addField([
            'name' => 'content',
            'label' => 'Content',
            'type' => 'wysiwyg',
            'tab' => 'Content'
        ]);

        $this->crud->addField([
            'label' => "Title",
            'name' => "seo_title",
            'type' => 'text',
            'tab' => 'SEO'
        ]);

        $this->crud->addField([
            'label' => "Description",
            'name' => "seo_description",
            'type' => 'textarea',
            'tab' => 'SEO'
        ]);

        $this->crud->addField([
            'label' => "Header H1",
            'name' => "seo_h1",
            'type' => 'text',
            'tab' => 'SEO'
        ]);

        $this->crud->addField([
            'label' => "Keywords",
            'name' => "seo_keywords",
            'type' => 'text',
            'tab' => 'SEO'
        ]);


        // add asterisk for fields that are required in ActivityCategoryRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->removeButton( 'delete' );
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
