<?php
namespace De\Idrinth\SimpleConsole\Implementation\InputDefinition;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition;

class BoolDefinition extends InputDefinition
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name, false, true, '', false);
    }

    /**
     * @param mixed $input
     * @return boolean
     */
    public function processValue($input)
    {
        return true;
    }
}
