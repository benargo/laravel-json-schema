<?php

namespace BenArgo\JsonSchema;

use JsonSchema\Validator;
use Illumimate\Contracts\Filesystem\Filesystem;

interface SchemaInterface
{
    public function get();

    public function decode();

    public function loadFromStorage(Filesystem $filesystem);
}
