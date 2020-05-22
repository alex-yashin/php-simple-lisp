<?php

namespace SimpleLisp;

class LispSyntax
{

    protected $tokens = [];

    public function parse($lisp)
    {
        $tokenizer = new LispTokenizer($lisp);
        $this->tokens = $tokenizer->getAll();

        $token = $this->next();
        if ($token == '(') {
            return $this->getList();
        }

        return $token;
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
        
        throw new \Exception('Syntax error');
    }

    public function next()
    {
        return array_shift($this->tokens);
    }

}