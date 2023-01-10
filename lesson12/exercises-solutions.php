<?php

// 1. Parašykite funkciją, kuri pašalintų paskutinį žodį iš stringo
// "A car is standing in a parkinglot." --> "A car is standing in a"

function replaceLastWord(string $sentence): string
{
  return preg_replace('/ [\w-]+\.$/', '', $sentence);
}

// var_dump(replaceLastWord('A car is standing upside-down.'));
// var_dump(replaceLastWord('A car is standing in a parkinglot.'));

// 2. Parašykite funkciją, kuri patikrintų, ar tekstas atitinka lietuviško mobilaus telefono numerio formatą
// "+37062345678" - true
// "+37012345678" - false
// "+3706234567" - false
// "+3706234567a" - false

function isValidLithuanianPhone(string $phone): bool
{
  return preg_match('/^\+3706\d{7}$/', $phone) === 1;
}

$phones = [
  '+37062345678',
  '+37012345678',
  '+3706234567',
  '+3706234567a',
];

// foreach ($phones as $phone) {
//   echo $phone . ' - ' . (int)isValidLithuanianPhone($phone) . PHP_EOL;
// }

// 3. Patobulinkite funkciją (2). Funkcija turėtų galėti patikrinti ir tokius telefono numerius:
// "+370 623 45678"
// "+370-623-45678"
// "+370-623 45678"
// "00370 623 45678"

// Jeigu telefono numeris validus, iš funkcijos turėtų grįžti tvarkingai suformatuotas telefono numeris:
// "+370-623 45678" --> "+37062345678"

function normalizePhone(string $phone): string
{
  return preg_replace('/^(\+|00)370( |-)6(\d{2})( |-)(\d{5})$/', '+3706$3$5', $phone);
}

$phones = [
  '+370 623 45678',
  '+370-623-45678',
  '+370-623 45678',
  '00370 623 45678',
  'asdasfd',
];

// foreach ($phones as $phone) {
//   var_dump(normalizePhone($phone));
// }

// 4. Parašykite funkciją, kuri užmaskuotų dalį vartotojo duomenų. Pavardės ir gimimo metų simboliai
// turėtų būti pakeisti i simbolius 'X'.
// "John Smith, 1979 05 15" --> "John XXXXX, XXXX 05 15"

function obfuscatePrivateInfo(string $info): string
{
  $matches = [];
  $matched = preg_match('/^(\w+) (\w+), (\d{4}) (\d{2}) (\d{2})$/', $info, $matches);

  if ($matched === 0)
    return $info;

  $lastName = $matches[2];
  $lastNameObfuscated = str_pad('', strlen($lastName), 'X');

  return "$matches[1] $lastNameObfuscated, XXXX $matches[4] $matches[5]";
}

// var_dump(obfuscatePrivateInfo('John Smith, 1979 05 15'));

// 5. Parašykite funkciją, kuri pravaliduotų IPv4 adresą. IPv4 adresas yra sudarytas iš 4 skaičių, kurių kiekvienas gali
// būti nuo 0 iki 255. Skaičiai atskirti taškais.
// Pvz.:
// 255.255.255.255
// 1.1.0.1

function validateIpv4(string $input): bool
{
  $matches = [];
  preg_match('/^(\d{1,3}).(\d{1,3}).(\d{1,3}).(\d{1,3})$/', $input, $matches);
  $segments = array_slice($matches, 1);

  foreach ($segments as $segment) {
    if ((int)$segment > 255)
      return false;
  }

  return true;
}

// var_dump(validateIpv4('255.255.255.255'));
// var_dump(validateIpv4('255.255.198.255'));
// var_dump(validateIpv4('255.255.255.256'));
