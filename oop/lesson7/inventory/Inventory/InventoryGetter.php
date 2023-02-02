<?php

namespace MyApp\Inventory;

use MyApp\Utils\JsonParser;

class InventoryGetter {

  private InventoryFileReader $reader;
  private JsonParser $parser;
  private InventoryConverter $converter;

  public function __construct(InventoryFileReader $reader, JsonParser $parser, InventoryConverter $converter) {
    $this->reader = $reader;
    $this->parser = $parser;
    $this->converter = $converter;
  }

  public function getInventory(): array {
    $inventoryJson = $this->reader->readInventory();
    $inventoryUnstructured = $this->parser->parseJson($inventoryJson);
    return $this->converter->convert($inventoryUnstructured);
  }

}
