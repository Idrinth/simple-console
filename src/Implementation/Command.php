<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Command as CommandInterface;
use De\Idrinth\SimpleConsole\Interfaces\Output as OutputInterface;
use De\Idrinth\SimpleConsole\Interfaces\Input as InputInterface;
use De\Idrinth\SimpleConsole\Interfaces\InputDefinition as InputDefinitionInterface;

abstract class Command implements CommandInterface
{
    /**
     * @param string $name
     * @param InputDefinitionInterface $definitions
     */
    public function __construct($name, array $definitions = array())
    {

    }

    /**
     * @return string
     */
    public function getName()
    {

    }

    /**
     * @return InputDefinitionInterface[]
     */
    public function getDefinition()
    {

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int exit code
     */
    abstract public function execute(InputInterface $input, OutputInterface $output);
}