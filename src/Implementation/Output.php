<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Output as OutputInterface;

class Output implements OutputInterface
{
    /**
     * @var string
     */
    public static $formatReset = "[0m";

    /**
     * @var string
     */
    public static $formatInfo = "[37m[2m[3m";

    /**
     * @var string
     */
    public static $formatSuccess = "[32m[1m";

    /**
     * @var string
     */
    public static $formatError = "[31m[1m";

    /**
     * @var string
     */
    public static $formatWarning = "[33m";

    /**
     * @param string $format
     * @param string $message
     */
    private function output($format, $message){
        if(!empty($message)){
            echo $format.$message.self::$formatReset;
        }
        echo "\n";
    }

    /**
     * @param string $message
     */
    public function info($message)
    {
        $this->output(self::$formatInfo, $message);
    }

    /**
     * @param string $message
     */
    public function success($message)
    {
        $this->output(self::$formatSuccess, $message);
    }

    /**
     * @param string $message
     */
    public function warning($message)
    {
        $this->output(self::$formatWarning, $message);
    }

    /**
     * @param string $message
     */
    public function error($message)
    {
        $this->output(self::$formatError, $message);
    }
}