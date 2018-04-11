<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use InvalidArgumentException;
use De\Idrinth\SimpleConsole\Interfaces\Input as InputInterface;

class Input implements InputInterface
{

    /**
     * @var array
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function has($name)
    {
        return (array_key_exists($name, $this->data)) ?: call_user_func(function () {
            throw new InvalidArgumentException();
        });
    }

    /**
     * @throws InvalidArgumentException
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->data[$name];
    }
}