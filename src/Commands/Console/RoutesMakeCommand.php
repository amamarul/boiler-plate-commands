<?php

namespace Amamarul\BoilerPlateCommands\Commands\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class RoutesMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'amamarul:routes {name} {seccion} {grupo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register Routes';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Routes';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->argument('grupo') !== null) {
            return __DIR__.'/stubs/routes.group.stub';
        } else {
            return __DIR__.'/stubs/routes.stub';
        }
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
            return $rootNamespace.'\..\routes\\'.$this->argument('seccion').'\\'.$this->argument('grupo');
        } else {
            return $rootNamespace.'\..\routes\\'.$this->argument('seccion');
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
        $replace = [
            'DummyRoute' => lcfirst($this->argument('name')),
            'DummyController' => $this->argument('name').'Controller',
            'DummyGrupo' => $this->argument('grupo') ? $this->argument('grupo') : '',
            'DummyPrefixGrupo' => $this->argument('grupo') ? strtolower($this->argument('grupo')) : '',
        ];

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
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
            ['seccion'],
            ['grupo'],
        ];
    }
}
