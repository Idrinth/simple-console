<?php

namespace De\Idrinth\Test\SimpleConsole;

use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    /**
     * @return array
     */
    public function provideCommand() {
        return array(
            array($this->getCommand(), 0, 8),
            array($this->getCommand(2), 2, 10),
            array($this->getCommand(1,3), 1, 12),
            array($this->getCommand(12,1), 12, 21),
            array($this->getCommand(1,1,3), 1, 13)
        );
    }

    /**
     * @param int $uniques
     * @param int $duplicates
     * @return Command
     */
    private function getCommand($uniques = 0, $duplicates = 0, $fakes = 0)
    {
        $definitions = array();
        for ($i = 0; $i < $uniques; $i++) {
            $definition = $this
            ->getMockBuilder('De\Idrinth\SimpleConsole\Interfaces\InputDefinition')
            ->getMock();
            $definition->expects($this->once())
                ->method('getName')
                ->willReturn($i.md5(microtime()).md5(mt_rand()));
            $definitions[] = $definition;
        }
        for ($j = 0; $j < $duplicates; $j++) {
            $definitions[] = clone $definitions[0];
        }
        for ($k = 0; $k < $fakes; $k++) {
            $definitions[] = 'I am fake';
        }
        $command = $this
            ->getMockBuilder('De\Idrinth\SimpleConsole\Implementation\Command')
            ->setConstructorArgs(array('name', $definitions))
            ->getMockForAbstractClass();
        $command->expects($this->once())
            ->method('execute')
            ->willReturn(8+$uniques+$duplicates+$fakes);
        return $command;
    }

    /**
     * @dataProvider provideCommand
     * @test
     */
    public function testCommand(Command $command, $size, $return)
    {
        $this->assertInternalType('array', $command->getDefinition());
        $this->assertCount($size, $command->getDefinition());
        $this->assertInternalType('int', $command->execute());
        $this->assertEquals($return, $command->execute());
        $this->assertEquals('name', $command->getName());
    }
}