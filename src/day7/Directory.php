<?php

namespace AOC2022\day7;

class Directory
{
    private string $name;
    private ?Directory $parent;
    /** @var array<int,File> */
    private array $files;
    /** @var array<int,Directory> */
    private array $directories;
    private int $size;

    /**
     * @param array<int,Directory> $directories
     * @param array<int,File> $files
     */
    public function __construct(
        string $name,
        ?Directory $parent = null,
        array $files = [],
        array $directories = [],
        int $size = 0
    ) {
        $this->name = $name;
        $this->parent = $parent;
        $this->files = $files;
        $this->directories = $directories;
        $this->size = $size;
    }

    public function addDirectory(Directory $directory): void
    {
        $directory->parent = $this;
        $this->directories[] = $directory;
    }

    public function setParent(Directory $directory): void
    {
        $this->parent = $directory;
    }

    /**
    * @return array<int,File>
    */
    public function getFiles(): array
    {
        return $this->files;
    }

   /**
   * @return array<int,Directory>
   */
    public function getDirectories(): array
    {
        return $this->directories;
    }

    public function addFile(File $file): void
    {
        $this->files[] = $file;
        $this->size += $file->size;
    }

    public function getTotalSize(): int
    {
        $size = $this->size;

        foreach ($this->directories as $dir) {
            $size += $dir->getTotalSize();
        }

        return $size;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParent(): ?Directory
    {
        return $this->parent;
    }
}
