<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\InputDefinition as InputDefinitionInterface;

class InputDefinition implements InputDefinitionInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $required;

    /**
     * @var bool
     */
    private $boolean;

    /**
     * @var string
     */
    private $regex;

    /**
     * @var mixed
     */
    private $default;

    /**
     * @param string $name
     * @param boolean $required
     * @param boolean $boolean
     * @param string $regex
     * @param mixed $default
     */
    public function __construct($name, $required, $boolean, $regex, $default)
    {
        $this->name = $name;
        $this->required = $required;
        $this->boolean = $boolean;
        $this->regex = $regex;
        $this->default = $default;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @return boolean
     */
    public function isBoolean()
    {
        return $this->boolean;
    }

    /**
     * apply defaults and constraints and return cleaned array
     * @param array $input
     * @return array
     * @throws \InvalidArgumentException if it's required or missing or doesn't match the constraints
     */
    public function process($input)
    {

        if(empty($input) && $this->isRequired()){
            throw new \InvalidArgumentException("$this->name is required");
        }
        return array(
            $this->name => $this->default
        );
    }
}