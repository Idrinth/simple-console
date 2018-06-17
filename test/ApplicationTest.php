<?php

namespace De\Idrinth\Test\SimpleConsole;

use De\Idrinth\SimpleConsole\Implementation\Application;
use De\Idrinth\SimpleConsole\Interfaces\Command;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ApplicationTest extends TestCase
{
    /**
     * @return array
     */
    public function provideRun()
    {
        $cmd1 = $this->getMockBuilder('De\Idrinth\SimpleConsole\Interfaces\Command')
            ->getMock();
        $cmd1->expects($this->any())
            ->method('getName')
            ->willReturn('cmd1');
        $cmd1->expects($this->any())
            ->method('getDefinition')
            ->willReturn(array());
        $cmd1->expects($this->any())
            ->method('execute')
            ->willReturn(0);
        $cmd2 = $this->getMockBuilder('De\Idrinth\SimpleConsole\Interfaces\Command')
            ->getMock();
        $cmd2->expects($this->any())
            ->method('getName')
            ->willReturn('cmd2');
        $cmd2->expects($this->any())
            ->method('getDefinition')
            ->willReturn(array());
        $cmd2->expects($this->any())
            ->method('execute')
            ->willThrowException(new InvalidArgumentException("I need a value"));
        return array(
            array(
                new Application('Name'),
                array($cmd1, $cmd2),
                array('hi.php'),
                0,
                "[37m[2m[3mName contains the following commands:[0m\n[37m[2m[3m - cmd1[0m\n[37m[2m[3m - cmd2[0m\n"
            ),
            array(
                new Application('Name'),
                array($cmd1),
                array('hi.php', 'cmd2'),
                1,
                "[31m[1mName does not contain the following command: cmd2[0m\n"
            ),
            array(
                new Application('Name'),
                array($cmd1, $cmd2),
                array('hi.php', 'cmd1'),
                0,
                "[32m[1mName ran cmd1 successfully[0m\n"
            ),
            array(
                new Application('Name'),
                array($cmd1, $cmd2),
                array('hi.php', 'cmd2'),
                3,
                "[31m[1mName failed to run cmd2[0m\n[33mI need a value[0m\n"
            )
        );
    }

    /**
     * @test
     * @dataProvider provideRun
     * @param Application $application
     * @param Command[] $commands
     * @param array $cliArgs
     * @param int $exitCode
     * @param string $output
     */
    public function testRun(Application $application, array $commands, array $cliArgs, $exitCode, $output)
    {
        foreach($commands as $command) {
            $application->register($command);
        }
        $rfclass = new ReflectionClass($application);
        $property = $rfclass->getProperty('args');
        $property->setAccessible(true);
        $property->setValue($application, $cliArgs);
        ob_start();
        $this->assertEquals($exitCode, $application->run());
        $this->assertEquals($output, ob_get_clean());
    }
}
