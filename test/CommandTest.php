<?php

namespace De\Idrinth\Test\SimpleConsole;

use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    /**
     * @test
     */
    public function testEmptyCommand()
    {
        $command = $this
            ->getMockBuilder('De\Idrinth\SimpleConsole\Implementation\Command')
            ->setConstructorArgs(array('name'))
            ->getMockForAbstractClass();
        $command->expects($this->once)
            ->method('execute')
            ->willReturn(8);
        $this->assertInternalType('array', $command->getDefinition());
        $this->assertCount(0, $command->getDefinition());
        $this->assertInternalType('int', $command->execute());
        $this->assertEquals(8, $command->execute());
        $this->assertEquals('name', $command->getName());
    }
}