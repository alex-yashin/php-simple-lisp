# php-simple-lisp

## Usage

    $machine = new \SimpleLisp\LispMachine();
    $machine->setState([
        'param1' => 5,
        'param2' => 1,
        'param3' => 0,
    ]);

    echo $machine->parseAndRun('5'); //5
    echo $machine->parseAndRun('param1'); //5
    echo $machine->parseAndRun('(AND 1 0)'); //false
    echo $machine->parseAndRun('(AND param1 param2)'); //true

    echo $machine->parseAndRun('(defun fibonacci (n) (if (> n 1) (+ (fibonacci (- n 1)) (fibonacci (- n 2))) n)) (fibonacci 7)'); //13