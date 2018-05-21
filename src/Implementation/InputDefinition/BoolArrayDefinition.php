<?php
namespace De\Idrinth\SimpleConsole\Implementation\InputDefinition;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition;

class BoolArrayDefinition extends InputDefinition
{
    public function __construct($name)
    {
        parent::__construct($name, false, true, '', 0);
    }
}
