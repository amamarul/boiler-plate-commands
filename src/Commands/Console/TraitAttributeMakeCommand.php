<?php

namespace Amamarul\BoilerPlateCommands\Commands\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class TraitAttributeMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'amamarul:trait_attribute {modelo} {name} {grupo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Attribute trait for Model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'TraitAttribute';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/attribute.stub';
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
            return $rootNamespace.'\Models\\'.$this->argument('grupo').'\\'.$this->argument('modelo').'\Attribute';
        } else {
            return $rootNamespace.'\Models\\'.$this->argument('modelo').'\Attribute';
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
            ['modelo'],
            ['name'],
            ['grupo'],
        ];
    }
}
