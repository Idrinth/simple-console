<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Command as CommandInterface;
use De\Idrinth\SimpleConsole\Interfaces\Output as OutputInterface;
use De\Idrinth\SimpleConsole\Interfaces\Input as InputInterface;

abstract class Command implements CommandInterface
{
    /**
     * @return string
     */
    public function getName()
    {

    }

    /**
     * @return InputDefinition[]
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