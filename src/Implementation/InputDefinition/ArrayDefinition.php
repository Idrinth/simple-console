<?php
namespace De\Idrinth\SimpleConsole\Implementation\InputDefinition;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition;
use InvalidArgumentException;

class ArrayDefinition extends InputDefinition
{
    /**
     * @param string $name
     * @param boolean $required
     * @param string $regex
     * @param mixed $default
     */
    public function __construct($name, $required = false, $regex = '', $default = null)
    {
        parent::__construct($name, $required, false, $regex, $default);
    }

    /**
     * @param mixed $input
     * @return mixed
     */
    public function processValue($input)
    {
        if($input === null || $input === '') {
            if($this->isRequired()) {
                throw new InvalidArgumentException("{$this->getName()} is required.");
            }
            return $this->getDefault();
        }
        $data = array();
        foreach((array) $input as $el) {
            if(is_scalar($el) && strlen("$el") > 0 && $this->matchesRegex($el)) {
                $data[] = $el;
            }
        }
        if(count($data) === 0) {
            throw new InvalidArgumentException("{$this->getName()} is required.");
        }
        return $data;
    }
}
