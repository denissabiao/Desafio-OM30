<?php

namespace App\Jobs;

use App\Imports\PatientsImport;
use App\Models\Address;
use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessImportPatient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filePath;

    public function __construct($file_path)
    {
        $this->filePath = $file_path;
    }

    public function handle()
    {
        Excel::import(new PatientsImport, $this->filePath);
    }
}
