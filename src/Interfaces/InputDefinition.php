<?php

namespace De\Idrinth\SimpleConsole\Interfaces;

interface InputDefinition
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return boolean
     */
    public function isOption();

    /**
     * @return boolean
     */
    public function isRequired();

    /**
     * @return boolean
     */
    public function isBoolean();

    /**
     * @return boolean
     */
    public function isArray();

    /**
     * @param mixed $input
     * @return boolean
     */
    public function isValid($input);
}