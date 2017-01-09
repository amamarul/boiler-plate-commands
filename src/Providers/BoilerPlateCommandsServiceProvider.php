<?php namespace Amamarul\BoilerPlateCommands\Providers;

use Illuminate\Support\ServiceProvider;
use Amamarul\BoilerPlateCommands\Commands\Console\ModelMakeCommand;
use Amamarul\BoilerPlateCommands\Commands\Console\RequestMakeCommand;
use Amamarul\BoilerPlateCommands\Commands\Console\TraitAttributeMakeCommand;
use Amamarul\BoilerPlateCommands\Commands\Console\TraitRelationshipMakeCommand;
use Amamarul\BoilerPlateCommands\Commands\Console\TraitScopeMakeCommand;
use Amamarul\BoilerPlateCommands\Commands\Console\ControllerMakeCommand;
use Amamarul\BoilerPlateCommands\Commands\Console\DataTablesMakeCommand;
use Amamarul\BoilerPlateCommands\Commands\Console\RoutesMakeCommand;
use Amamarul\BoilerPlateCommands\Commands\Console\BreadcrumbsMakeCommand;
use Amamarul\BoilerPlateCommands\Commands\CrudCommand;

class BoilerPlateCommandsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'Amamarul');
		$this->publishes([
			__DIR__.'/../Views/datatable.blade.php' => resource_path('views/vendor/Amamarul/datatable.blade.php'),
		], 'views');
		$this->publishes([
			__DIR__.'/../Views/show.blade.php' => resource_path('views/vendor/Amamarul/show.blade.php'),
		], 'views');
        \Form::component('bsText', 'Amamarul::form.text', ['name', 'value', 'attributes']);
        \Form::component('bsEmail', 'Amamarul::form.email', ['name', 'value', 'attributes']);
        \Form::component('bsSubmit', 'Amamarul::form.submit', ['text', 'button_class', 'button_size']);
        \Form::component('bsText_show', 'Amamarul::form.text_show', ['name', 'value']);
        \Form::component('bs_box_link', 'Amamarul::form.box_link', ['link', 'title','param','button']);
    }

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CrudCommand::class,
            ModelMakeCommand::class,
                TraitAttributeMakeCommand::class,
                TraitRelationshipMakeCommand::class,
                TraitScopeMakeCommand::class,
            RequestMakeCommand::class,
            ControllerMakeCommand::class,
            DataTablesMakeCommand::class,
            RoutesMakeCommand::class,
            BreadcrumbsMakeCommand::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
