<?php

namespace SimpleLisp;

class LispMachine
{

    private $library = [];
    protected $state = [];

    public function __construct()
    {
        $this->register('AND', new Functions\AndFunction());
        $this->register('OR', new Functions\OrFunction());
        $this->register('NOT', new Functions\NotFunction());
        $this->register('=', new Functions\EqualFunction());
        $this->register('!=', new Functions\NotEqualFunction());
        $this->register('>=', new Functions\GreaterOrEqualFunction());
        $this->register('<=', new Functions\LessOrEqualFunction());
        $this->register('<', new Functions\LessFunction());
        $this->register('>', new Functions\GreaterFunction());
        $this->register('+', new Functions\SumFunction());
        $this->register('-', new Functions\SubFunction());
        $this->register('*', new Functions\MulFunction());
        $this->register('/', new Functions\DivFunction());
        $this->register('COND', new Functions\CondFunction());
        $this->register('IF', new Functions\IfFunction());
        $this->register('DEFUN', new Functions\DefunFunction());
        $this->register('LIST', new Functions\ListFunction());
        $this->register('QUOTE', new Functions\QuoteFunction());
        $this->register('CAR', new Functions\CarFunction());
        $this->register('CDR', new Functions\CdrFunction());
        $this->register('CONS', new Functions\ConsFunction());
        $this->register('COLUMN', new Functions\ColumnFunction());
        $this->register('FILTER', new Functions\FilterFunction());
        $this->register('MIN', new Functions\MinFunction());
        $this->register('MAX', new Functions\MaxFunction());
        $this->register('IN', new Functions\InFunction());
        $this->register('SETQ', new Functions\SetqFunction());
    }

    /**
     * Запускает программу
     * @param string $program текст программы
     * @return mixed
     */
    public function run($program)
    {
        $syntax = new LispSyntax;
        return $this->calcLists($syntax->parse($program));
    }

    /**
     * Запускает программу в виде набора списков
     * @param array $lists
     * @return mixed
     */
    public function calcLists($lists)
    {
        $r = null;
        foreach ($lists as $list) {
            $r = $this->calc($list);
        }
        return $r;
    }

    /**
     * Задает состояние машины
     * @param array $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Возвращает состояние машины
     * @return array
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Задает переменную из состояния машины
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value)
    {
        $this->state[$name] = $value;
    }

    /**
     * Возвращает значение переменной из состояния машины
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return isset($this->state[$name]) ? $this->state[$name] : null;
    }

    /**
     * Регистрирует функцию
     * @param string $name
     * @param \SimpleLisp\Functions\FunctionInterface $func
     */
    public function register($name, $func)
    {
        $norm = strtoupper($name);
        $this->library[$norm] = $func;
    }

    /**
     * Вычисляет список
     * @param mixed $list
     * @return mixed
     * @throws \Exception
     */
    public function calc($list)
    {
        if (!is_array($list)) {
            if (isset($list[0]) && $list[0] == "'") {
                return substr($list, 1);
            }

            if (is_numeric($list)) {
                return $list;
            }

            return $this->get($list);
        }

        $name = array_shift($list);
        $norm = strtoupper($name);
        if (!isset($this->library[$norm])) {
            throw new \Exception('Function "' . $name . '" is not found');
        }
        $func = $this->library[$norm];
        return $func->run($this, $list);
    }

}
