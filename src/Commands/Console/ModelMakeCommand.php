<?php

namespace Amamarul\BoilerPlateCommands\Commands\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;


use DB;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'amamarul:model {name} {tabla} {grupo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->argument('grupo') !== null) {
            return $rootNamespace.'\Models\\'.$this->argument('grupo').'\\'.$this->argument('name');
        } else {
            return $rootNamespace.'\Models\\'.$this->argument('name');
        }
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $fields = "'".implode("','",$this->getTableFields())."'";

        $stub = str_replace(
            'DummyNamespace', $this->getNamespace($name), $stub
        );

        $stub = str_replace(
            'DummyRootNamespace', $this->laravel->getNamespace(), $stub
        );

        $stub = str_replace(
            'DummyFullModelTraitClass', $this->laravel->getNamespace().'Trait', $stub
        );

        $stub = str_replace(
            'DummyModelTraitClass', $this->laravel->getNamespace().'Trait', $stub
        );

        $stub = str_replace(
            'DummyTable', $this->argument('tabla'), $stub
        );

        $stub = str_replace(
            'DummyFields', $fields, $stub
        );

        return $this;
    }

    protected function getTableFields() {

        $table = $this->argument('tabla');
            $columns = DB::getSchemaBuilder()->getColumnListing($this->argument('tabla'));
            return $columns;
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
            ['grupo'],
        ];
    }
}
