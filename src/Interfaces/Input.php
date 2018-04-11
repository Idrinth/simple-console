<?php

namespace De\Idrinth\SimpleConsole\Interfaces;

use InvalidArgumentException;

interface Input
{
    /**
     * @param string $name
     * @return boolean
     */
    public function has($name);

    /**
     * @throws InvalidArgumentException
     * @param string $name
     * @return mixed
     */
    public function get($name);
}