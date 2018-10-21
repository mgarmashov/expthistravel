<?php

namespace App\Http\Controllers\Admin;

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
            'name' => 'img',
            'type' => 'image',
            'height' => '100px'
        ]);
        $this->crud->addColumn('name');


        $this->crud->addColumn('country');
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
            'label' => "Image",
            'name' => "img",
            'type' => 'image',
            'upload' => true,
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
            'name' => 'scores',
            'label' => "Scores",
            'type' => 'scores',
            'tab' => 'Scores of categories'
        ]);



        // add asterisk for fields that are required in ProductRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        $this->saveScores($request, $this->data['entry']);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
//        dd($request);
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
}
