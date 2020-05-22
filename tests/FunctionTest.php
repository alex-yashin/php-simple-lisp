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

        $this->assertEquals(5, $machine->run('5'));
        $this->assertEquals(5, $machine->run('param1'));
        $this->assertFalse($machine->run('(AND 1 0)'));
        $this->assertTrue($machine->run('(and 1 1)'));
        $this->assertTrue($machine->run('(AND param1 param2)'));
        $this->assertFalse($machine->run('(AND param1 param3)'));
        $this->assertTrue($machine->run('(OR param1 param3)'));
        $this->assertFalse($machine->run('(NOT (OR param1 param3))'));
        $this->assertTrue($machine->run('(NOT param3)'));
        $this->assertTrue($machine->run('(= param1 5)'));
        $this->assertTrue($machine->run('(= param1)'));
        $this->assertFalse($machine->run('(= param1 1)'));
        $this->assertTrue($machine->run('(= param1 param1)'));
        $this->assertFalse($machine->run('(= param1 param1 1)'));

        $this->assertTrue($machine->run('(>= param1 param1)'));
        $this->assertTrue($machine->run('(>= param1 param1 1)'));
        $this->assertFalse($machine->run('(>= param2 param1)'));
        $this->assertTrue($machine->run('(<= param1 param1)'));
        $this->assertTrue($machine->run('(<= param1 param1 10)'));
        $this->assertFalse($machine->run('(<= param1 param2)'));

        $this->assertTrue($machine->run('(> param1 param2)'));
        $this->assertFalse($machine->run('(> param3 param2)'));

        $this->assertTrue($machine->run('(< param3 param2)'));
        $this->assertFalse($machine->run('(< param1 param2)'));
        $this->assertEquals(11, $machine->run('(+ param1 param2 5)'));
        $this->assertEquals(-1, $machine->run('(- param1 param2 5)'));
        $this->assertEquals(25, $machine->run('(* param1 param2 5)'));
        $this->assertEquals(5, $machine->run('(* param1 param2)'));
        $this->assertEquals(0, $machine->run('(* param1 param3)'));
        $this->assertEquals(1, $machine->run("(/ param1 param2 5)"));
        $this->assertEquals(5, $machine->run('(/ param1 param2)'));

        //thrown exception 'Division by zero';
        //$machine->run('(/ (GET param1) (GET param3))');

        $this->assertEquals(5, $machine->run('(COND ((> param1 param2) param1) (1 param2))'));
        $this->assertEquals(1, $machine->run('(COND ((< param1 param2) param1) (1 param2))'));
        $this->assertEquals(5, $machine->run('(COND ((> param1 param2) param1) (1 param2))'));
        $this->assertEquals(1, $machine->run('(COND ((< param1 param2) param1) (1 param2))'));
        $this->assertEquals(5, $machine->run('(IF (> param1 param2) param1 param2)'));
        $this->assertEquals(1, $machine->run('(IF (< param1 param2) param1 param2)'));

        $fibonacci = '(defun fibonacci (n)
  (if (> n 1)
      (+ (fibonacci (- n 1))
         (fibonacci (- n 2)))
      n))';

        $this->assertEquals(1, $machine->run($fibonacci . '(fibonacci 2)'));
        $this->assertEquals(2, $machine->run($fibonacci . '(fibonacci 3)'));
        $this->assertEquals(3, $machine->run($fibonacci . '(fibonacci 4)'));
        $this->assertEquals(5, $machine->run($fibonacci . '(fibonacci 5)'));
        $this->assertEquals(8, $machine->run($fibonacci . '(fibonacci 6)'));
        $this->assertEquals(13, $machine->run($fibonacci . '(fibonacci 7)'));
    }

}
