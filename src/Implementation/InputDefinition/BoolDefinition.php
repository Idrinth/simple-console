<?php
namespace De\Idrinth\SimpleConsole\Implementation\InputDefinition;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition;

class BoolDefinition extends InputDefinition
{
    public function __construct($name)
    {
        parent::__construct($name, false, true, '', false);
    }
}
