<?php

namespace MyApp\Utils;

class JsonParser {

  public function parseJson(string $input): array {
    return json_decode($input, true);
  }

}
