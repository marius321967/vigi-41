<?php


$someProducts = [
    '000_product_1  ',
    ' 000_product_2',
    '000_product_3  ',
    '000_product_4',
    '  000_product_5 ',
    '000_product_20
    ',
];

function exercise1(array $products): int
{
    /*
    Suskaičiuokite ir grąžinkite visų $products masyve esančių eilučių ilgių sumą, BET
    į sumą neįtraukite tuščių simbolių - ty. tarpų, new line ir pan.
    Naudokite $someProducts masyvą.
    */

    $sum = 0;

    foreach ($products as $products) {
        $sum += strlen( trim($products) );
    }

    return $sum;
}
// var_dump(exercise1($someProducts));



function exercise3(): array
{
    /*
    Grąžinkite masyvą, kuris talpintų tik tuos žodžius, kurie panašūs į emailų adresus
    t.y. turi savyje simbolį @
    */
    $emails = [
        'some@email.com',
        'someAemail.com',
        'another@gmail.com',
        'notAreal.email.com',
        'real@gmail.com',
    ];

    return array_filter(
        $emails,
        function(string $email) {
            return str_contains($email, '@');
            
            // if (str_contains($email, '@'))
            //     return true;
        }
    );
}

// print_r(exercise3());

function exercise5(): array
{
    /*
    Kiekvienam žodžiui apskaičiuokite balsių skaičių (a, e, i, o, u)
    Funkcijos kvietimas: exercise4()
    Funkcija grąžina: [2, 3, 3, 1, 2]
    */

    $vowels = ['a', 'e', 'i', 'o', 'u'];
    $vowelsLine = implode('', $vowels);
    var_dump($vowelsLine);

    $words = [
        'tennis',
        'rooftops',
        'hillside',
        'warm',
        'friends',
    ];

    $result = [];

    foreach ($words as $i => $word) {
        $result[$i] = 0;

        for ($j = 0; $j < strlen($word); $j++) {
            if (str_contains($vowelsLine, $word[$j]))
                $result[$i]++;
        }
    }

    return $result;
}

print_r(exercise5());

function advancedExercise1(string $stringToSplit, array $delimiters): array
{
    /*
    Funkcija turi priimti string'ą, kuris bus skaidomas,
    bei masyvą segmentų, pagal kuriuos bus skaidoma.
    Kvietimas turi atrodyti taip:
    exercise1('Hello_how_are-you doing?', [' ', '-', '_'])
    Funkcijos outputas turėtų atrodyti taip:
    ['Hello', 'how', 'are', 'you', 'doing?']
    */

    for ($i = 1; $i < count($delimiters); $i++) {
        $stringToSplit = str_replace($delimiters[$i], $delimiters[0], $stringToSplit);
    }

    return explode($delimiters[0], $stringToSplit);
}

// print_r( exercise1('Hello_how_are-you doing?', [' ', '-', '_']) );
