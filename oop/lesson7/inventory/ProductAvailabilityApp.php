<?php

namespace MyApp;

use MyApp\Inventory\InventoryGetter;
use MyApp\InventoryAvailability\InventoryException;
use MyApp\InventoryAvailability\ProductAvailabilityService;
use MyApp\Logging\Logger;
use MyApp\Query\ProductQueryParser;

class ProductAvailabilityApp {

  public function __construct(
    private ProductQueryParser $queryParser,
    private InventoryGetter $inventoryGetter,
    private ProductAvailabilityService $availability,
    private Logger $logger
  )
  {}

  public function execute(array $arguments) {
    $queries = $this->queryParser->parse($arguments[1]);
    $inventory = $this->inventoryGetter->getInventory();
    
    try {
      $this->availability->checkAvailabilityForAll($queries, $inventory);

      $this->logger->logMessage('all products have the requested quantity in stock');
    }
    catch (InventoryException $e) {
      $this->logger->logMessage($e->getMessage());
    }
  }

}