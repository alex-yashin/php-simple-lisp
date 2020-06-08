<?php

namespace SimpleLisp;

class LispFormatter
{

    /**
     * Форматирует программу
     * @param string $lisp
     * @return string
     */
    public function format($lisp, $eol = "\n", $tab = ' ')
    {
        $syntax = new LispSyntax();
        $list = $syntax->parse($lisp);

        $r = [];
        foreach ($list as $item) {
            $r[] = $this->getFormatted($item, $eol, $tab, 0);
        }

        return implode($eol, $r);
    }

    public function getFormatted($list, $eol, $tab, $level)
    {
        $hasList = false;
        $enclosedList = [];
        foreach ($list as $item) {
            if (is_array($item)) {
                $hasList = true;
                $enclosedList[] = $this->getFormatted($item, $eol, $tab, $level + 1);
            } else {
                $enclosedList[] = $this->getEnclosed($item);
            }
        }

        if ($hasList) {
            $tabs = str_repeat($tab, ($level + 1) * 4);
            return '(' . implode($eol . $tabs, $enclosedList) . ')';
        }

        return '(' . implode(' ', $enclosedList) . ')';
    }

    public function getEnclosed($item)
    {
        if (isset($item['0']) && $item[0] == "'") {
            return "'" . substr($item, 1) . "'";
        }
        return $item;
    }

}
