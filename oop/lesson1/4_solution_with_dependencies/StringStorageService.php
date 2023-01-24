<?php

class StringStorageService
{
  public function encode(array $input): string
  {
    return json_encode($input);
  }

  public function decode(string $input): array
  {
    return json_decode($input, true);
  }
}

// manual testing
// $fruits = ['pear', 'apple', 'orange'];
// $service = new StringStorageService();
// $encodedFruits = $service->encode($fruits);
// var_dump($encodedFruits);
// $decodedFruits = $service->decode($encodedFruits);
// var_dump($decodedFruits);
