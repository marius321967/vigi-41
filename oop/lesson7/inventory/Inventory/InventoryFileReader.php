<?php

namespace MyApp\Inventory;

class InventoryFileReader {

  public function readInventory(): string {
    return file_get_contents('./inventory.json');
  }
  
}
