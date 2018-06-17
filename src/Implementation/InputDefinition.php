<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\InputDefinition as InputDefinitionInterface;
use InvalidArgumentException;

abstract class InputDefinition implements InputDefinitionInterface
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
     * @return mixed
     */
    protected function getDefault()
    {
        return $this->default;
    }

    /**
     * @return string
     */
    protected function getRegex()
    {
        return $this->regex;
    }

    /**
     * @return boolean
     */
    public function isBoolean()
    {
        return $this->boolean;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    abstract protected function processValue($value);

    /**
     * @param string $value
     * @return boolean
     * @throws InvalidArgumentException
     */
    protected function matchesRegex($value)
    {
        if (!$this->regex) {
            return true;
        }
        if (preg_match('/^'.$this->regex.'$/', "$value")) {
            return true;
        }
        throw new InvalidArgumentException("$this->name doesn't match expected format '$this->regex'.");
    }

    /**
     * @param mixed $value
     * @return array
     */
    private function getReturn($value)
    {
        if ($value === null) {
            return array();
        }
        return array($this->name => $value);
    }

    /**
     * @param mixed $input
     * @return array
     * @throws InvalidArgumentException
     */
    final public function process($input)
    {
        if ((empty($input) || !is_array($input) || !array_key_exists($this->name, $input))) {
            if ($this->required) {
                throw new InvalidArgumentException("$this->name is required.");
            }
            return $this->getReturn($this->default);
        }
        return $this->getReturn($this->processValue($input[$this->name]));
    }
}
