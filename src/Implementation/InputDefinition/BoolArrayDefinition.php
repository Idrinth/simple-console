<?php
namespace De\Idrinth\SimpleConsole\Implementation\InputDefinition;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition;

class BoolArrayDefinition extends InputDefinition
{
    public function __construct($name, $required, $default)
    {
        parent::__construct($name, $required, true, '', $default);
    }
}
