<?php

namespace App;

use Faker\Provider\File;
use Illuminate\Filesystem\Filesystem;

class Report
{
    /** @var Filesystem */
    protected $file;

    public function __construct(Filesystem $file)
    {
        $this->file = $file;
    }

    /**
     * @return int
     */
    public function output()
    {
        return $this->file->put('report.txt', 'report');
    }
}