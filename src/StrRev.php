<?php

namespace Sunder\Tests;

/**
 * Разворачивает строку с сохранением позиций спец символов
 */
class StrRev
{
    /**
     * Решение основывается на двух указателях
     * Время исполнения: O(n)
     * Используемая память(n)
     * @param string $str
     * @return string
     */
    public function reverse(string $str): string
    {
        $strSplit = mb_str_split($str);

        $rI = count($strSplit) - 1;
        $lI = 0;

        while ($lI < $rI) {
            $strSplit[$lI] = $strSplit[$lI] ^ $strSplit[$rI];
            $strSplit[$rI] = $strSplit[$lI] ^ $strSplit[$rI];
            $strSplit[$lI] = $strSplit[$lI] ^ $strSplit[$rI];

            $lChrIsUpper = \IntlChar::isupper($strSplit[$lI]);
            $rChrIsUpper = \IntlChar::isupper($strSplit[$rI]);

            // Меняем регистры местами
            $strSplit[$rI] = $lChrIsUpper ? \IntlChar::toupper($strSplit[$rI]) : \IntlChar::tolower($strSplit[$rI]);
            $strSplit[$lI] = $rChrIsUpper ? \IntlChar::toupper($strSplit[$lI]) : \IntlChar::tolower($strSplit[$lI]);

            $lI++; $rI--;
        }

        return implode('', $strSplit);
    }
}