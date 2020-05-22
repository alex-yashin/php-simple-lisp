# php-simple-lisp

##usage


    $context = new \SimpleLisp\Context();
    $context->load([
        'param1' => 5,
        'param2' => 1,
        'param3' => 0,
    ]);

    $machine = new \SimpleLisp\LispMachine($context);

    $machine->parseAndRun('5');//5
    $machine->parseAndRun('param1');//5
    $machine->parseAndRun('(AND 1 0)');//false
    $machine->parseAndRun('(AND param1 param2)');//true

    $machine->parseAndRun('(defun fibonacci (n) (if (> n 1) (+ (fibonacci (- n 1)) (fibonacci (- n 2))) n)) (fibonacci 7)');//13