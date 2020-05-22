<?php

use PHPUnit\Framework\TestCase;
use Pina\Input;

class FunctionTest extends TestCase
{

    public function testFunctions()
    {
        $context = new \SimpleLisp\Context();
        $context->load([
            'param1' => 5,
            'param2' => 1,
            'param3' => 0,
        ]);

        $machine = new \SimpleLisp\LispMachine($context);

        $this->assertEquals(5, $machine->parseAndRun('5'));
        $this->assertEquals(5, $machine->parseAndRun('(GET param1)'));
        $this->assertFalse($machine->parseAndRun('(AND 1 0)'));
        $this->assertTrue($machine->parseAndRun('(and 1 1)'));
        $this->assertTrue($machine->parseAndRun('(AND (GET param1) (GET param2))'));
        $this->assertFalse($machine->parseAndRun('(AND (GET param1) (GET param3))'));
        $this->assertTrue($machine->parseAndRun('(OR (GET param1) (GET param3))'));
        $this->assertFalse($machine->parseAndRun('(NOT (OR (GET param1) (GET param3)))'));
        $this->assertTrue($machine->parseAndRun('(NOT (GET param3))'));
        $this->assertTrue($machine->parseAndRun('(= (GET param1) 5)'));
        $this->assertTrue($machine->parseAndRun('(= (GET param1))'));
        $this->assertFalse($machine->parseAndRun('(= (GET param1) 1)'));
        $this->assertTrue($machine->parseAndRun('(= (GET param1) (GET param1))'));
        $this->assertFalse($machine->parseAndRun('(= (GET param1) (GET param1) 1)'));

        $this->assertTrue($machine->parseAndRun('(>= (GET param1) (GET param1))'));
        $this->assertTrue($machine->parseAndRun('(>= (GET param1) (GET param1) 1)'));
        $this->assertFalse($machine->parseAndRun('(>= (GET param2) (GET param1))'));
        $this->assertTrue($machine->parseAndRun('(<= (GET param1) (GET param1))'));
        $this->assertTrue($machine->parseAndRun('(<= (GET param1) (GET param1) 10)'));
        $this->assertFalse($machine->parseAndRun('(<= (GET param1) (GET param2))'));

        $this->assertTrue($machine->parseAndRun('(> (GET param1) (GET param2))'));
        $this->assertFalse($machine->parseAndRun('(> (GET param3) (GET param2))'));

        $this->assertTrue($machine->parseAndRun('(< (GET param3) (GET param2))'));
        $this->assertFalse($machine->parseAndRun('(< (GET param1) (GET param2))'));
        $this->assertEquals(11, $machine->parseAndRun('(+ (GET param1) (GET param2) 5)'));
        $this->assertEquals(-1, $machine->parseAndRun('(- (GET param1) (GET param2) 5)'));
        $this->assertEquals(25, $machine->parseAndRun('(* (GET param1) (GET param2) 5)'));
        $this->assertEquals(5, $machine->parseAndRun('(* (GET param1) (GET param2))'));
        $this->assertEquals(0, $machine->parseAndRun('(* (GET param1) (GET param3))'));
        $this->assertEquals(1, $machine->parseAndRun('(/ (GET param1) (GET param2) 5)'));
        $this->assertEquals(5, $machine->parseAndRun('(/ (GET param1) (GET param2))'));

        //thrown exception 'Division by zero';
        //$machine->parseAndRun('(/ (GET param1) (GET param3))');
    }

}
