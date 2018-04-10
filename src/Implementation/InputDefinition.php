<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\InputDefinition as InputDefinitionInterface;

class InputDefinition implements InputDefinitionInterface
{
    /**
     * @param string $name
     * @param boolean $required
     * @param boolean $boolean
     * @param string $regex
     * @param mixed $default
     */
    public function __construct($name, $required, $boolean, $regex, $default)
    {

    }

    /**
     * @return string
     */
    public function getName()
    {

    }

    /**
     * @return boolean
     */
    public function isRequired()
    {

    }

    /**
     * @return boolean
     */
    public function isBoolean()
    {

    }

    /**
     * apply defaults and constraints and return cleaned array
     * @param array $input
     * @return array
     * @throws InvalidArgumentException if it's required or missing or doesnn't match the constraints
     */
    public function process($input)
    {

    }
}