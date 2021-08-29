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
        $this->assertFalse($machine->run('(!= param1 param1)'));
        $this->assertTrue($machine->run('(!= param1 param2)'));
        $this->assertFalse($machine->run('(!= param1 5)'));
        $this->assertTrue($machine->run('(!= param1 1)'));

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
        
        $this->assertTrue($machine->run('(IN param1 1 2 3 4 5)'));
        $this->assertFalse($machine->run('(IN param1 1 2 3 4)'));
        $this->assertTrue($machine->run('(IN param1 param1 param2 param3)'));
        $this->assertFalse($machine->run('(IN param1 param2 param3)'));
        $this->assertTrue($machine->run('(IN param1 (QUOTE (param1 param2 param3)))'));
        $this->assertFalse($machine->run('(IN param1 (QUOTE (param2 param3)))'));

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
        
        $this->assertEquals(4, $machine->run("(MIN (LIST 4 5 6 7))"));
        $this->assertEquals(4, $machine->run("(MIN 4 5 6 7)"));
        $this->assertEquals(5, $machine->run("(MIN 5)"));
        $this->assertEquals(5, $machine->run("(MIN (LIST 5))"));
        $this->assertEquals(null, $machine->run("(MIN)"));
        
        $this->assertEquals(7, $machine->run("(MAX (LIST 4 5 6 7))"));
        $this->assertEquals(7, $machine->run("(MAX 4 5 6 7)"));
        $this->assertEquals(5, $machine->run("(MAX 5)"));
        $this->assertEquals(5, $machine->run("(MAX (LIST 5))"));
        $this->assertEquals(null, $machine->run("(MAX)"));
        $this->assertEquals(5, $machine->run("(COUNT (LIST 1 2 3 4 5))"));
        $this->assertEquals(0, $machine->run("(COUNT (LIST))"));
        $this->assertEquals(0, $machine->run("(COUNT)"));
        $this->assertEquals(1, $machine->run("(COUNT_VALUE (LIST 1 2 3 4 5) 5)"));
        $this->assertEquals(0, $machine->run("(COUNT_VALUE (LIST 1 2 3 4 5) 6)"));
        $this->assertEquals(0, $machine->run("(COUNT_VALUE (LIST) 6)"));
        $this->assertEquals(0, $machine->run("(COUNT_VALUE 5 6)"));
        $this->assertEquals(1, $machine->run("(COUNT_VALUE 6 6)"));
        $this->assertEquals(1, $machine->run("(INTDIV 6 6)"));
        $this->assertEquals(1, $machine->run("(INTDIV 7 6)"));
        $this->assertEquals(0, $machine->run("(INTDIV 5 6)"));
        $this->assertEquals(2, $machine->run("(INTDIV 13 6)"));
        $this->assertEquals(1, $machine->run("(INTDIV 100 21 3)"));
        $this->assertEquals(1, $machine->run("(MOD 5 4)"));
        $this->assertEquals(2, $machine->run("(% 10 4)"));
        $this->assertEquals(0, $machine->run("(% 0 4)"));
        $this->assertEquals([2, 3], $machine->run("(SLICE (LIST 1 2 3 4 5) 1 2)"));
        $this->assertEquals([2, 3, 4, 5], $machine->run("(SLICE (LIST 1 2 3 4 5) 1)"));
        $this->assertEquals([1], $machine->run("(SLICE (LIST 1 2 3 4 5) 0 1)"));
        $this->assertEquals([5, 4, 3, 2, 1], $machine->run("(SORT (LIST 1 2 3 4 5) 'DESC')"));
        $this->assertEquals(15, $machine->run("(SUM (LIST 1 2 3 4 5))"));
        
        $this->assertEquals(10, $machine->run("(SETQ param10 10)"));
        $this->assertEquals(40, $machine->run("(SETQ param10 20) (* param10 2)"));
        $this->assertEquals(42, $machine->run("(SETQ param10 (+ 1 20)) (* param10 2)"));
        
    }
    
    public function testBase()
    {
        $machine = new \SimpleLisp\LispMachine();
        $machine->setState([
            'param1' => 5,
            'param2' => 1,
            'param3' => 0,
        ]);
        $this->assertEquals([1, 2], $machine->run("(LIST 1 2)"));
        $this->assertEquals([1, 2, [1, 2]], $machine->run("(LIST 1 2 (LIST 1 2))"));
        $this->assertEquals(['LIST', 1, 2, ['LIST', 1, 2]], $machine->run('(QUOTE (LIST 1 2 (LIST 1 2))'));
        $this->assertEquals([[3, 4]], $machine->run('(QUOTE ((3 4)))'));
        $this->assertEquals(1, $machine->run('(CAR (QUOTE (1 2 3 4))'));
        $this->assertEquals([2, 3, 4], $machine->run('(CDR (QUOTE (1 2 3 4))'));
        $this->assertEquals([1, 2, 3, 4], $machine->run('(CONS 1 (QUOTE (2 3 4))'));
        $this->assertEquals([1, 2], $machine->run('(CAR (QUOTE ((1 2) (3 4))'));
        $this->assertEquals([[3, 4]], $machine->run('(CDR (QUOTE ((1 2) (3 4))'));
        $this->assertEquals([[1, 2], [3, 4]], $machine->run('(CONS (QUOTE (1 2)) (QUOTE ((3 4)))'));
//        $r = $machine->run('(CONS (QUOTE 1) (QUOTE 2))');
//        $this->assertEquals([[1, 2], [3, 4]], $machine->run('(CONS (QUOTE 1) (QUOTE 2))'));
    }

    public function testReduce()
    {
        $machine = new \SimpleLisp\LispMachine();
        $machine->setState([
            'collection' => [
                ['id' => 1, 'code' => 'ASD', 'price' => 5],
                ['id' => 2, 'code' => 'ASD', 'price' => 15],
                ['id' => 3, 'code' => 'ASD', 'price' => 4],
                ['id' => 4, 'code' => 'XXX', 'price' => 3],
                ['id' => 5, 'code' => 'YYY', 'price' => 8],
                ['id' => 6, 'code' => 'ASD', 'price' => 20],
            ],
        ]);
        $this->assertEquals([5, 15, 4, 3, 8, 20], $machine->run("(COLUMN collection 'price')"));
        $this->assertEquals([
            ['id' => 1, 'code' => 'ASD', 'price' => 5],
            ['id' => 2, 'code' => 'ASD', 'price' => 15],
            ['id' => 3, 'code' => 'ASD', 'price' => 4],
            ['id' => 6, 'code' => 'ASD', 'price' => 20],
            ], $machine->run("(FILTER collection (= code 'ASD'))"));
        
        $this->assertEquals(4, $machine->run("(MIN (COLUMN (FILTER collection (= code 'ASD')) 'price'))"));
        $this->assertEquals(20, $machine->run("(MAX (COLUMN (FILTER collection (= code 'ASD')) 'price'))"));
        
        $this->assertEquals([1, 2, 3, 4], $machine->run("(MERGE (LIST 1 2) (LIST 3 4))"));
        $this->assertEquals([1, 2, 3, 4], $machine->run("(MERGE (LIST 1 2) 3 4)"));
        $this->assertEquals([1, 2, 3, 4], $machine->run("(MERGE 1 2 3 4)"));
        $this->assertEquals([1, 2, 1, 2, 3, 4], $machine->run("(MERGE (LIST 1 2) (LIST 1 2 3 4))"));
        $this->assertEquals([1, 2, 3, 4], $machine->run("(UNIQUE (MERGE (LIST 1 2) (LIST 1 2 3 4)))"));
        $this->assertEquals([1, 2, 3, 4], $machine->run("(UNIQUE (LIST 1 2) (LIST 1 2 3 4))"));
        $this->assertEquals([1, 2, 3, 4], $machine->run("(UNIQUE (LIST 1 2) 1 2 3 4)"));
        $this->assertEquals([1, 2, 3, 4], $machine->run("(UNIQUE 1 2 1 2 3 4)"));
        $this->assertEquals([], $machine->run("(INTERSECT 1 2 1 2 3 4)"));
        $this->assertEquals([1, 2], $machine->run("(INTERSECT (LIST 1 2) (LIST 1 2 3 4))"));
        $this->assertEquals([], $machine->run("(INTERSECT (LIST 1 2) 1 2 3 4)"));
    }

}
