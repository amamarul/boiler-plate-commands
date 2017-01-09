<?php

namespace Amamarul\BoilerPlateCommands\Commands\Console;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use DB;

class ControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'amamarul:controller {name} {modelo_namespace} {request_namespace} {tabla} {modelo} {seccion} {grupo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/controller.model2.stub';
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
            return $rootNamespace.'\Http\Controllers\\'.$this->argument('seccion').'\\'.$this->argument('grupo');
        } else {
            return $rootNamespace.'\Http\Controllers\\'.$this->argument('seccion');
        }
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        if ($this->argument('seccion') === 'Backend') {
            $seccion = 'admin';
        } else {
            $seccion = strtolower($this->argument('seccion'));
        }
        $replace = [
            'DummyNamespace' => $this->getNamespace($name),
            'DummyClass' => $this->argument('name'),
            'DummyFullModelClass' => $this->argument('modelo_namespace').'\\'.$this->argument('modelo'),
            'DummyFullRequestClass' => $this->argument('request_namespace').'\\'.$this->argument('modelo').'FormRequest',
            'DummyModelClass' => $this->argument('modelo'),
            'DummyModelVariable' => lcfirst($this->argument('modelo')),

            'DummyFormFields' => $this->getFieldsForm(),
            'DummyFormShow' => $this->getFieldsShow(),

            'DummySeccion' => $seccion,
            'DummyGrupo' => $this->argument('grupo') ? strtolower($this->argument('grupo').'.') : '',
        ];

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function getTableFields() {

        $table = $this->argument('tabla');
            $columns = DB::getSchemaBuilder()->getColumnListing($this->argument('tabla'));
            return $columns;
    }

    protected function getFieldsForm(){

        $fields = '';
            foreach ($this->getTableFields() as $value) {
                $fields .= "        \Form::bsText('" .$value."',old('".$value."') ?: $".lcfirst($this->argument('modelo'))."->".$value.",['placeholder' => '".$value."']),\n";
            }
        return $fields ;
    }

    protected function getFieldsShow(){

        $fields = '';
            foreach ($this->getTableFields() as $value) {
                $fields .= "        \Form::bsText_show('" .$value."',old('".$value."') ?: $".lcfirst($this->argument('modelo'))."->".$value.",['placeholder' => '".$value."']),\n";
            }
        return $fields ;
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
            ['modelo_namespace'],
            ['request_namespace'],
            ['tabla'],
            ['modelo'],
            ['seccion'],
            ['grupo'],
        ];
    }
}
