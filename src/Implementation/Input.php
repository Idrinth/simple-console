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
        return (array_key_exists($name, $this->data));
    }

    /**
     * @throws InvalidArgumentException
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        throw new InvalidArgumentException($name . ' is unknown.');
    }
}
