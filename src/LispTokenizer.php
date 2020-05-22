<?php

namespace SimpleLisp;

class LispTokenizer
{

    private $program = '';
    private $position = 0;

    public function __construct($program)
    {
        $this->program = $program;
        $this->position = 0;
    }

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

    public function getNext()
    {
        $this->space();
        return $this->token();
    }

    protected function read()
    {
        $symbol = $this->symbol();
        $this->position++;
        return $symbol;
    }

    protected function back()
    {
        $this->position--;
    }

    protected function isFinish()
    {
        return !isset($this->program[$this->position]);
    }

    protected function symbol()
    {
        if ($this->isFinish()) {
            return null;
        }
        return $this->program[$this->position];
    }

    protected function space()
    {
        while ($this->isSpace($this->read())) {
        }
        $this->back();
    }

    protected function isSpace($symbol)
    {
        return \in_array($symbol, [' ', "\n", "\t", "\r"], true);
    }

    protected function isBracket($symbol)
    {
        return \in_array($symbol, ['(', ")"]);
    }

    protected function enclosure()
    {
        $symbol = $this->read();
        if (in_array($symbol, ['"', "'"])) {
            return $symbol;
        }
        $this->back();
        return null;
    }

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
            return $token;
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
