<?php

namespace De\Idrinth\Test\SimpleConsole;

use De\Idrinth\SimpleConsole\Implementation\Output;
use PHPUnit\Framework\TestCase;

class OutputTest extends TestCase
{
    /**
     * @return array
     */
    public function provideText()
    {
        return array(
            array(new Output(), "Hi, I'm text."),
            array(new Output(), "Well, so am I."),
        );
    }

    /**
     * @test
     */
    public function testEmptyString()
    {
        $output = new Output();
        ob_start();
        $output->info("");
        $this->assertEquals("\n", ob_get_clean());
        ob_start();
        $output->error("");
        $this->assertEquals("\n", ob_get_clean());
        ob_start();
        $output->success("");
        $this->assertEquals("\n", ob_get_clean());
        ob_start();
        $output->warning("");
        $this->assertEquals("\n", ob_get_clean());
    }

    /**
     * @dataProvider provideText
     * @param Output $output
     * @param string $text
     */
    public function testInfo(Output $output, $text)
    {
        ob_start();
        $output->info($text);
        $this->assertEquals("[37m[2m[3m".$text."[0m\n", ob_get_clean());
    }

    /**
     * @dataProvider provideText
     * @param Output $output
     * @param string $text
     */
    public function testError(Output $output, $text)
    {
        ob_start();
        $output->info($text);
        $this->assertEquals("[31m[1m".$text."[0m\n", ob_get_clean());
    }

    /**
     * @dataProvider provideText
     * @param Output $output
     * @param string $text
     */
    public function testWarning(Output $output, $text)
    {
        ob_start();
        $output->info($text);
        $this->assertEquals("[33m".$text."[0m\n", ob_get_clean());
    }

    /**
     * @dataProvider provideText
     * @param Output $output
     * @param string $text
     */
    public function testSuccess(Output $output, $text)
    {
        ob_start();
        $output->info($text);
        $this->assertEquals("[32m[1m".$text."[0m\n", ob_get_clean());
    }
}