<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DropzoneRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProductsController extends CrudController
{
    public function setup()
    {
        $month = [
            0 => 'ALL YEAR',
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',];
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/products');
        $this->crud->setEntityNameStrings('product', 'products');

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
        $this->crud->addColumn([
            'label' => 'URL',
            'type' => 'url',
            'name' => 'slug',
            'options' => [
                'slug_path' => 'experience'
            ]
        ]);


        $this->crud->addColumn([
//            'label' => 'Countries',
            'type' => "select_multiple",
            'name' => 'countries',
            'entity' => 'countries',
            'attribute' => "name",
            'model' => "App\Models\Countries"

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
            'type' => 'slug',
            'options' => [
                'slug_path' => 'experience'
            ],
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'label' => "Enabled",
            'name' => "enabled",
            'type' => 'checkbox',
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'label' => "Price",
            'name' => "price",
            'type' => 'number',
//             'attributes' => ["step" => "any"], // allow decimals
             'prefix' => "£",
//             'suffix' => ".00",
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'label' => "Main Image",
            'name' => "image",
            'type' => 'image',
            'upload' => false,
            'aspect_ratio' => 1,
            'tab' => 'Images'
        ]);
        $this->crud->addField([
            'label' => "Image for Background",
            'name' => "image_background",
            'type' => 'image',
            'upload' => false,
            'aspect_ratio' => 1,
            'tab' => 'Images'
        ]);
        $this->crud->addField([
            'name' => 'gallery', // db column name
            'label' => 'Gallery', // field caption
            'type' => 'dropzone', // voodoo magic
            'prefix' => '/uploads/', // upload folder (should match the driver specified in the upload handler defined below)
            'entityType' => 'products',
            'upload-url' => 'dropzone-upload', // POST route to handle the individual file uploads
            'tab' => 'Images'
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
            'name' => 'countries',
            'entity' => 'countries',
            'label' => "Countries",
            'type' => 'select2_multiple',
            'attribute' => 'name',
            'pivot' => true,
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'name' => 'city',
            'label' => "City",
            'type' => 'text',
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'name' => 'experiences',
            'entity' => 'experiences',
            'label' => "Experiences",
            'type' => 'select2_multiple',
            'attribute' => 'name',
            'pivot' => true,
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'label' => "Highlights",
            'name' => "highlights",
            'type' => 'text',
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'name' => 'minDuration',
            'label' => 'Minumim duration (days)',
            'type' => 'number',
            'tab' => 'Description'
        ]);

        $this->crud->addField([
            'name' => 'maxDuration',
            'label' => 'Maximum duration (days)',
            'type' => 'number',
            'tab' => 'Description'
        ]);

        $this->crud->addField([
            'name' => 'months',
            'label' => "Months",
            'type' => 'select2_from_array',
            'options' => $month,
//            'default' => 0,
            'allows_null' => false,
            'allows_multiple' => true,
            'tab' => 'Description'
        ]);

        $this->crud->addField([
            'name' => 'travel_styles',
            'label' => "Travel styles",
            'type' => 'select2_from_array',
            'options' => config('questions.q_travel_style'),
            'allows_null' => false,
            'allows_multiple' => true,
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'name' => 'sights',
            'label' => "Preferred sights",
            'type' => 'select2_from_array',
            'options' => config('questions.q_preferred_sight'),
            'allows_null' => false,
            'allows_multiple' => true,
            'tab' => 'Description'
        ]);

        $this->crud->addField([
            'name' => 'scores',
            'label' => "Scores",
            'type' => 'scores',
            'tab' => 'Scores of categories'
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


        // add asterisk for fields that are required in ProductRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        $request = SeoController::cutSeoFields($request);
        $redirect_location = parent::storeCrud($request);
        SeoController::addSeoFields(get_class($this->crud->model), $this->data['entry']->id);

        $this->saveScores($request, $this->data['entry']);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        if (empty ($request->get('gallery'))) {
            $this->crud->update(\Request::get($this->crud->model->getKeyName()), ['gallery' => '[]']);
        }
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        $this->saveScores($request, $this->data['entry']);

        return $redirect_location;
    }

    protected function saveScores($request, $model) {
        $scores = [];

        foreach ($request->input() as $key => $value) {

            $categoryId = explode("category-", $key)[1] ?? false;

            if($categoryId) {
                $scores[$categoryId] = $value;
            }

        }
        $model->scores = $scores;
        $model->save();

    }

    public function handleDropzoneUpload(DropzoneRequest $request)
    {
        try
        {
            $path = uploadImage($request->entityType, $request->file('file'));

            return response()->json(['success' => true, 'filename' => $path]);
        }
        catch (\Exception $e)
        {
            if (empty ($path)) {
                return response('Not a valid image type', 412);
            } else {
                return response('Unknown error', 412);
            }
        }
    }
}
