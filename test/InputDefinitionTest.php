<?php

namespace De\Idrinth\Test\SimpleConsole;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition\BoolArrayDefinition;
use De\Idrinth\SimpleConsole\Implementation\InputDefinition\BoolDefinition;
use De\Idrinth\SimpleConsole\Implementation\InputDefinition\ValueDefinition;
use De\Idrinth\SimpleConsole\Implementation\InputDefinition\ArrayDefinition;
use De\Idrinth\SimpleConsole\Interfaces\InputDefinition;
use PHPUnit\Framework\TestCase;

class InputDefinitionTest extends TestCase
{
    /**
     * @return array
     */
    public function provideOptionalDeclaration()
    {
        return array(
            array(new BoolArrayDefinition('v'), 'v', true, array(), array('v'=>0)),
            array(new BoolArrayDefinition('v'), 'v', true, array('v' => null), array('v'=>1)),
            array(new BoolArrayDefinition('v'), 'v', true, array('v' => array(null, null)), array('v'=>2)),
            array(new BoolDefinition('v'), 'v', true, array(), array('v'=>true)),
            array(new BoolDefinition('v'), 'v', true, array('v' => null), array('v'=>true)),
            array(new BoolDefinition('v'), 'v', true, array('v' => array(null, null)), array('v'=>true)),
            array(new ArrayDefinition('v', false, '[a-z]+', null), 'v', false, array(), array()),
            array(new ArrayDefinition('v', false, '[a-z]+', null), 'v', false, array('v' => 'q'), array('v' => array('q'))),
            array(new ArrayDefinition('v', false, '[a-z]+', array('a')), 'v', false, array('v' => null), array('v'=>array('a'))),
            array(new ArrayDefinition('v', false, '[a-z]+', array('a')), 'v', false, array('v' => 'hi'), array('v'=>array('a'))),
            array(new ValueDefinition('v', false, '[a-z]+', null), 'v', false, array('v' => '000'), array()),
            array(new ValueDefinition('v', false, '[a-z]+', 'a'), 'v', false, array('v' => null), array('v'=>'a')),
            array(new ValueDefinition('v', false, '[a-z]+', 'a'), 'v', false, array('v' => 'hi'), array('v'=>'a')),
        );
    }

    /**
     * @test
     * @dataProvider provideOptionalDeclaration
     * @param InputDefinition $definition
     * @param type $name
     * @param boolean $boolean
     * @param array $input
     * @param array $valid
     */
    public function testOptionalDeclaration(InputDefinition $definition, $name, $boolean, $input, $valid)
    {
        $this->assertEquals($name, $definition->getName());
        $this->assertEquals($boolean, $definition->isBoolean());
        $this->assertEquals(false, $definition->isRequired());
        $this->assertEquals($valid, $definition->process($input));
    }

    /**
     * @return array
     */
    public function provideMissingRequiredDeclaration()
    {
        return array(
            array(new ArrayDefinition('v', true, '[a-z]+'), 'v', array()),
            array(new ArrayDefinition('v', true, '[a-z]+'), 'v', array('v' => array())),
            array(new ValueDefinition('v', true, '[a-z]+'), 'v', array('v' => '')),
            array(new ValueDefinition('v', true, '[a-z]+'), 'v', array('v' => null)),
        );
    }

    /**
     * @test
     * @dataProvider provideMissingRequiredDeclaration
     * @expectedException InvalidArgument
     * @expectedExceptionMessageRegExp /^.+ is required\./
     * @param InputDefinition $definition
     * @param type $name
     * @param array $input
     */
    public function testMissingRequiredDeclaration(InputDefinition $definition, $name, $input)
    {
        $this->assertEquals($name, $definition->getName());
        $this->assertEquals(false, $definition->isBoolean());
        $this->assertEquals(true, $definition->isRequired());
        $definition->process($input);
    }

    /**
     * @return array
     */
    public function provideWrongDeclaration()
    {
        return array(
            array(new ArrayDefinition('v', true, '[a-z]+'), 'v', true, array('v' => '0')),
            array(new ArrayDefinition('v', true, '[a-z]+'), 'v', true, array('v' => array('0', 'a'))),
            array(new ValueDefinition('v', true, '[a-z]+'), 'v', true, array('v' => '89')),
            array(new ValueDefinition('v', true, '[a-z]+'), 'v', true, array('v' => '----')),
            array(new ArrayDefinition('v', false, '[a-z]+'), 'v', false, array('v' => '0')),
            array(new ArrayDefinition('v', false, '[a-z]+'), 'v', false, array('v' => array('0', 'a'))),
            array(new ValueDefinition('v', false, '[a-z]+'), 'v', false, array('v' => '89')),
            array(new ValueDefinition('v', false, '[a-z]+'), 'v', false, array('v' => '----')),
        );
    }

    /**
     * @test
     * @dataProvider provideWrongDeclaration
     * @expectedException InvalidArgument
     * @expectedExceptionMessageRegExp /^.+ doesn't match expected format .+\./
     * @param InputDefinition $definition
     * @param type $name
     * @param boolean $boolean
     * @param array $input
     * @param boolean $required
     * @param array $valid
     */
    public function testWrongDeclaration(InputDefinition $definition, $name, $required, $input)
    {
        $this->assertEquals($name, $definition->getName());
        $this->assertEquals(false, $definition->isBoolean());
        $this->assertEquals($required, $definition->isRequired());
        $definition->process($input);
    }
}
