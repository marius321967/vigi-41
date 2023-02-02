<?php

namespace MyApp\Query;

class ProductQueryParser {

  public function parse(string $input): array {
    if ($input === '')
      return [];

    $inputParts = explode(',', $input);
    $result = [];

    foreach ($inputParts as $inputPart) {
      $queryUnstructured = explode(':', $inputPart);
      $id = (int)$queryUnstructured[0];
      $amount = (int)$queryUnstructured[1];
      $query = new ProductQuery($id, $amount);
      $result[] = $query;
    }

    return $result;
  }

}

// $parser = new ProductQueryParser();
// var_dump($parser->parse('1:3,2:2,4:1')); // should return [ Query(1, 3), Query(2, 2), Query(4, 1) ]
// var_dump($parser->parse('-1:2,9:9')); // should return [ Query(-1, 2), Query(9, 9) ]
// var_dump($parser->parse('1:2')); // should not fail
// var_dump($parser->parse('')); // should return []
// var_dump($parser->parse('10:23,32:12')); // should not fail
// var_dump($parser->parse('a:23,32:12')); // should throw exception
