<?php

namespace AOC2022\day7;

use AOC2022\day7\Directory;
use AOC2022\day7\File;

final class Day7Part1
{
    public function getSumOfTotalSize(string $filename): int
    {
        $handle = fopen('input/day7/' . $filename, 'r');
        if (!$handle) {
            return 0;
        }

        $sizeThreshold = 100000;
        $rootDir = new Directory('/');
        $currentDir = $rootDir;

        while (($line = fgets($handle)) !== false) {
            $this->buildFilesystem(trim($line), $rootDir, $currentDir);
        }

        return $this->sumSizeOfDirectoriesBelowThresholdSize($rootDir, $sizeThreshold);
    }

    private function buildFilesystem(string $terminalOutput, Directory $rootDir, Directory &$currentDir): void
    {
        if (str_contains($terminalOutput, 'cd')) {
            $dirName = trim(str_replace('$ cd ', '', $terminalOutput));
            $currentDir = $this->changeDirectory($dirName, $currentDir, $rootDir);
            return;
        }

        if (str_contains($terminalOutput, 'ls')) {
            return;
        }

        if (str_contains($terminalOutput, 'dir')) {
            $dirName = trim(str_replace('dir', '', $terminalOutput));
            $this->createDirectory($dirName, $currentDir);

            return;
        }

        /** @var int $size */
        /** @var string $name */
        list($size, $name) = explode(' ', $terminalOutput);
        $file = new File($name, $size);
        $currentDir->addFile($file);
    }

    private function changeDirectory(string $dirName, Directory $currentDir, Directory $root): ?Directory
    {
        if ('/' === $dirName) {
            return $root;
        }

        if ('..' === $dirName) {
            return $currentDir->getParent();
        }

        foreach ($currentDir->getDirectories() as $dir) {
            if ($dir->getName() === $dirName) {
                return $dir;
            }
        }

        return null;
    }

    private function sumSizeOfDirectoriesBelowThresholdSize(Directory $directory, int $sizeThreshold): int
    {
        $totalSize = 0;

        if ($directory->getTotalSize() <= $sizeThreshold) {
            $totalSize += $directory->getTotalSize();
        }

        foreach ($directory->getDirectories() as $subDir) {
            $totalSize += $this->sumSizeOfDirectoriesBelowThresholdSize($subDir, $sizeThreshold);
        }

        return $totalSize;
    }

    private function createDirectory(string $dirName, Directory $currentDir): void
    {
        /** @var array<int, Directory> $dir */
        $dir = $currentDir->getDirectories();
        if (!in_array($dirName, $dir)) {
            $newDir = new Directory($dirName);
            $newDir->setParent($currentDir);
            $currentDir->addDirectory($newDir);
        }
    }
}
