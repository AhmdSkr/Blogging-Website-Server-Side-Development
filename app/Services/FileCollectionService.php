<?php

namespace App\Services;

interface FileCollectionService
{
    public function upload($file, $filenamePrefix = ""): string|bool;
    public function remove($url): bool;
}