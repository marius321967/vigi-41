<?php

$file = './todo.json';

$todo = $_POST['todo'];

// $oldContents = file_get_contents($file);
// $todoList = [];
// if ($oldContents !== false) {
//   $todoList = json_decode($oldContents, true);

//   if ($todoList === null)
//     $todoList = [];
// }

// $todoList[] = [ 'todo' => $todo ];
// $newContents = json_encode($todoList, JSON_PRETTY_PRINT);
// file_put_contents($file, $newContents);

function readOldTodoList(string $file): array {
  $contents = file_get_contents($file);

  if ($contents === false) {
    return [];
  }

  $todoList = json_decode($contents);

  if ($todoList === null)
    return [];

  return $todoList;
}

function includeNewTodo(array $todoList, string $newTodo): array {
  $todoList[] = ['todo' => $newTodo];
  return $todoList;
}

function writeNewTodoList(string $file, array $todoList): void {
  $contents = json_encode($todoList, JSON_PRETTY_PRINT);

  file_put_contents($file, $contents);
}

$oldTodo = readOldTodoList($file);
$newTodo = includeNewTodo($oldTodo, $_POST['todo']);
writeNewTodoList($file, $newTodo);

// obtain old todo list
// obtain by adding new todo item to old todo list
// write new todo list to file

?>

Task submitted: <?= $todo ?>. 
<a href="/">Go back</a>

