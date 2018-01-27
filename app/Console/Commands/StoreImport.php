<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\StoreController;

class StoreImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:import {path : путь к файлу}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт из файла';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path=$this->argument('path');
        if (file_exists($path)){
            $controller=new StoreController();
            $handle=fopen($path,"r");
            $i=0;
            $j=0;
            $k=0;
            while(!feof($handle)){
                $store=fgetcsv($handle);
                if ($controller->save($store))
                {
                    $this->line('Success');
                    $i++;
                } else {
                    $this->error('Error');
                    $j++;
                }
                $k++;
            }
            $message='Parsed '.$k.' strings, '.$j.' errors.';
            $this->info($message);
        }
    }
}
