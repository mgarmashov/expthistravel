<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DropzoneRequest;
use App\Models\Product;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ItinerariesController extends CrudController
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
        $this->crud->setModel('App\Models\Itinerary');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/itineraries');
        $this->crud->setEntityNameStrings('itinerary', 'itineraries');

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
                'slug_path' => 'itinerary'
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
            'tab' => 'General'
        ]);
        $this->crud->addField([
            'label' => "Slug",
            'name' => "slug",
            'type' => 'slug',
            'options' => [
                'slug_path' => 'itinerary'
            ],
            'tab' => 'General'
        ]);
        $this->crud->addField([
            'label' => "Enabled",
            'name' => "enabled",
            'type' => 'checkbox',
            'tab' => 'General'

        ]);
        $this->crud->addField([
            'label' => "Price",
            'name' => "price",
            'type' => 'number',
            'prefix' => "£",
            'tab' => 'General'
        ]);
        $this->crud->addField([
            'label' => "Main image",
            'name' => "image_main",
            'type' => 'image',
            'upload' => false,
            'aspect_ratio' => 1,
            'tab' => 'Images'
        ]);
        $this->crud->addField([
            'label' => "Image with map / plan",
            'name' => "image_map",
            'type' => 'image',
            'upload' => false,
            'aspect_ratio' => 1,
            'tab' => 'Images'
        ]);
        $this->crud->addField([
            'label' => "Background image",
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
            'articleType' => 'itineraries',
            'upload-url' => 'dropzone-upload', // POST route to handle the individual file uploads
            'tab' => 'Images'
        ]);
        $this->crud->addField([
            'name' => 'description_short',
            'label' => 'Short description',
            'type' => 'textarea',
            'tab' => 'General'
        ]);
        $this->crud->addField([
            'name' => 'description_long',
            'label' => 'Long description',
            'type' => 'wysiwyg',
            'tab' => 'General'
        ]);
        $this->crud->addField([
            'name' => 'countries',
            'entity' => 'countries',
            'label' => "Countries",
            'type' => 'select2_multiple',
            'attribute' => 'name',
            'pivot' => true,
            'tab' => 'General'
        ]);

        $this->crud->addField([
        'name' => 'products',
        'label' => "Experiences",
        'type' => 'select_and_order',
        'options'   => Product::where('enabled', 1)->get()->pluck('name','id')->toArray(),
        'tab' => 'Additional'
    ]);
        $this->crud->addField([
            'name' => 'highlights',
            'label' => 'Highlights',
            'type' => 'textarea',
            'tab' => 'Additional'
        ]);
        $this->crud->addField([
            'name' => 'transport',
            'label' => 'Transport',
            'type' => 'wysiwyg',
            'tab' => 'Additional'
        ]);
        $this->crud->addField([
            'name' => 'experiences',
            'entity' => 'experiences',
            'label' => "Experiences",
            'type' => 'select2_multiple',
            'attribute' => 'name',
            'pivot' => true,
            'tab' => 'General'
        ]);
        $this->crud->addField([
            'name' => 'city',
            'label' => "City",
            'type' => 'text',
            'tab' => 'General'
        ]);
        $this->crud->addField([
            'name' => 'map_url',
            'label' => 'Link to Google map',
            'type' => 'text',
            'placeholder' => "https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d17456.849145567725!2d60.639861444042985!3d56.84412317246239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e0!4m5!1s0x0%3A0x1939845025e66d85!2z0JHQtdGB0LXQtNC60Lgg0L3QsCDQqNCw0YDRgtCw0YjQtSDQmtCw0LzQtdC90L3Ri9C5INC_0LvRj9C2!3m2!1d56.8481666!2d60.688004299999996!4m3!3m2!1d56.871339899999995!2d60.5220159!5e0!3m2!1sru!2sru!4v1575195449551!5m2!1sru!2sru",
            'tab' => 'General'
        ]);
        $this->crud->addField([
            'name' => 'minDuration',
            'label' => 'Minumim duration (days)',
            'type' => 'number',
            'tab' => 'General'
        ]);

        $this->crud->addField([
            'name' => 'maxDuration',
            'label' => 'Maximum duration (days)',
            'type' => 'number',
            'tab' => 'General'
        ]);

        $this->crud->addField([
            'name' => 'months',
            'label' => "Months",
            'type' => 'select2_from_array',
            'options' => $month,
//            'default' => 0,
            'allows_null' => false,
            'allows_multiple' => true,
            'tab' => 'General'
        ]);

        $this->crud->addField([
            'name' => 'travel_styles',
            'label' => "Travel styles",
            'type' => 'select2_from_array',
            'options' => config('questions.q_travel_style'),
            'allows_null' => false,
            'allows_multiple' => true,
            'tab' => 'General'
        ]);
        $this->crud->addField([
            'name' => 'sights',
            'label' => "Preferred sights",
            'type' => 'select2_from_array',
            'options' => config('questions.q_preferred_sight'),
            'allows_null' => false,
            'allows_multiple' => true,
            'tab' => 'General'
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
            $path = uploadImage('itineraries', $request->file('file'));

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
