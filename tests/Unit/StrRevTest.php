<?php

beforeEach(function () {
    $this->strRev = new \Sunder\Tests\StrRev(
        [',', ':', '\'', '"', '»', '«'],
        ['-', '`']
    );
});

it('Letter case', function (string $input, string $output) {
    expect($this->strRev->reverseString($input))->toBe($output);
})->with([
    'latin'                     => ['Cat', 'Tac'],
    'cyrillic'                  => ['Мышь', 'Ьшым'],
    'single uppercase'          => ['houSe', 'esuOh'],
    'single cyrillic uppercase' => ['домИК', 'кимОД'],
    'multiple uppercase'        => ['elEpHant', 'tnAhPele'],
    'latin hyphen'              => ['third-part', 'driht-trap']
]);

it('Special characters', function (string $input, string $expected) {
    expect($this->strRev->reverseString($input))->toBe($expected);
})->with([
    'single latin'       => ['cat,', 'tac,'],
    'single cyrillic'    => ['Зима:', 'Амиз:'],
    'multiple latin'     => ['is \'cold\' now', 'si \'dloc\' won'],
    'multiple cyrillic'  => ['это «Так» "просто"', 'отэ «Кат» "отсорп"'],
    'special chars only apostrophe' => ['```', '```'],
    'special chars only (")'        => ['"""', '"""']
]);
