<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ActivityRequest as StoreRequest;
use App\Http\Requests\ActivityRequest as UpdateRequest;

/**
 * Class ActivityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ActivitiesController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Activity');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/activities');
        $this->crud->setEntityNameStrings('activity', 'activities');

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
        $this->crud->addColumn('description');



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
            'name' => "image",
            'type' => 'image',
            'aspect_ratio' => 1,
            'tab' => 'Description'
        ]);
        $this->crud->addField([
            'name' => 'description',
            'label' => 'Description',
            'type' => 'textarea',
            'tab' => 'Description'
        ]);

        $this->crud->addField([
            'name' => 'scores',
            'label' => "Scores",
            'type' => 'scores',
            'tab' => 'Scores of categories'
        ]);


        // add asterisk for fields that are required in ActivityRequest
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
