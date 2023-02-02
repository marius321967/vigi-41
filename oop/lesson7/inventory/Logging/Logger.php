<?php

namespace MyApp\Logging;

class Logger {

  public function logMessage(string $message) {
    echo $message.PHP_EOL;
  }

}