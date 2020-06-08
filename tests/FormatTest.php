<?php

use PHPUnit\Framework\TestCase;
use Pina\Input;

class FormatTest extends TestCase
{

    public function testFormat()
    {
        $formatter = new \SimpleLisp\LispFormatter();
        $formatted = $formatter->format('(AND "param1" "param2")', "\n", " ");
        
        $this->assertEquals("(AND 'param1' 'param2')", $formatted);
        
        $fibonacci = '(defun fibonacci (n)
  (if (> n 1)
      (+ (fibonacci (- n 1))
         (fibonacci (- n 2)))
      n)) (fibonacci 5)';
        
        $formatted = $formatter->format($fibonacci);
        $this->assertEquals("(defun
    fibonacci
    (n)
    (if
        (> n 1)
        (+
            (fibonacci
                (- n 1))
            (fibonacci
                (- n 2)))
        n))
(fibonacci 5)", $formatted);
    }

}
