<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CategoryRequest as StoreRequest;
use App\Http\Requests\CategoryRequest as UpdateRequest;

/**
 * Class CountriesController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class OrdersController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Order');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/orders');
        $this->crud->setEntityNameStrings('order', 'orders');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'name' => 'user',
            'Label' => 'User',
            'type' => "model_function",
            'function_name' => 'getUserNameEmail',
        ]);
        $this->crud->addColumn('comment');
        $this->crud->addColumn('created_at');
        $this->crud->addColumn('amount');

        /**
         * fields
         */
        $this->crud->addField([
            'label' => "Status",
            'name' => "status",
            'type' => 'select_from_array',
            'options' => ['pending' => 'Pending', 'paid' => 'Paid', 'cancelled' => 'Cancelled'],
            'allows_null' => false,

        ]);
        $this->crud->addField([
            'label' => "Amount",
            'name' => "amount",
            'type' => 'text'

        ]);
        $this->crud->addField([
            'name' => 'comment',
            'label' => 'Comment',
            'type' => 'wysiwyg'
        ]);

        // add asterisk for fields that are required in ActivityCategoryRequest
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
