<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Command as CommandInterface;
use De\Idrinth\SimpleConsole\Interfaces\Application as ApplicationInterface;

class Application implements ApplicationInterface
{


    /**
     * @var Command []
     */
    private $commands = [];

    /**
     * @var array
     */
    private $args;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
        $this->setArgs($_SERVER['argv']);
    }

    /**
     * @return int exit code
     */
    public function run()
    {

        if(count($this->args) === 1){
            $output = "[37m[2m[3m" . $this->name . " contains the following commands:[0m\n";
            foreach($this->commands as $command){
                $output .= "[37m[2m[3m - " . $command->getName() . "[0m\n";
            }
            $output .= "\n";
            echo $output;
            return 0;
        }
        unset($this->args[0]);
        $this->setArgs(array_values($this->args));
        foreach($this->commands as $command){
            switch($command->getName() === $this->args[0]){
                case TRUE:
                    break;
                case FALSE:
                    return 1;
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * @param CommandInterface $command
     * @return Application
     */
    public function register(CommandInterface $command)
    {
        $this->commands[] = $command;
    }

    /**
     * @param string $name
     */
    private function setName($name){
        $this->name = $name;
    }

    /**
     * @param array $args
     */
    private function setArgs($args){
        $this->args = $args;
    }
}