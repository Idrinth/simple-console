<?php

namespace De\Idrinth\SimpleConsole\Interfaces;

interface Application
{
    /**
     * @return int exit code
     */
    public function run();

    /**
     * @param Command $command
     * @return Application
     */
    public function register(Command $command);
}
