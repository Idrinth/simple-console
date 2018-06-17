<?php

namespace De\Idrinth\SimpleConsole\Interfaces;

interface Output
{
    /**
     * @param string $message
     */
    public function info($message);

    /**
     * @param string $message
     */
    public function success($message);

    /**
     * @param string $message
     */
    public function warning($message);

    /**
     * @param string $message
     */
    public function error($message);
}
