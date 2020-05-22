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
    $machine->parseAndRun('(GET param1)');//5
    $machine->parseAndRun('(AND 1 0)');//false
    $machine->parseAndRun('(AND (GET param1) (GET param2))');//true