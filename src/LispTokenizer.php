<?php

namespace SimpleLisp;

class LispTokenizer
{

    private $program = '';
    private $position = 0;

    /**
     * Инициализирует лексический анализатор
     * @param string $program
     */
    public function __construct($program)
    {
        $this->program = $program;
        $this->position = 0;
    }

    /**
     * Возвращает набор токенов
     * @return array
     */
    public function getAll()
    {
        $tokens = [];

        while (1) {
            $token = $this->getNext();
            if (is_null($token)) {
                break;
            }
            $tokens[] = $token;
        }

        return $tokens;
    }

    /**
     * Ищет следующий токен
     * @return string
     */
    public function getNext()
    {
        $this->space();
        return $this->token();
    }

    /**
     * Читает символ и сдвигает курсор вправо
     * @return string
     */
    protected function read()
    {
        $symbol = $this->symbol();
        $this->position++;
        return $symbol;
    }

    /**
     * Перемещает курсор на одну позицию влево
     */
    protected function back()
    {
        $this->position--;
    }

    /**
     * Проверяет не закончилась ли лента
     * @return boolean
     */
    protected function isFinish()
    {
        return !isset($this->program[$this->position]);
    }

    /**
     * Возвращает символ в текущей позиции курсора
     * @return string
     */
    protected function symbol()
    {
        if ($this->isFinish()) {
            return null;
        }
        return $this->program[$this->position];
    }

    /**
     * Пропускает все пробельные символы
     */
    protected function space()
    {
        while ($this->isSpace($this->read())) {
        }
        $this->back();
    }

    /**
     * Определяет, является ли символ пробельным
     * @param string $symbol
     * @return boolean
     */
    protected function isSpace($symbol)
    {
        return \in_array($symbol, [' ', "\n", "\t", "\r"], true);
    }

    /**
     * Проверяет, является ли символ скобкой
     * @param string $symbol
     * @return boolean
     */
    protected function isBracket($symbol)
    {
        return \in_array($symbol, ['(', ")"]);
    }

    /**
     * Читает символ кавычки
     * @return string | null
     */
    protected function enclosure()
    {
        $symbol = $this->read();
        if (in_array($symbol, ['"', "'"])) {
            return $symbol;
        }
        $this->back();
        return null;
    }

    
    /**
     * Читает токен
     * @return string
     * @throws \Exception
     */
    protected function token()
    {
        $enclosure = $this->enclosure();
        if ($enclosure) {
            $token = '';
            while (true) {
                $symbol = $this->read();
                if (is_null($symbol)) {
                    throw new \Exception("Unexpected end of input");
                } else if ($symbol === $enclosure) {
                    break;
                }
                $token .= $symbol;
            }
            return "'" . $token;
        }

        $symbol = $this->read();
        if (is_null($symbol)) {
            return null;
        } else if ($this->isBracket($symbol)) {
            return $symbol;
        } else {
            $this->back();
        }

        $token = '';
        while (1) {
            $symbol = $this->read();
            if (is_null($symbol)) {
                return $token === '' ? null : $token;
            } else if ($this->isSpace($symbol) || $this->isBracket($symbol)) {
                $this->back();
                break;
            }
            $token .= $symbol;
        }
        return $token;
    }

//    protected function log($m, $v)
//    {
//        echo $m;
//        echo ' ';
//        var_dump($v);
//        echo "\n";
//    }
}
