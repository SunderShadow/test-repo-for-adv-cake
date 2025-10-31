<?php

class Data {
    static \Sunder\Tests\StrRev $strRev;
}

Data::$strRev = new \Sunder\Tests\StrRev();

test('Letter case', function () {

    $executionMap = [
        'Cat' => 'Tac',
        'Мышь' => 'Ьшым',
        'houSe' => 'esuOh',
        'домИК' => 'кимОД',
        'elEpHant' => 'tnAhPele'
    ];

    $expectation = expect(true)->toBeTrue();

    foreach ($executionMap as $input => $expectedOutput) {
        $expectation = $expectation->and(Data::$strRev->reverse($input))->toBe($expectedOutput);
    }
});
