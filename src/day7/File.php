<?php

namespace AOC2022\day7;

class File
{
    public function __construct(
        public readonly string $name,
        public readonly int $size
    ) {
    }
}
