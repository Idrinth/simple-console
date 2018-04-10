<?php

namespace De\Idrinth\Test\SimpleConsole;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition\BoolArrayDefinition;
use De\Idrinth\SimpleConsole\Interfaces\InputDefinition;
use PHPUnit\Framework\TestCase;

class InputDefinitionTest extends TestCase
{
    public function provideDeclaration()
    {
        return array(
            array(new BoolArrayDefinition('v', false, 0), 'v', true, array(), false, array('v'=>0)),
            array(new BoolArrayDefinition('v', false, 0), 'v', true, array('v' => null), false, array('v'=>1)),
            array(new BoolArrayDefinition('v', false, 0), 'v', true, array('v' => array(null, null)), false, array('v'=>2)),
            array(new BoolDefinition('v', false, true), 'v', true, array(), false, array('v'=>true)),
            array(new BoolDefinition('v', false, true), 'v', true, array('v' => null), false, array('v'=>true)),
            array(new BoolDefinition('v', false, true), 'v', true, array('v' => array(null, null)), false, array('v'=>true)),
            array(new ArrayDefinition('v', false, '[a-z]+', null), 'v', false, array(), false, array()),
            array(new ArrayDefinition('v', false, '[a-z]+', null), 'v', false, array('v' => 'q'), false, array('v' => array('q'))),
            array(new ArrayDefinition('v', false, '[a-z]+', array('a')), 'v', false, array('v' => null), false, array('v'=>array('a'))),
            array(new ArrayDefinition('v', false, '[a-z]+', array('a')), 'v', false, array('v' => 'hi'), false, array('v'=>array('a'))),
            array(new ValueDefinition('v', false, '[a-z]+', null), 'v', false, array('v' => '000'), false, array()),
            array(new ValueDefinition('v', false, '[a-z]+', 'a'), 'v', false, array('v' => null), false, array('v'=>'a')),
            array(new ValueDefinition('v', false, '[a-z]+', 'a'), 'v', false, array('v' => 'hi'), false, array('v'=>'a')),
        );
    }

    /**
     * @test
     * @dataProvider provideDeclaration
     * @param InputDefinition $definition
     * @param type $name
     * @param boolean $boolean
     * @param mixed $input
     * @param boolean $required
     * @param array $valid
     */
    public function testDeclaration(InputDefinition $definition, $name, $boolean, $input, $required, $valid)
    {
        $this->assertEquals($name, $definition->getName());
        $this->assertEquals($boolean, $definition->isBoolean());
        $this->assertEquals($required, $definition->isRequired());
        $this->assertEquals($valid, $definition->process($input));
    }
}