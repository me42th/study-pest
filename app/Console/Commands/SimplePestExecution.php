<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SimplePestExecution extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pest:exec {--type=} {--file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to help execution of pest';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->option('file');
        $type = $this->option('type');
        if($file xor $type){
            $this->error("Caso mande file, é obrigatorio mandar type e vice versa");
            die;
        }
        if($file){
            $file = "./tests/$type/$file.php";
        }
        echo system("./vendor/bin/pest $file");
    }
}
