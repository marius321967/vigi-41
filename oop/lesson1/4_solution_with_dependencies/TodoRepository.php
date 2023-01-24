<?php

class TodoRepository
{

  private FileService $fileService;
  private StringStorageService $stringStorageService;

  public function __construct(FileService $fileService, StringStorageService $stringStorageService)
  {
    $this->fileService = $fileService;
    $this->stringStorageService = $stringStorageService;
  }

  public function add(array $todoItem)
  {
    $initialContent = $this->fileService->readFromFile();
    $todoList = $this->stringStorageService->decode($initialContent);

    $todoList[] = $todoItem;

    $updatedContent = $this->stringStorageService->encode($todoList);
    $this->fileService->writeToFile($updatedContent);
  }

  public function getAll(): array
  {
    $initialContent = $this->fileService->readFromFile();
    $todoList = $this->stringStorageService->decode($initialContent);

    return $todoList;
  }

  public function markDone($id)
  {
    $initialContent = $this->fileService->readFromFile();
    $todoList = $this->stringStorageService->decode($initialContent);

    $todoList[$id]->done = true;

    $updatedContent = $this->stringStorageService->encode($todoList);
    $this->fileService->writeToFile($updatedContent);
  }
}
