<?php

namespace MyApp\InventoryAvailability;

use MyApp\Query\ProductQuery;

/**
 * Uses query to check for product availability in given inventory.
 */
class ProductAvailabilityService {

  /**
   * Checks inventory against single query.
   * If product by given ID was not found, throws Exception
   * If product was found but has an insufficient amount, throws Exception.
   * Otherwise returns nothing.
   */
  public function checkAvailability(ProductQuery $query, array $inventory): void {
    $searchedId = $query->getId();

    $foundProduct = null;

    foreach ($inventory as $product) {
      if ($searchedId == $product->getId()) {
        $foundProduct = $product;
        break;
      }
    }

    if ($foundProduct === null) {
      throw new InventoryException("product \"$searchedId\" only has 0 items in the inventory");
    }

    if ($query->getAmount() > $foundProduct->getQuantity()) {
      $quantity = $foundProduct->getQuantity();
      throw new InventoryException("product \"$searchedId\" only has $quantity items in the inventory");
    }
  }

  public function checkAvailabilityForAll(array $queries, array $inventory): void {
    foreach ($queries as $query) {
      $this->checkAvailability($query, $inventory);
    }
  }

}
