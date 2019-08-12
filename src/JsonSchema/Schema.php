<?php

namespace BenArgo\JsonSchema;

use BenArgo\JsonSchema\SchemaInterface;
use Illumimate\Contracts\Filesystem\Filesystem;

abstract class Schema implements SchemaInterface
{
    protected $schema;

    abstract protected function defineSchema();

    public function get()
    {
        if (empty($this->schema)) {
            $this->schema = $this->defineSchema();
        }

        return $this->schema;
    }

    public function decode()
    {
        return json_decode($this->get());
    }

    public function loadFromStorage($path, Filesystem $filesystem)
    {
        $this->schema = $filesystem->get($path)

        return $this;
    }
}
