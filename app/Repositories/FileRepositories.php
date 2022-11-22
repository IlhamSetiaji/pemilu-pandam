<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

class FileRepositories
{

    public function storeFile($file, $folder)
    {
        $path = $file->store('public/' . $folder);
        $realPath = str_replace('public/', '', $path);
        return $realPath;
    }

    public function unlink($oldFile)
    {
        if (Storage::exists($oldFile)) {
            Storage::delete($oldFile);
        }
    }

    public function updateFile($newFile, $oldFile, $folder)
    {
        $this->unlink($oldFile);
        $store = $this->storeFile($newFile, $folder);
        return $store;
    }
}
