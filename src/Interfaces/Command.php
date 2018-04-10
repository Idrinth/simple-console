<?php

namespace De\Idrinth\SimpleConsole\Interfaces;

interface Command
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return InputDefinition[]
     */
    public function getDefinition();

    /**
     * @param \De\Idrinth\SimpleConsole\Interfaces\Input $input
     * @param \De\Idrinth\SimpleConsole\Interfaces\Output $output
     * @return int exit code
     */
    public function execute(Input $input, Output $output);
}