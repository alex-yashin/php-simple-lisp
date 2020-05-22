<?php

use PHPUnit\Framework\TestCase;
use Pina\Input;

class TokenizerTest extends TestCase
{

    /**
     * @dataProvider tokenizerProvider
     */
    public function testTokenizer($program, $expected)
    {
        $tokenizer = new \SimpleLisp\LispTokenizer($program);
        $tokens = $tokenizer->getAll();
        $this->assertEquals($expected, $tokens);
    }

    public function tokenizerProvider()
    {
        return [
            ['5', ['5']],
            ['(AND 1 1)', ['(', "AND", '1', '1', ')']],
            ['(AND 1 1)', ['(',"AND", '1', '1', ')']],
            ['(AND 0 1)', ['(',"AND", '0', '1', ')']],
            ['(AND 1 0)', ['(',"AND", '1', '0', ')']],
            ['(AND param1 "param2")', ['(',"AND", 'param1', "'param2", ')']],
            ['(AND param1 (OR true false))', ['(',"AND", 'param1', '(', 'OR', 'true', 'false', ')', ')']],
            ['(AND param1 (OR true false) param2)', ['(',"AND", 'param1', '(', 'OR', 'true', 'false', ')', 'param2', ')']],
            ['(AND param1 (OR true false) param2)  ', ['(',"AND", 'param1', '(', 'OR', 'true', 'false', ')', 'param2', ')']],
            [' ( AND param1 (OR true false) param2)  ', ['(',"AND", 'param1', '(', 'OR', 'true', 'false', ')', 'param2', ')']],
        ];
    }
}