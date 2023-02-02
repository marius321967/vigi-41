<?php

namespace MyApp\Query;

class ProductQuery {

  private int $id;
  private int $amount;

  public function __construct(int $id, int $amount) {
    $this->id = $id;
    $this->amount = $amount;
  }

  public function getId(): int {
    return $this->id;
  }

  public function getAmount(): int {
    return $this->amount;
  }

}
