<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BlogArticleRequest as StoreRequest;
use App\Http\Requests\BlogArticleRequest as UpdateRequest;

/**
 * Class BlogArticleController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BlogArticlesController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\BlogArticle');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/blog');
        $this->crud->setEntityNameStrings('article', 'articles');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'name' => 'image',
            'type' => 'image',
            'height' => '100px'
        ]);
        $this->crud->addColumn('name');
        $this->crud->addColumn('slug');
        $this->crud->addColumn([
            'name' => 'datetime',
            'label' => 'Date',
            'type' => 'text'
        ]);
        $this->crud->addColumn([
            'name' => 'enabled', // The db column name
            'label' => "Enabled", // Table column heading
            'type' => 'check'
        ]);

        $this->crud->addColumn('description_short');


        /**
         * fields
         */

        $this->crud->addField([
            'label' => "Name",
            'name' => "name",
            'type' => 'text',
            'tab' => 'Description'
        ]);

        $this->crud->addField([
            'label' => "Slug",
            'name' => "slug",
            'type' => 'text',
            'tab' => 'Description'
        ]);

        $this->crud->addField([
            'label' => "Enabled",
            'name' => "enabled",
            'type' => 'checkbox',
            'tab' => 'Description'
        ]);

        $this->crud->addField([
            'label' => "Date",
            'name' => "datetime",
            'type' => 'datetime_picker',
            'datetime_picker_options' => [
                'useCurrent' => true,
                'showClear' => true,
                'format' => 'YYYY-MM-DD HH:mm',
                'language' => 'en'
            ],
            'tab' => 'Description'
        ]);

        $this->crud->addField([
            'label' => "Image",
            'name' => "image",
            'type' => 'image',
            'upload' => false,
            'aspect_ratio' => 1,
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'name' => 'description_short',
            'label' => 'Short description',
            'type' => 'textarea',
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'name' => 'description_long',
            'label' => 'Long description',
            'type' => 'wysiwyg',
            'tab' => 'Description'
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


        // add asterisk for fields that are required in BlogArticleRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
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
