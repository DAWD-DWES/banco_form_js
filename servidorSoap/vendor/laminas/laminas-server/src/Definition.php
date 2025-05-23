<?php

/**
 * @see       https://github.com/laminas/laminas-server for the canonical source repository
 */

namespace Laminas\Server;

use Countable;
use Iterator;
use Laminas\Server\Exception\InvalidArgumentException;
use ReturnTypeWillChange;

use function array_key_exists;
use function count;
use function current;
use function is_array;
use function is_numeric;
use function key;
use function next;
use function reset;
use function sprintf;

/**
 * Server methods metadata
 */
class Definition implements Countable, Iterator
{
    /** @var array Array of \Laminas\Server\Method\Definition objects */
    protected $methods = [];

    /** @var bool Whether or not overwriting existing methods is allowed */
    protected $overwriteExistingMethods = false;

    /**
     * Constructor
     *
     * @param  null|array $methods
     */
    public function __construct($methods = null)
    {
        if (is_array($methods)) {
            $this->setMethods($methods);
        }
    }

    /**
     * Set flag indicating whether or not overwriting existing methods is allowed
     *
     * @param mixed $flag
     * @return Definition
     */
    public function setOverwriteExistingMethods($flag)
    {
        $this->overwriteExistingMethods = (bool) $flag;
        return $this;
    }

    /**
     * Add method to definition
     *
     * @param  array|\Laminas\Server\Method\Definition $method
     * @param  null|string $name
     * @return Definition
     * @throws InvalidArgumentException If duplicate or invalid method provided.
     */
    public function addMethod($method, $name = null)
    {
        if (is_array($method)) {
            $method = new Method\Definition($method);
        } elseif (! $method instanceof Method\Definition) {
            throw new InvalidArgumentException('Invalid method provided');
        }

        if (is_numeric($name)) {
            $name = null;
        }
        if (null !== $name) {
            $method->setName($name);
        } else {
            $name = $method->getName();
        }
        if (null === $name) {
            throw new InvalidArgumentException('No method name provided');
        }

        if (! $this->overwriteExistingMethods && array_key_exists($name, $this->methods)) {
            throw new InvalidArgumentException(sprintf('Method by name of "%s" already exists', $name));
        }
        $this->methods[$name] = $method;
        return $this;
    }

    /**
     * Add multiple methods
     *
     * @param  array $methods Array of \Laminas\Server\Method\Definition objects or arrays
     * @return Definition
     */
    public function addMethods(array $methods)
    {
        foreach ($methods as $key => $method) {
            $this->addMethod($method, $key);
        }
        return $this;
    }

    /**
     * Set all methods at once (overwrite)
     *
     * @param  array $methods Array of \Laminas\Server\Method\Definition objects or arrays
     * @return Definition
     */
    public function setMethods(array $methods)
    {
        $this->clearMethods();
        $this->addMethods($methods);
        return $this;
    }

    /**
     * Does the definition have the given method?
     *
     * @param  string $method
     * @return bool
     */
    public function hasMethod($method)
    {
        return array_key_exists($method, $this->methods);
    }

    /**
     * Get a given method definition
     *
     * @param  string $method
     * @return null|false|\Laminas\Server\Method\Definition
     */
    public function getMethod($method)
    {
        if ($this->hasMethod($method)) {
            return $this->methods[$method];
        }
        return false;
    }

    /**
     * Get all method definitions
     *
     * @return array Array of \Laminas\Server\Method\Definition objects
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * Remove a method definition
     *
     * @param  string $method
     * @return Definition
     */
    public function removeMethod($method)
    {
        if ($this->hasMethod($method)) {
            unset($this->methods[$method]);
        }
        return $this;
    }

    /**
     * Clear all method definitions
     *
     * @return Definition
     */
    public function clearMethods()
    {
        $this->methods = [];
        return $this;
    }

    /**
     * Cast definition to an array
     *
     * @return array
     */
    public function toArray()
    {
        $methods = [];
        foreach ($this->getMethods() as $key => $method) {
            $methods[$key] = $method->toArray();
        }

        return $methods;
    }

    /**
     * Countable: count of methods
     *
     * @return int
     */
    #[ReturnTypeWillChange]
    public function count()
    {
        return count($this->methods);
    }

    /**
     * Iterator: current item
     *
     * @return Method\Definition
     */
    #[ReturnTypeWillChange]
    public function current()
    {
        return current($this->methods);
    }

    /**
     * Iterator: current item key
     *
     * @return int|string
     */
    #[ReturnTypeWillChange]
    public function key()
    {
        return key($this->methods);
    }

    /**
     * Iterator: advance to next method
     *
     * @return Method\Definition
     */
    #[ReturnTypeWillChange]
    public function next()
    {
        return next($this->methods);
    }

    /**
     * Iterator: return to first method
     *
     * @return void
     */
    #[ReturnTypeWillChange]
    public function rewind()
    {
        reset($this->methods);
    }

    /**
     * Iterator: is the current index valid?
     *
     * @return bool
     */
    #[ReturnTypeWillChange]
    public function valid()
    {
        return (bool) $this->current();
    }
}
