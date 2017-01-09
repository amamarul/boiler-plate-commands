<?php

namespace Amamarul\BoilerPlateCommands\Commands\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class TraitRelationshipMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'amamarul:trait_relationship {modelo} {name} {grupo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Relationship trait for Model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'TraitRelationship';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/trait.stub';
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
            return $rootNamespace.'\Models\\'.$this->argument('grupo').'\\'.$this->argument('modelo').'\Relationship';
        } else {
            return $rootNamespace.'\Models\\'.$this->argument('modelo').'\Relationship';
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
