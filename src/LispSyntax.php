<?php

namespace SimpleLisp;

class LispSyntax
{

    protected $tokens = [];

    public function parse($lisp)
    {
        $tokenizer = new LispTokenizer($lisp);
        $this->tokens = $tokenizer->getAll();

        return $this->getList();
    }

    public function getList()
    {
        $list = [];
        while (($token = $this->next()) !== null) {
            if ($token == ')') {
                return $list;
            }

            if ($token == '(') {
                array_push($list, $this->getList());
                continue;
            }

            array_push($list, $token);
        }
        
        return $list;

//        throw new \Exception('Syntax error');
    }

    public function next()
    {
        return array_shift($this->tokens);
    }

}
