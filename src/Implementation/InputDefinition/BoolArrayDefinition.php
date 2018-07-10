<?php
namespace De\Idrinth\SimpleConsole\Implementation\InputDefinition;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition;

class BoolArrayDefinition extends InputDefinition
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name, false, true, '', 0);
    }

    /**
     * @param mixed $input
     * @return int
     */
    protected function processValue($input)
    {
        if (is_array($input)) {
            return count($input);
        }
        return 1;
    }
}
