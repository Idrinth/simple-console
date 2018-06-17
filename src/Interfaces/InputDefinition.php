<?php

namespace De\Idrinth\SimpleConsole\Interfaces;

interface InputDefinition
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return boolean
     */
    public function isRequired();

    /**
     * @return boolean
     */
    public function isBoolean();

    /**
     * apply defaults and constraints and return cleaned array
     * @param array $input
     * @return array
     * @throws InvalidArgumentException if it's required or missing or doesnn't match the constraints
     */
    public function process($input);
}
