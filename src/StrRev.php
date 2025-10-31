<?php

namespace Sunder\Tests;

/**
 * Разворачивает строку с сохранением позиций спец символов
 */
class StrRev
{
    /**
     * @param array $skipChars
     * Символы которые не надо разворачивать
     */
    public function __construct(private readonly array $skipChars)
    {
    }

    /**
     * Меняет местами символы в слове
     * за исключением StrRev::$specialChars
     * @param string $str
     * @return string
     */
    public function reverseWord(string $str): string
    {
        /* Решение основывается на двух указателях
        /== Время исполнения: O(n)
        /== Используемая память: O(n)
        */

        // Разбиваем мультибайт на массив
        // Так проще работать
        $strSplit = mb_str_split($str);

        $rI = count($strSplit) - 1;
        $lI = 0;

        while ($lI < $rI) {
            $lChr = &$strSplit[$lI];
            $rChr = &$strSplit[$rI];

            // Двигаем левый указатель вперед
            // Если спец символ
            if ($this->charIsSpecial($lChr)) {
                $lI++;
                continue;
            }

            // Двигаем правый указатель назад
            // Если спец символ
            if ($this->charIsSpecial($rChr)) {
                $rI--;
                continue;
            }

            // Меняем символы местами
            $lChr = $lChr ^ $rChr;
            $rChr = $lChr ^ $rChr;
            $lChr = $lChr ^ $rChr;

            // Сохраняем состояния регистров символов
            $lChrIsUpper = \IntlChar::isupper($lChr);
            $rChrIsUpper = \IntlChar::isupper($rChr);

            // Меняем регистры символов местами
            $rChr = $lChrIsUpper ? \IntlChar::toupper($rChr) : \IntlChar::tolower($rChr);
            $lChr = $rChrIsUpper ? \IntlChar::toupper($lChr) : \IntlChar::tolower($lChr);

            $lI++; $rI--;
        }

        return implode('', $strSplit);
    }

    public function reverseString(string $str)
    {
        $explodedStr = explode(' ', $str);

        foreach ($explodedStr as &$word) {
            $word = $this->reverseWord($word);
        }

        return implode(' ', $explodedStr);
    }

    private function charIsSpecial(string $chr): bool
    {
        return in_array($chr, $this->skipChars);
    }
}