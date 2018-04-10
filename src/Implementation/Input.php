<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use InvalidArgumentException;
use De\Idrinth\SimpleConsole\Interfaces\Input as InputInterface;

class Input implements InputInterface
{
    /**
     * @param array $data
     */
    public function __construct(array $data)
    {

    }

    /**
     * @param string $name
     * @return boolean
     */
    public function has($name)
    {

    }

    /**
     * @throws InvalidArgumentException
     * @param type $name
     * @return mixed
     */
    public function get($name)
    {
        
    }
}