<?php

namespace Amamarul\BoilerPlateCommands\Commands\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use DB;

/**
 * Class DataTablesMakeCommand.
 *
 * @package Yajra\Datatables\Generators
 * @author  Arjay Angeles <aqangeles@gmail.com>
 */
class DataTablesMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'amamarul:datatables_make {name} {modelo_namespace} {tabla} {modelo} {seccion} {grupo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new DataTable service class.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'DataTable';

    /**
     * The model class to be used by dataTable.
     *
     * @var string
     */
    protected $model;

    /**
     * DataTable export filename.
     *
     * @var string
     */
    protected $filename;

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        if ($this->argument('seccion') === 'Backend') {
            $seccion = 'admin';
        } else {
            $seccion = strtolower($this->argument('seccion'));
        }
        $stub = str_replace(
            'DummyFields', $this->getFields(), $stub
        );
        $stub = str_replace(
            'DummyNamespace', $this->getNamespace($name), $stub
        );
        $stub = str_replace(
            'DummyFullModelClass', $this->argument('modelo_namespace').'\\'.$this->argument('modelo'), $stub
        );
        $stub = str_replace(
            'DummyModel', $this->argument('modelo'), $stub
        );
        $stub = str_replace(
            'DummyName', strtolower($this->argument('modelo')), $stub
        );
        $stub = str_replace(
            'DummyClass', $this->argument('name'), $stub
        );
        $stub = str_replace(
            'DummyFilename', $this->argument('modelo'), $stub
        );
        $stub = str_replace(
            'DummySeccion', $seccion, $stub
        );
        $stub = str_replace(
            'DummyGrupo', $this->argument('grupo') ? strtolower($this->argument('grupo')).'/' : '', $stub
        );

        return $this;
    }

    protected function getTableFields() {

        $table = $this->argument('tabla');
            $columns = DB::getSchemaBuilder()->getColumnListing($this->argument('tabla'));
            return $columns;
    }

    protected function getFields(){

        $fields = '';
            foreach ($this->getTableFields() as $value) {
                $fields .= "        // '" .$value."',\n";
            }
        return $fields ;
    }
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/datatables.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->argument('grupo') !== null) {
            return $rootNamespace.'\Http\Controllers\\'.$this->argument('seccion').'\\'.$this->argument('grupo').'\DataTables';
        } else {
            return $rootNamespace.'\Http\Controllers\\'.$this->argument('seccion').'\DataTables';
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
            ['modelo_namespace'],
            ['tabla'],
            ['modelo'],
            ['seccion'],
            ['grupo'],
        ];
    }

}
