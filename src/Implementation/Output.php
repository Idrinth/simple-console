<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Output as OutputInterface;

class Output implements OutputInterface
{

    private $formatReset = "[0m";

    private function output($format, $message){
        if(!empty($message)){
            echo $format.$message.$this->formatReset;
        }
        echo "\n";
    }

    /**
     * @param string $message
     */
    public function info($message)
    {
        $this->output("[37m[2m[3m", $message);
    }

    /**
     * @param string $message
     */
    public function success($message)
    {
        $this->output("[32m[1m", $message);
    }

    /**
     * @param string $message
     */
    public function warning($message)
    {
        $this->output("[33m", $message);
    }

    /**
     * @param string $message
     */
    public function error($message)
    {
        $this->output("[31m[1m", $message);
    }
}