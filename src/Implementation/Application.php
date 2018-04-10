<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Command as CommandInterface;
use De\Idrinth\SimpleConsole\Interfaces\Application as ApplicationInterface;

class Application implements ApplicationInterface
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {

    }

    /**
     * @return int exit code
     */
    public function run()
    {
        
    }

    /**
     * @param CommandInterface $command
     * @return Application
     */
    public function register(CommandInterface $command)
    {

    }
}