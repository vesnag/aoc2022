<?php

namespace AOC2022\day7;

use AOC2022\day7\Directory;
use AOC2022\day7\File;

final class Day7Part1
{
    public function calculateSumOfTotalSizesBelowThreshold(string $filename): int
    {
        $inputFileHandle = fopen('input/day7/' . $filename, 'r');
        if (!$inputFileHandle) {
            return 0;
        }

        $totalSizeThreshold = 100000;
        $rootDirectory = new Directory('/');
        $currentDirectory = $rootDirectory;

        while (($line = fgets($inputFileHandle)) !== false) {
            $this->buildFilesystem(trim($line), $rootDirectory, $currentDirectory);
        }

        return self::sumSizeOfDirectoriesBelowThresholdSize($rootDirectory, $totalSizeThreshold);
    }

    private function buildFilesystem(string $inputLine, Directory $rootDirectory, Directory &$currentDirectory): void
    {
        if (preg_match('/^\$ (cd|ls)(.*)/', $inputLine, $regexMatches)) {
            $command = $regexMatches[1];
            $arguments = trim($regexMatches[2]);

            if ('cd' === $command) {
                $currentDirectory = self::changeDirectory($arguments, $currentDirectory, $rootDirectory);
                return;
            }

            if ('ls' === $command) {
                return;
            }
        }

        if (preg_match('/^dir (.*)/', $inputLine, $regexMatches)) {
            $directoryName = $regexMatches[1];
            self::createDirectory($directoryName, $currentDirectory);
            return;
        }

        if (preg_match('/^(\d+) (.*)/', $inputLine, $regexMatches)) {
            $fileSize = (int) $regexMatches[1];
            $fileName = $regexMatches[2];
            $file = new File($fileName, $fileSize);
            $currentDirectory->addFile($file);
        }
    }

    private static function changeDirectory(string $directoryName, Directory $currentDirectory, Directory $rootDirectory): ?Directory
    {
        if ('/' === $directoryName) {
            return $rootDirectory;
        }

        if ('..' === $directoryName) {
            return $currentDirectory->getParent();
        }

        foreach ($currentDirectory->getDirectories() as $directory) {
            if ($directory->getName() === $directoryName) {
                return $directory;
            }
        }

        return null;
    }

    private static function sumSizeOfDirectoriesBelowThresholdSize(Directory $directory, int $totalSizeThreshold): int
    {
        $totalSize = 0;

        if ($directory->getTotalSize() <= $totalSizeThreshold) {
            $totalSize += $directory->getTotalSize();
        }

        foreach ($directory->getDirectories() as $subDirectory) {
            $totalSize += self::sumSizeOfDirectoriesBelowThresholdSize($subDirectory, $totalSizeThreshold);
        }

        return $totalSize;
    }

    private static function createDirectory(string $directoryName, Directory $currentDirectory): void
    {
        /** @var array<int, Directory> $dir */
        $dir = $currentDirectory->getDirectories();
        if (!in_array($directoryName, $dir)) {
            $newDirectory = new Directory($directoryName);
            $newDirectory->setParent($currentDirectory);
            $currentDirectory->addDirectory($newDirectory);
        }
    }
}
