<?php

namespace SimpleLisp;

class LispSyntax
{

    protected $tokens = [];

    /**
     * Разбивает программу на списки
     * @param string $lisp
     * @return array
     */
    public function parse($lisp)
    {
        $tokenizer = new LispTokenizer($lisp);
        $this->tokens = $tokenizer->getAll();

        return $this->getList();
    }

    /**
     * Строит список
     * @return array
     */
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

    /**
     * Возвращает следующий токен
     * @return string
     */
    public function next()
    {
        return array_shift($this->tokens);
    }

}
