<?php

class FileService
{
  private string $filename;

  public function __construct(string $filename)
  {
    $this->filename = $filename;
  }

  public function writeToFile(string $content): void
  {
    file_put_contents($this->filename, $content);
  }

  public function readFromFile(): string
  {
    return file_get_contents($this->filename);
  }
}

// manual testing
// $service = new FileService('./test.txt');
// $service->writeToFile('testing...');
// var_dump($service->readFromFile());
