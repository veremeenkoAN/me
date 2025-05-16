<?php

namespace App\DIContainer;

use Closure;
use Exception;

class DIContainer
{

    private array $dependency = [];

    public function set(string $class,Closure $closure): void
    {
        $this->dependency[$class] = $closure;
    }

    public function get(string $class)
    {
        if (!isset($this->dependency[$class])) {
            throw new Exception($class);
        }
        return $this->dependency[$class]($this);
    }

}