<?php

namespace MyApp\Inventory;

class InventoryConverter {

  public function convert(array $unstructuredInventory): array {
    $result = [];

    foreach ($unstructuredInventory as $unstructuredProduct) {
      $result[] = new Product(
        $unstructuredProduct['product_id'], 
        $unstructuredProduct['name'], 
        $unstructuredProduct['quantity']
      );
    }

    return $result;
  }

}

// $converter = new InventoryConverter();
// $input = [
//   [
//     'product_id' => 1,
//     'name' => 'Lamp',
//     'quantity' => 15
//   ],
//   [
//     'product_id' => 2,
//     'name' => 'Sofa',
//     'quantity' => 12
//   ],
// ];
// should return [
//   Product(id - 1, name - 'Lamp', amount - 15)
//   Product(id - 2, name - 'Sofa', amount - 12)
// ]
// var_dump($converter->convert($input));
