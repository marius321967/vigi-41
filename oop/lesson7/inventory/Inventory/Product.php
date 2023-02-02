<?php

namespace MyApp\Inventory;

class Product {

  private int $id;
  private string $name;
  private int $quantity;

  public function __construct(int $id, string $name, int $quantity)
  {
    $this->id = $id;
    $this->name = $name;
    $this->quantity = $quantity;
  }

  public function getId(): int {
    return $this->id;
  }

  public function getName(): string {
    return $this->name;
  }

  public function getQuantity(): int {
    return $this->quantity;
  }

}