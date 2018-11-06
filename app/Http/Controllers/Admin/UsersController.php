<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserRequest as StoreRequest;
use App\Http\Requests\UserRequest as UpdateRequest;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UsersController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/users');
        $this->crud->setEntityNameStrings('user', 'users');
        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn('name');
        $this->crud->addColumn('login');
        $this->crud->addColumn('email');
        $this->crud->addColumn([
            'name' => "is_approved",
            'label' => "Email approved",
            'type' => "model_function",
            'function_name' => 'emailApprovedStatus',
        ]);
        $this->crud->addColumn('role');

        /**
         * fields
         */
        $this->crud->addFields([
            [
                'label' => "Name",
                'name' => "name",
                'type' => 'text',
                'tab' => 'Description'
            ],
            [
                'label' => "Login",
                'name' => "login",
                'type' => 'text',
                'tab' => 'Description'
            ],
            [
                'label' => "Email",
                'name' => "email",
                'type' => 'text',
                'tab' => 'Description'
            ],
            [
                'label' => "Phone",
                'name' => "phone",
                'type' => 'text',
                'tab' => 'Description'
            ],
            [
                'label' => "Role",
                'name' => "role",
                'type' => 'select_from_array',
                'options' => ['user' => 'user', 'admin' => 'admin'],
                'allows_null' => true,
                'tab' => 'Description'
            ],
            [
                'label' => "Answers",
                'name' => "answers",
                'type' => 'answers',
                'tab' => 'Answers'
            ],
            [
                'label' => "Products in cart",
                'name' => "products",
                'type' => 'products',
                'tab' => 'Products in cart'
            ],
//            [
//                'label' => "Orders",
//                'name' => "id",
//                'type' => 'orders',
//                'tab' => 'Orders'
//            ],

        ]);


        // add asterisk for fields that are required in UserRequest
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
