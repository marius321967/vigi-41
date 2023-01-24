<?php

require './TodoRepository.php';
require './FileService.php';
require './StringStorageService.php';

/*
Sukurkite paprastą todo aplikaciją. Naudokite objektinį programavimą. Aplikacija turi turėti 3 funkcijas:
- add - pridėti naują todo
- list - atvaizduoti visus todo
- complete - pažymėti kažkurį todo kaip padarytą. Padarytus todo galima arba trinti, arba pridėti požymį "completed"
Aplikacijos kvietimo pavyzdžiai:
------------------------------------------------------------------------
php -f todo.php add "nuplauti automobilų" "2022-03-29 15:00"
todo added!
------------------------------------------------------------------------
php -f todo.php list
****
id: 1
nuplauti automobili
2022-03-29 15:00
------------------------------------------------------------------------
php -f todo.php add "apsilankymas pas kirpeją" "2022-04-15 12:00"
todo added!
------------------------------------------------------------------------
php -f todo.php list
****
id: 1
nuplauti automobilų
2022-03-29 15:00
****
id: 2
apsilankymas pas kirpeją
2022-04-15 12:00
------------------------------------------------------------------------
php -f todo.php complete 1
todo completed!
------------------------------------------------------------------------
*/

// Setup services
$fileService = new FileService('./data.json');
$stringStorageService = new StringStorageService();
$todoRepository = new TodoRepository($fileService, $stringStorageService);

// Error if no argument provided
if (count($argv) == 1) {
  echo 'Provide one of the operations: add, list or complete' . PHP_EOL;
  exit(1);
}

// Handle operations
$operation = $argv[1];

if ($operation == 'list') {
  $todoItems = $todoRepository->getAll();

  foreach ($todoItems as $id => $todoItem) {
    echo '****' . PHP_EOL;
    echo "id: $id" . PHP_EOL;
    echo $todoItem['task'] . PHP_EOL;
  }
}
