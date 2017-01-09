<?php

namespace Amamarul\BoilerPlateCommands\Commands\Console;

use Illuminate\Console\GeneratorCommand;
use DB;

class RequestMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'amamarul:request {name} {tabla} {seccion?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form request class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/request.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->argument('seccion') !== null) {
            return $rootNamespace.'\Http\Requests\\'.$this->argument('seccion');
        } else {
            return $rootNamespace.'\Http\Requests';
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
        $stub = str_replace(
            'DummyFields', $this->getFields(), $stub
        );
        $stub = str_replace(
            'DummyNamespace', $this->getNamespace($name), $stub
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
                $fields .= "        // '" .$value."'  => 'required',\n";
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
            ['tabla'],
            ['seccion'],
        ];
    }
}
