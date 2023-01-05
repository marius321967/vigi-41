<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <form method="POST" action="submit.php">
    <label for="todoInput">Write your task:</label>
    <input type="text" id="todoInput" name="todo" placeholder="TODO">

    <input type="submit">
  </form>

  <?php
  $fileContents = file_get_contents('todo.json');
  $todoList = json_decode($fileContents, true);
  ?>

  <div>
    <h2>TODO list</h2>

    <ul>
      <?php foreach ($todoList as $todoItem) : ?>
        <li><?= $todoItem['todo'] ?></li>
      <?php endforeach ?>
    </ul>
  </div>

</body>
</html>
