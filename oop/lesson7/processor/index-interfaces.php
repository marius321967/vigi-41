<?php

$categories = [
    'fruits' => [
        'type' => 'category',
        'items' => [
            'apple' => [
                'count' => 5,
                'price' => 0.15,
            ],
            'pear' => [
                'count' => 5,
                'price' => 0.15,
            ],
        ],
    ],
    'vegetables' => [
        'type' => 'category',
        'items' => [
            'carrot' => [
                'count' => 100,
                'price' => 0.01,
            ],
            'tomato' => [
                'count' => 45,
                'price' => 0.5,
            ],
        ],
    ],
    'seafood' => [
        'type' => 'category',
        'items' => [
            'seabass' => [
                'count' => 15,
                'price' => 5.5,
            ],
        ],
    ],
    'alcohol' => [
        'type' => 'category',
        'items' => [
            'beer_bottle' => [
                'count' => 22,
                'price' => 1.3,
            ],
            'wine_bottle' => [
                'count' => 4,
                'price' => 8,
            ],
        ],
    ],
    'milk' => [
        'type' => 'category',
        'items' => [
            'cheese' => [
                'count' => 1,
                'price' => 4.5,
            ],
            'yoghurt' => [
                'count' => 13,
                'price' => 0.99,
            ],
        ],
    ],
    'bread' => [
        'type' => 'category',
        'items' => [
            'brown_bread' => [
                'count' => 11,
                'price' => 2.1,
            ],
            'white_bread' => [
                'count' => 110,
                'price' => 1.3,
            ],
        ],
    ],
];

interface DataEncoderInterface {
  public function encode(array $data): string;
}

class JsonEncoder implements DataEncoderInterface {

  public function encode(array $data): string {
    return json_encode($data);
  }

}

class CsvEncoder implements DataEncoderInterface {

  public function encode(array $data): string {
    $result = 'Type,Items'.PHP_EOL;
    foreach ($data as $item) {
      $result .= $item['type'] . ',';
      $result .= count($item['items']) . ',';
      $result .= PHP_EOL;
    }

    return $result;
  }

}

interface DataOutputHandlerInterface {
  public function writeOutput(string $data): void;
}

class TerminalOutputHandler implements DataOutputHandlerInterface {

  public function writeOutput(string $data): void {
    echo $data.PHP_EOL;
  }

}

class FileOutputHandler implements DataOutputHandlerInterface {

  public function writeOutput(string $data): void {
    file_put_contents('result.txt', $data);
  }

}

class DataProcessor
{
  private array $data;

  public function __construct(array $data)
  {
    $this->data = $data;
  }

  public function process(DataEncoderInterface $encoder, DataOutputHandlerInterface $outputWriter): void
  {
    $result = $encoder->encode($this->data);
    $outputWriter->writeOutput($result);
  }
}

$jsonEncoder = new JsonEncoder();
$csvEncoder = new CsvEncoder();

$terminalWriter = new TerminalOutputHandler();
$fileWriter = new FileOutputHandler();

$dataProcessor = new DataProcessor($categories);
$dataProcessor->process($jsonEncoder, $fileWriter);
$dataProcessor->process($jsonEncoder, $terminalWriter);
$dataProcessor->process($csvEncoder, $fileWriter);
$dataProcessor->process($csvEncoder, $terminalWriter);

/*
Klasė DataProcessor suteikia mums galimybę užkoduoti duomenis tam tikru formatu (JSON arba XML) ir išvesti juos į failą
arba terminalą. Tai yra daroma kviečiant metodą 'process'.
1.1 Įgyvendinkite 'process' metodo logiką klasėje DataProcessor
1.2 Perkelkite metodo 'process' encodinimo ir išvesties logiką į atskiras klases, kurios būtų susietos interfeisais.
Galėtų būti šie interfeisai:
- DataEncoderInterface
    - JsonEncoder
    - XmlEncoder
- DataOutputHandlerInterface
    - TerminalOutputHander
    - FileOutputHandler
Daugiau apie XML formatą: https://www.w3schools.com/xml/xml_whatis.asp
*/