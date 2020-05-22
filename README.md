# php-simple-lisp

## Usage

    $machine = new \SimpleLisp\LispMachine();
    $machine->setState([
        'param1' => 5,
        'param2' => 1,
        'param3' => 0,
    ]);

    echo $machine->run('5'); //5
    echo $machine->run('param1'); //5
    echo $machine->run('(AND 1 0)'); //false
    echo $machine->run('(AND param1 param2)'); //true

    echo $machine->run('(defun fibonacci (n) (if (> n 1) (+ (fibonacci (- n 1)) (fibonacci (- n 2))) n)) (fibonacci 7)'); //13