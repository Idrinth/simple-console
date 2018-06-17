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
     * @param Input $input
     * @param Output $output
     * @return int exit code
     */
    public function execute(Input $input, Output $output);
}
