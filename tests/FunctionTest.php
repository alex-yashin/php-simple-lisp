<?php

use PHPUnit\Framework\TestCase;
use Pina\Input;

class FunctionTest extends TestCase
{

    public function testFunctions()
    {
        $machine = new \SimpleLisp\LispMachine();
        $machine->setState([
            'param1' => 5,
            'param2' => 1,
            'param3' => 0,
        ]);

        $this->assertEquals(5, $machine->parseAndRun('5'));
        $this->assertEquals(5, $machine->parseAndRun('param1'));
        $this->assertFalse($machine->parseAndRun('(AND 1 0)'));
        $this->assertTrue($machine->parseAndRun('(and 1 1)'));
        $this->assertTrue($machine->parseAndRun('(AND param1 param2)'));
        $this->assertFalse($machine->parseAndRun('(AND param1 param3)'));
        $this->assertTrue($machine->parseAndRun('(OR param1 param3)'));
        $this->assertFalse($machine->parseAndRun('(NOT (OR param1 param3))'));
        $this->assertTrue($machine->parseAndRun('(NOT param3)'));
        $this->assertTrue($machine->parseAndRun('(= param1 5)'));
        $this->assertTrue($machine->parseAndRun('(= param1)'));
        $this->assertFalse($machine->parseAndRun('(= param1 1)'));
        $this->assertTrue($machine->parseAndRun('(= param1 param1)'));
        $this->assertFalse($machine->parseAndRun('(= param1 param1 1)'));

        $this->assertTrue($machine->parseAndRun('(>= param1 param1)'));
        $this->assertTrue($machine->parseAndRun('(>= param1 param1 1)'));
        $this->assertFalse($machine->parseAndRun('(>= param2 param1)'));
        $this->assertTrue($machine->parseAndRun('(<= param1 param1)'));
        $this->assertTrue($machine->parseAndRun('(<= param1 param1 10)'));
        $this->assertFalse($machine->parseAndRun('(<= param1 param2)'));

        $this->assertTrue($machine->parseAndRun('(> param1 param2)'));
        $this->assertFalse($machine->parseAndRun('(> param3 param2)'));

        $this->assertTrue($machine->parseAndRun('(< param3 param2)'));
        $this->assertFalse($machine->parseAndRun('(< param1 param2)'));
        $this->assertEquals(11, $machine->parseAndRun('(+ param1 param2 5)'));
        $this->assertEquals(-1, $machine->parseAndRun('(- param1 param2 5)'));
        $this->assertEquals(25, $machine->parseAndRun('(* param1 param2 5)'));
        $this->assertEquals(5, $machine->parseAndRun('(* param1 param2)'));
        $this->assertEquals(0, $machine->parseAndRun('(* param1 param3)'));
        $this->assertEquals(1, $machine->parseAndRun("(/ param1 param2 5)"));
        $this->assertEquals(5, $machine->parseAndRun('(/ param1 param2)'));

        //thrown exception 'Division by zero';
        //$machine->parseAndRun('(/ (GET param1) (GET param3))');

        $this->assertEquals(5, $machine->parseAndRun('(COND ((> param1 param2) param1) (1 param2))'));
        $this->assertEquals(1, $machine->parseAndRun('(COND ((< param1 param2) param1) (1 param2))'));
        $this->assertEquals(5, $machine->parseAndRun('(COND ((> param1 param2) param1) (1 param2))'));
        $this->assertEquals(1, $machine->parseAndRun('(COND ((< param1 param2) param1) (1 param2))'));
        $this->assertEquals(5, $machine->parseAndRun('(IF (> param1 param2) param1 param2)'));
        $this->assertEquals(1, $machine->parseAndRun('(IF (< param1 param2) param1 param2)'));

        $fibonacci = '(defun fibonacci (n)
  (if (> n 1)
      (+ (fibonacci (- n 1))
         (fibonacci (- n 2)))
      n))';

        $this->assertEquals(1, $machine->parseAndRun($fibonacci . '(fibonacci 2)'));
        $this->assertEquals(2, $machine->parseAndRun($fibonacci . '(fibonacci 3)'));
        $this->assertEquals(3, $machine->parseAndRun($fibonacci . '(fibonacci 4)'));
        $this->assertEquals(5, $machine->parseAndRun($fibonacci . '(fibonacci 5)'));
        $this->assertEquals(8, $machine->parseAndRun($fibonacci . '(fibonacci 6)'));
        $this->assertEquals(13, $machine->parseAndRun($fibonacci . '(fibonacci 7)'));
    }

}
