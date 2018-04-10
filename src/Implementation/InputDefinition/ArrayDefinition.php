<?php
namespace De\Idrinth\SimpleConsole\Implementation\InputDefinition;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition;

class ArrayDefinition extends InputDefinition
{
    public function __construct($name, $required, $regex, $default)
    {
        parent::__construct($name, $required, false, $regex, $default);
    }
}
