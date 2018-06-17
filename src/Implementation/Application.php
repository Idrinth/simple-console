<?php

namespace De\Idrinth\SimpleConsole\Implementation;

use De\Idrinth\SimpleConsole\Interfaces\Command as CommandInterface;
use De\Idrinth\SimpleConsole\Interfaces\Application as ApplicationInterface;

class Application implements ApplicationInterface
{
    /**
     * @var Command []
     */
    private $commands = array();

    /**
     * @var array
     */
    private $args;

    /**
     * @var string
     */
    private $name;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
        $this->args = $_SERVER['argv'];
        $this->output = new Output();
    }

    /**
     * @return int exit code
     */
    public function run()
    {
        if(count($this->args) === 1){
            $this->output->info($this->name . " contains the following commands:");
            foreach($this->commands as $command){
                $this->output->info(" - ".$command->getName());
            }
            return 0;
        }
        foreach($this->commands as $command) {
            if($command->getName() !== $this->args[1]) {
                continue;
            }
            return $this->runCommand($command);
        }
        $this->output->error("$this->name does not contain the following command: {$this->args[1]}");
        return 1;
    }

    /**
     * @param CommandInterface $command
     * @return int
     */
    private function runCommand(CommandInterface $command)
    {
        try {
            $cmd = array();
            $oneChar='';
            foreach($command->getDefinition() as $def) {
                $cmd[] = $command->getName().':';
                if(strlen($command->getName()) === 1) {
                    $oneChar.=$command->getName().':';
                }
            }
            $exit = $command->execute(new Input(getopt($oneChar, $cmd)), $this->output);
            if(!$exit) {
                $this->output->success("$this->name ran {$command->getName()} sucessfully");
            } else {
                $this->output->error("$this->name failed to run {$command->getName()} sucessfully");
            }
            return $exit;
        } catch (\Exception $e) {
            $this->output->error("$this->name failed to run {$command->getName()}");
            $this->output->warning($e->getMessage());
            return 3;
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
}