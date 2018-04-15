<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Output as OutputInterface;

class Output implements OutputInterface
{
    /**
     * @var string
     */
    private static $formatReset = "[0m";

    /**
     * @var string
     */
    private static $red = "[31m";

    /**
     * @var string
     */
    private static $green = "[32m";

    /**
     * @var string
     */
    private static $yellow = "[33m";

    /**
     * @var string
     */
    private static $white = "[37m";

    /**
     * @var string
     */
    private static $bold = "[1m";

    /**
     * @var string
     */
    private static $faint = "[2m";

    /**
     * @var string
     */
    private static $italic = "[3m";

    /**
     * @param string $format
     * @param string $message
     * @return void
     */
    private function output($format, $message){
        if(!empty($message)){
            echo $format.$message.self::$formatReset;
        }
        echo "\n";
    }

    /**
     * @param string $message
     * @return void
     */
    public function info($message)
    {
        $this->output(self::$white.self::$faint.self::$italic, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function success($message)
    {
        $this->output(self::$green.self::$bold, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function warning($message)
    {
        $this->output(self::$yellow, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function error($message)
    {
        $this->output(self::$red.self::$bold, $message);
    }
}
