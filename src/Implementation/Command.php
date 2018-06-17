<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Command as CommandInterface;
use De\Idrinth\SimpleConsole\Interfaces\Output as OutputInterface;
use De\Idrinth\SimpleConsole\Interfaces\Input as InputInterface;
use De\Idrinth\SimpleConsole\Interfaces\InputDefinition as InputDefinitionInterface;

abstract class Command implements CommandInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var InputDefinitionInterface[]
     */
    private $definitions = array();

    /**
     * @param string $name
     * @param InputDefinitionInterface[] $definitions
     */
    public function __construct($name, array $definitions = array())
    {
        $this->name = $name;
        foreach($definitions as $definition) {
            if($definition instanceof InputDefinitionInterface && !in_array($definition, $this->definitions)) {
                $this->definitions[] = $definition;
            }
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return InputDefinitionInterface[]
     */
    public function getDefinition()
    {
        return $this->definitions;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int exit code
     */
    abstract public function execute(InputInterface $input, OutputInterface $output);
}