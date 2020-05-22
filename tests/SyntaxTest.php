<?php

use PHPUnit\Framework\TestCase;
use Pina\Input;

class SyntaxTest extends TestCase
{

    /**
     * @dataProvider syntaxProvider
     */
    public function testSyntax($program, $expected)
    {
        $syntax = new \SimpleLisp\LispSyntax;
        $list = $syntax->parse($program);
        $this->assertEquals($expected, $list);
    }

    public function syntaxProvider()
    {
        return [
            ['5', ['5']],
            ['(AND 1 1)', [["AND", '1', '1']]],
            ['(AND 1 0)', [["AND", '1', '0']]],
            ['(AND "param1" "param2")', [["AND", "'param1", "'param2"]]],
            ['(AND param1 (OR true false))', [["AND", 'param1', ['OR', 'true', 'false',]]]],
            ['(AND param1 (OR true false) param2)', [["AND", 'param1', ['OR', 'true', 'false',], 'param2']]],
            ['(AND param1 (OR true false) param2)  ', [["AND", 'param1', ['OR', 'true', 'false',], 'param2']]],
            [' ( AND param1 (OR true false) param2 ) ', [["AND", 'param1', ['OR', 'true', 'false'], 'param2']]],
        ];
    }

}