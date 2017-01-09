<?php

namespace Amamarul\BoilerPlateCommands\Commands\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class BreadcrumbsMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'amamarul:breadcrumbs {name} {seccion} {grupo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register Breadcrumbs';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Breadcrumbs';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->argument('grupo') !== null) {
            return __DIR__.'/stubs/breadcrumb.group.stub';
        } else {
            return __DIR__.'/stubs/breadcrumb.stub';
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
            return $rootNamespace.'\Http\Breadcrumbs\\'.$this->argument('seccion').'\\'.$this->argument('grupo');
        } else {
            return $rootNamespace.'\Http\Breadcrumbs\\'.$this->argument('seccion');
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
            'DummyRoute' => lcfirst($this->argument('name')),
            'DummyCapsRoute' => $this->argument('name'),
            'DummySeccion' => $seccion,
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
