<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->setColumns(['name', 'email']);
        
        $this->crud->addColumn(
            [
                // 1-n relationship
                'label' => "Role", // Table column heading
                'type' => "select",
                'name' => 'role_id', // the column that contains the ID of that connected entity;
                'entity' => 'role', // the method that defines the relationship in your Model
                'attribute' => "name", // foreign key attribute that is shown to user
                'model' => "App\Models\Role", // foreign key model
            ]
        );
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Name"
        ]);

        $this->crud->addField([
            'name' => 'email',
            'type' => 'text',
            'label' => "E-mail"
        ]);

        $this->crud->addField([
            'name' => 'password',
            'label' => 'Password',
            'type' => 'password'
        ]);

        $this->crud->addField([  // Select
            'label' => "Role",
            'type' => 'select',
            'name' => 'role_id', // the db column for the foreign key
            'entity' => 'role', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Role",
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
