<?php

/*
--------------------------------


Iškelkite klases priklausomai nuo jūsų projekto.
Nepamirškite klasėms pridėti namespace.

Ištrinkite $container->set() ten, kur konstruktoriai nepriima primityvių duomenų
(priima objektus arba nereikalauja visai nieko).


--------------------------------
*/

/**
 * Used internally by Container
 * @see Container
 */
class ContainerArgumentTypeException extends Exception
{

  public const ISSUE_NO_TYPE = 'no_type';
  public const ISSUE_NON_NAMED_TYPE = 'non_named_type'; // Is not a simple named type (union or intersection)
  public const ISSUE_PRIMITIVE_TYPE = 'primitive_type';


  public function __construct(private string $argumentName, private string $issue)
  {
  }

  public function getArgumentName()
  {
    return $this->argumentName;
  }

  public function getIssue(): string
  {
    return $this->issue;
  }

  public static function messageForClass(string $className, ContainerArgumentTypeException $exception)
  {
    $identifier = "$className::__construct(\${$exception->getArgumentName()})";

    switch ($exception->getIssue()) {
      case ContainerArgumentTypeException::ISSUE_NO_TYPE:
        return "Argument has no type: $identifier";
      case ContainerArgumentTypeException::ISSUE_NON_NAMED_TYPE:
        return "Argument type is too complex (avoid using unions | and intersections &): $identifier";
      case ContainerArgumentTypeException::ISSUE_PRIMITIVE_TYPE:
        return "Cannot resolve primitive arguments (use Container::set): $identifier";
    }
  }
}

class PrimitiveTypes
{

  /**
   * @param string $type Name of type (eg., App, string, bool, MyProject\Service)
   */
  public static function isPrimitive(string $type)
  {
    $primitiveTypes = ['int', 'float', 'string', 'bool', 'array', 'object'];
    return in_array($type, $primitiveTypes);
  }
}

class Container
{
  private array $resolvers = [];

  public function get(string $id)
  {
    if (!$this->has($id)) {
      return $this->resolve($id);
      // throw new RuntimeException("Class $id could not be resolved");
    }
    $resolve = $this->resolvers[$id];

    return $resolve($this);
  }

  private function resolve(string $id)
  {
    $refClass = new ReflectionClass($id); // https://www.php.net/manual/en/class.reflectionclass.php
    $refArguments = $this->getConstructorArguments($refClass);

    $dependencies = [];

    foreach ($refArguments as $refArgument) {
      try {
        $dependencies[] = $this->getFromReflectionArgument($refArgument);
      } catch (ContainerArgumentTypeException $e) {
        throw new RuntimeException(ContainerArgumentTypeException::messageForClass($id, $e));
      }
    }

    return $refClass->newInstanceArgs($dependencies);
  }

  /**
   * @return ReflectionParameter[]
   */
  private function getConstructorArguments(ReflectionClass $refClass): array
  {
    $refConstructor = $refClass->getConstructor();

    if (!$refConstructor)
      return []; // No arguments

    return $refConstructor->getParameters();
  }

  private function getFromReflectionArgument(ReflectionParameter $refArgument)
  {
    if (!$refArgument->hasType())
      throw new ContainerArgumentTypeException($refArgument->getName(), ContainerArgumentTypeException::ISSUE_NO_TYPE);

    // todo: check if not primitive var
    $refType = $refArgument->getType();

    if (!($refType instanceof ReflectionNamedType))
      throw new ContainerArgumentTypeException($refArgument->getName(), ContainerArgumentTypeException::ISSUE_NON_NAMED_TYPE);

    if (PrimitiveTypes::isPrimitive($refType->getName()))
      throw new ContainerArgumentTypeException($refArgument->getName(), ContainerArgumentTypeException::ISSUE_PRIMITIVE_TYPE);

    $className = $refType->getName();
    return $this->get($className);
  }

  public function has(string $id): bool
  {
    return isset($this->resolvers[$id]);
  }

  public function set(string $id, callable $callable): void
  {
    $this->resolvers[$id] = $callable;
  }
}
