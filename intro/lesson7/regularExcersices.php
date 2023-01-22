<?php
declare(strict_types=1);

$globalCities = [
    [
        'name' => 'Tokyo',
        'population' => 37_435_191,
    ],
    [
        'name' => 'Delhi',
        'population' => 29399141,
    ],
    [
        'name' => 'Shanghai',
        'population' => 26317104,
    ],
    [
        'name' => 'Sao Paulo',
        'population' => 21846507,
    ],
    [
        'name' => 'Mexico City',
        'population' => 21671908,
    ],
    [
        'name' => 'New York',
        'population' => 25000000,
    ],
];

function exercise1($cities): int
{
    /*
    Suskaičiuokite bendrą miestų populiaciją pasinaudodami paprastu 'foreach' ir grąžinkite ją iš funkcijos.
    Miestus pasiimkite iškvietę funkciją 'getCities'
    */
    $sum = 0;
    
    foreach ($cities as $city) {
        $sum = $sum + $city['population'];
    }

    return $sum;
}

// var_dump( exercise1($globalCities) );

function exercise2(array $cities): int
{
    /*
    Suskaičiuokite bendrą miestų populiaciją pasinaudodami funkcijomis array_column ir array_sum
    ir grąžinkite ją iš funkcijos
    */

    return array_sum(array_column($cities, 'population'));
}

// var_dump( exercise2($globalCities) );

function exercise3(array $cities): int
{
    /*
    Suskaičiuokite bendrą miestų populiaciją pasinaudodami funkcija array_reduce ir grąžinkite ją iš funkcijos
    */

    return array_reduce(
        $cities,
        function(int $carry, array $city) {
            return $carry + $city['population'];
        },
        0
    );
}

// var_dump( exercise3($globalCities) );

function exercise4(array $cities): int
{
    /*
    Suskaičiuokite populiaciją miestų, kurie yra didesni nei 25,000,000 gyventojų.
    Rinkites sau patogiausią skaičiavimo būdą.
    */

    $largeCities = array_filter(
        $cities,
        function(array $city): bool {
            return $city['population'] > 25_000_000;
        }
    );

    // var_dump($largeCities);

    return exercise2($largeCities);

    // return array_reduce(
    //     $cities,
    //     function(int $carry, array $city) {
    //         if ($city['population'] <= 25_000_000)
    //             return $carry;
    //         else
    //             return $carry + $city['population'];
    //     },
    //     0
    // );
}

var_dump( exercise4($globalCities) );

function exercise5(): array
{
    /*
    Grąžinkite masyvą, kuriame būtų tik tie miestai, kurie yra didesni nei 25,000,000 gyventojų
    Rezultatas turi būti tokios pat struktūros, kaip ir pradinis miestų masyvas:
    [
        [
            'name' => 'Tokyo',
            'population' => 37435191,
        ],
        ...
    ]
    */

    return [];
}

function exercise6(): int
{

    /*
    Suskaičiuokite ir grąžinkite bendrą užsakymo sumą.
    Prekėms, kurių pavadinimai nurodyti masyve $lowPriceItems, taikykite kainą 'priceLow'.
    Kitoms prekėms taikykite kainą 'priceRegular'.
    Bandykite panaudoti array_* funkcijas.
    */

    $lowPriceItems = ['t-shirt', 'shoes'];

    $orderItems = [
        [
            'name' => 't-shirt',
            'priceRegular' => 15,
            'priceLow' => 13,
            'quantity' => 3,
        ],
        [
            'name' => 'coat',
            'priceRegular' => 74,
            'priceLow' => 60,
            'quantity' => 6,
        ],
        [
            'name' => 'shirt',
            'priceRegular' => 25,
            'priceLow' => 20,
            'quantity' => 2,
        ],
        [
            'name' => 'shoes',
            'priceRegular' => 115,
            'priceLow' => 100,
            'quantity' => 1,
        ],
    ];


    return 0;
}