<?php

namespace De\Idrinth\Test\SimpleConsole;

use De\Idrinth\SimpleConsole\Implementation\Input;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{
    /**
     * @return array
     */
    public function provideNoneExisting()
    {
        return array(
            array(new Input(array('q' => true)), 'a')
        );
    }

    /**
     * @dataProvider provideNoneExisting
     * @expectedException InvalidArgumentException
     * @param Input $input
     * @param string $name
     */
    public function testNoneExisting(Input $input, $name)
    {
        $this->assertFalse($input->has($name));
        $input->get($name);
    }

    /**
     * @return array
     */
    public function provideExisting()
    {
        return array(
            array(new Input(array('q' => true)), 'q', true)
        );
    }

    /**
     * @dataProvider provideExisting
     * @param Input $input
     * @param string $name
     * @param bool $result
     */
    public function testExisting(Input $input, $name, $result)
    {
        $this->assertTrue($input->has($name));
        $this->assertEquals($result, $input->get($name));
    }
}
