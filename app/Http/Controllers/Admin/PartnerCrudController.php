<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PartnerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PartnerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PartnerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Partner');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/partner');
        $this->crud->setEntityNameStrings('partner', 'partners');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PartnerRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Partner name"
        ]);

        $this->crud->addField([
            'name' => 'contact_name',
            'type' => 'text',
            'label' => "Contact Person"
        ]);

        $this->crud->addField([
            'name' => 'contact_phone',
            'type' => 'text',
            'label' => "Phone Number"
        ]);

        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Users",
            'type'      => 'select2_multiple',
            'name'      => 'users', // the method that defines the relationship in your Model
            'entity'    => 'users', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\User", // foreign key model
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?

            // optional
            'options'   => (function ($query) {
                return $query->where('role_id', 2)->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        $this->crud->addField([   // Table
            'label' => 'Discount Categories',
            'type' => 'discount_partner',
            'name' => 'discounts',
            'entity_singular' => 'discount', // used on the "Add X" button
            'columns' => [
                'name' => 'Name',
                'slug' => 'Slug',
            ],
            'max' => 5, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
