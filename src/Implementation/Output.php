<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Output as OutputInterface;

class Output implements OutputInterface
{
    /**
     * @param string $message
     */
    public function info($message)
    {
        if(!empty($message)){
            echo "[37m[2m[3m".$message."[0m";
        }
        echo "\n";
    }

    /**
     * @param string $message
     */
    public function success($message)
    {
        if(!empty($message)){
            echo "[32m[1m".$message."[0m";
        }
        echo "\n";
    }

    /**
     * @param string $message
     */
    public function warning($message)
    {
        if(!empty($message)){
            echo "[33m".$message."[0m";
        }
        echo "\n";
    }

    /**
     * @param string $message
     */
    public function error($message)
    {
        if(!empty($message)){
            echo "[31m[1m".$message."[0m";
        }
        echo "\n";
    }
}