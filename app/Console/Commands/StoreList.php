<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\StoreController;

class StoreList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:list {id=0 :ID магазина для вывода}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Вывод списка магазинов';

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
        $id=$this->argument('id');
        $controller=new StoreController();
        $list=$controller->get($id);
        $headers=['ID','TITLE','REGION ID','CITY','ADDRESS','USER ID'];
        $this->table($headers, $list);
    }
}
