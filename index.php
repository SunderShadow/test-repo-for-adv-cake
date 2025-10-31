<?php
$str = 'аб';
echo ord($str[0]), ' ', ord($str[1]);
echo ord($str[2]), ' ', ord($str[3]);
$first_char = mb_substr($str, 5 ,  1, "UTF-8"); // Extracts the first character

echo IntlChar::isupper('Т') ? 'da' : 'net';