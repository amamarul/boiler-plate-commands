# BoilerPlateCommands
Package to generate automatic cruds for Laravel BoilerPlate Apps [Boilerplate]https://github.com/rappasoft/laravel-5-boilerplate

The amamarul:crud make:
    1 - Model
        2 - Model Trait Attribute
        3 - Model Trait Relationship
        4 - Model Trait Scope
    5 - Form Request
    6 - Controller
        7 - Datatable as Service for Controller
    8 - Routes
    9 - Breadcrumbs

# Install Boilerplate

``` bash
$ git clone https://github.com/rappasoft/laravel-5-boilerplate.git
```

``` bash
$ cd laravel-5-boilerplate
```

``` bash
$ composer install
```
## Duplicate .env.example and rename to .env

``` bash
$ php artisan key:generate
```
## Set Database in .env

# Install Package (Laravel)

## Via Composer

``` bash
$ composer require amamarul/boiler-plate-commands
```

## Add the following to the AppServiceProvider in the register function:
### app/Providers/AppServiceProvider.php
``` php
/*
 * Load third party local providers
 */
$this->app->register(\Amamarul\BoilerPlateCommands\Providers\BoilerPlateCommandsServiceProvider::class);
```

## The register function should look like this
``` php
public function register()
{
    /*
     * Sets third party service providers that are only needed on local/testing environments
     */
    if ($this->app->environment() == 'local' || $this->app->environment() == 'testing') {
        /**
         * Loader for registering facades.
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        /*
         * Load third party local providers
         */
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);

        /*
         * Load third party local aliases
         */
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);

        /*
         * Load third party local providers
         */
        $this->app->register(\Amamarul\BoilerPlateCommands\Providers\BoilerPlateCommandsServiceProvider::class);
    }
}
```

## Publish the views
``` bash
$ php artisan vendor:publish --provider='Amamarul\BoilerPlateCommands\Providers\BoilerPlateCommandsServiceProvider'
```
# Usage

You need the tables migrated

## create migration
``` bash
$ php artisan make:migration create_products_table
```
``` php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
```
## Migrate
``` bash
$ php artisan migrate
```
# Make the Crud
Run the following commands
**amamarul:crud {name} {tabla} {seccion} {grupo?}**
    * **name:** Is the Model Name
    * **tabla:** Is the table name
    * **seccion:** can be 'Backend', 'Frontend' or the section you want
    * **grupo:** if you want to group different Models and Controllers like sub sections. **this is optional**

**This is an example for Backend and the group 'Products'. Then you can to add another model/controller in that group**
``` bash
$ php artisan amamarul:crud Product products Backend Products
```
- **The result in console will be**
``` bash
Model created successfully.
Request created successfully.
TraitAttribute created successfully.
TraitRelationship created successfully.
TraitScope created successfully.
Controller created successfully.
DataTable created successfully.
Routes created successfully.
Breadcrumbs created successfully.
```
- **Run php artisan serve**
``` bash
$ php artisan serve
```
Now you can go to http://localhost:8000/admin/products/product and you will show the datatable.

Go to app/Http/Controllers/Backend/Products/DataTables/ProductDataTable.php and uncomment the fields you want to show in the datatable in the getColumns() function (the last function), by default you will see only 'id', 'created_at' and 'updated_at'.

## Contributing

Contributions are **welcome** and will be fully **credited**.

I accept contributions via Pull Requests

## Credits

- [Maru][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
