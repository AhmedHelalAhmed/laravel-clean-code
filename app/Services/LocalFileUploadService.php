<?php

namespace App\Services;

/*
 *
 * name is clear
 * do not use it to call api  google storage or Amazon
 * do not name if FileService => what it make I must open the file to know => bad
 *
 */

use Illuminate\Http\UploadedFile;

class LocalFileUploadService
{

    private $file, $file_name;


    public function __construct(UploadedFile $file)
    {

        $this->file = $file;
    }

    public function save($path)
    {

        $this->file->storeAs($path, $this->generateFileName());

        return $this;
        // to enable chaining
        // save()->getFileName()
    }

    protected function generateFileName()
    {

        return $this->file_name = $this->file->hashName();
    }

    public function getFileName()
    {

        return $this->file_name;
    }

}