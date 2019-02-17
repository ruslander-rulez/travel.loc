<?php
namespace App\Console\Commands;

use App\Infrastructure\EntityGenerator\ApiGenerator;
use App\Infrastructure\EntityGenerator\CrudGenerator;
use App\Infrastructure\EntityGenerator\EntityGenerator;
use App\Infrastructure\EntityGenerator\FileWriter;
use App\Infrastructure\EntityGenerator\NameResolver;
use App\Infrastructure\EntityGenerator\SeedGenerator;
use App\Infrastructure\EntityGenerator\TestGenerator;
use App\Infrastructure\EntityGenerator\TranslationGenerator;
use Illuminate\Console\Command;

class MakeEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:entity 
            {name : Entity name}
            {--tr : with translation} 
            {--crud : with CRUD} 
            {--api : with API}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes all entity files';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $nameResolver = new NameResolver($this->argument('name'));
        $fileWriter = new FileWriter($nameResolver);

        $entityGenerator = new EntityGenerator($nameResolver, $fileWriter);
        $entityGenerator->make();

        $seedGenerator = new SeedGenerator($nameResolver, $fileWriter);
        $seedGenerator->make();

        if ($this->option('crud')) {
            $crudGenerator = new CrudGenerator($nameResolver, $fileWriter);
            $crudGenerator->make();
        }
/*
        if ($this->option('api')) {
            $apiGenerator = new ApiGenerator($nameResolver, $fileWriter);
            $apiGenerator->make();

            $testGenerator = new TestGenerator($nameResolver, $fileWriter);
            $testGenerator->make();
        }*/
    }
}
