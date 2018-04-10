<?php

namespace De\Idrinth\Test\SimpleConsole;

interface Application
{
    /**
     * @return int exit code
     */
    public function run();

    /**
     * @param \De\Idrinth\SimpleConsole\Interfaces\Command $command
     * @return Application
     */
    public function register(Command $command);
}