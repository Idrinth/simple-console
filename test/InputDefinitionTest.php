<?php

namespace De\Idrinth\Test\SimpleConsole;

use De\Idrinth\SimpleConsole\Implementation\InputDefinition\ArrayDefinition;
use De\Idrinth\SimpleConsole\Implementation\InputDefinition\BoolArrayDefinition;
use De\Idrinth\SimpleConsole\Implementation\InputDefinition\BoolDefinition;
use De\Idrinth\SimpleConsole\Implementation\InputDefinition\ValueDefinition;
use De\Idrinth\SimpleConsole\Interfaces\InputDefinition;
use PHPUnit\Framework\TestCase;

class InputDefinitionTest extends TestCase
{
    /**
     * @return array
     */
    public function provideOptionalDeclaration()
    {
        $boolArray = new BoolArrayDefinition('v');
        $bool = new BoolDefinition('v');
        $arrayDefault = new ArrayDefinition('v', false, '[a-z]+', array('a'));
        $arrayNoDefault = new ArrayDefinition('v', false, '[a-z]+', null);
        $valueDefault = new ValueDefinition('v', false, '[a-z]+', 'a');
        $valueNoDefault = new ValueDefinition('v', false, '[0-9]+', null);
        return array(
            "BoolArray 1"=>array($boolArray, 'v', true, array(), array('v'=>0)),
            "BoolArray 2"=>array($boolArray, 'v', true, array('v' => null), array('v'=>1)),
            "BoolArray 3"=>array($boolArray, 'v', true, array('v' => array(null, null)), array('v'=>2)),
            "Bool 1"=>array($bool, 'v', true, array(), array('v'=>false)),
            "Bool 2"=>array($bool, 'v', true, array('v' => null), array('v'=>true)),
            "Bool 3"=>array($bool, 'v', true, array('v' => array(null, null)), array('v'=>true)),
            "Array 1"=>array($arrayNoDefault, 'v', false, array(), array()),
            "Array 2"=>array($arrayNoDefault, 'v', false, array('v' => 'q'), array('v' => array('q'))),
            "Array 3"=>array($arrayDefault, 'v', false, array('v' => null), array('v'=>array('a'))),
            "Array 4"=>array($arrayDefault, 'v', false, array('v' => 'hi'), array('v'=>array('hi'))),
            "Value 1"=>array($valueNoDefault, 'v', false, array('v' => null), array()),
            "Value 2"=>array($valueDefault, 'v', false, array('v' => null), array('v'=>'a')),
            "Value 3" => array($valueDefault, 'v', false, array('v' => 'hi'), array('v' => 'hi')),
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
     * @expectedException \InvalidArgumentException
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
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^.+ doesn't match expected format \/.+\/\./
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
