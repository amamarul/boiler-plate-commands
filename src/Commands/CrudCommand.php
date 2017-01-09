<?php

namespace Amamarul\BoilerPlateCommands\Commands;

use Illuminate\Console\Command;

class CrudCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'amamarul:crud {name} {tabla} {seccion} {grupo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create AmamarulCrud';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'AmamarulCrud';

    /**
      * Execute the console command.
      *
      * @return mixed
      */
     public function handle()
     {
        /**
         * Model
         */
        if ($this->argument('grupo') !== null) {
             $this->call('amamarul:model', [
                 'name' => $this->argument('name'),
                 'tabla' => $this->argument('tabla'),
                 'grupo' => $this->argument('grupo'),
             ]);
            } else {
                $this->call('amamarul:model', [
                    'name' => $this->argument('name'),
                    'tabla' => $this->argument('tabla'),
                ]);
        }
        /**
         * Request
         */
        if ($this->argument('seccion') !== null) {
             $this->call('amamarul:request', [
                 'name' => $this->argument('name').'FormRequest',
                 'tabla' => $this->argument('tabla'),
                 'seccion' => $this->argument('seccion'),
             ]);
            } else {
                $this->call('amamarul:request', [
                    'name' => $this->argument('name').'FormRequest',
                    'tabla' => $this->argument('tabla'),
                ]);
        }
        /**
         * Attribute Trait
         */
        if ($this->argument('grupo') !== null) {
            $this->call('amamarul:trait_attribute', [
                'modelo' => $this->argument('name'),
                'name' => $this->argument('name').'Attribute',
                'grupo' => $this->argument('grupo'),
            ]);
            } else {
                $this->call('amamarul:trait_attribute', [
                    'modelo' => $this->argument('name'),
                    'name' => $this->argument('name').'Attribute',
                ]);
        }
        /**
         * Relationship Trait
         */
        if ($this->argument('grupo') !== null) {
            $this->call('amamarul:trait_relationship', [
                'modelo' => $this->argument('name'),
                'name' => $this->argument('name').'Relationship',
                'grupo' => $this->argument('grupo'),
            ]);
            } else {
                $this->call('amamarul:trait_relationship', [
                    'modelo' => $this->argument('name'),
                    'name' => $this->argument('name').'Relationship',
                ]);
        }
        /**
         * Scope Trait
         */
        if ($this->argument('grupo') !== null) {
            $this->call('amamarul:trait_scope', [
                'modelo' => $this->argument('name'),
                'name' => $this->argument('name').'Scope',
                'grupo' => $this->argument('grupo'),
            ]);
            } else {
                $this->call('amamarul:trait_scope', [
                    'modelo' => $this->argument('name'),
                    'name' => $this->argument('name').'Scope',
                ]);
        }
        /**
         * Controller
         */
        if ($this->argument('grupo') !== null) {
            $this->call('amamarul:controller', [
                'name' => $this->argument('name').'Controller',
                'modelo_namespace' => $this->getModelNamespace(),
                'request_namespace' => $this->getRequestNamespace(),
                'tabla' => $this->argument('tabla'),
                'modelo' => $this->argument('name'),
                'seccion' => $this->argument('seccion'),
                'grupo' => $this->argument('grupo'),
            ]);
            } else {
                $this->call('amamarul:controller', [
                    'name' => $this->argument('name').'Controller',
                    'modelo_namespace' => $this->getModelNamespace(),
                    'request_namespace' => $this->getRequestNamespace(),
                    'tabla' => $this->argument('tabla'),
                    'modelo' => $this->argument('name'),
                    'seccion' => $this->argument('seccion'),
                ]);
        }
        /**
         * DataTable
         */
        if ($this->argument('grupo') !== null) {
            $this->call('amamarul:datatable', [
                'name' => $this->argument('name').'DataTable',
                'modelo_namespace' => $this->getModelNamespace(),
                'tabla' => $this->argument('tabla'),
                'modelo' => $this->argument('name'),
                'seccion' => $this->argument('seccion'),
                'grupo' => $this->argument('grupo'),
            ]);
            } else {
                $this->call('amamarul:datatable', [
                    'name' => $this->argument('name').'DataTable',
                    'modelo_namespace' => $this->getModelNamespace(),
                    'tabla' => $this->argument('tabla'),
                    'modelo' => $this->argument('name'),
                    'seccion' => $this->argument('seccion'),
                ]);
        }
        /**
         * Routes
         */
        if ($this->argument('grupo') !== null) {
            $this->call('amamarul:routes', [
                'name' => $this->argument('name'),
                'seccion' => $this->argument('seccion'),
                'grupo' => $this->argument('grupo'),
            ]);
            } else {
                $this->call('amamarul:routes', [
                    'name' => $this->argument('name'),
                    'seccion' => $this->argument('seccion'),
                ]);
        }
        /**
         * Breadcrumbs
         */
        if ($this->argument('grupo') !== null) {
            $this->call('amamarul:breadcrumbs', [
                'name' => $this->argument('name'),
                'seccion' => $this->argument('seccion'),
                'grupo' => $this->argument('grupo'),
            ]);
            } else {
                $this->call('amamarul:breadcrumbs', [
                    'name' => $this->argument('name'),
                    'seccion' => $this->argument('seccion'),
                ]);
        }

    }

    /**
     * Get the default namespace for the Model class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
     protected function getModelNamespace()
     {
         if ($this->argument('grupo') !== null) {
             return 'App\Models\\'.$this->argument('grupo').'\\'.$this->argument('name');
         } else {
             return 'App\Models\\'.$this->argument('name');
         }
     }

    /**
     * Get the default namespace for the Model class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
     protected function getRequestNamespace()
     {
         if ($this->argument('seccion') !== null) {
             return 'App\Http\Requests\\'.$this->argument('seccion');
         } else {
             return 'App\Http\Requests';
         }
     }
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name'],
            ['tabla'],
            ['seccion'],
            ['grupo'],
        ];
    }
}
