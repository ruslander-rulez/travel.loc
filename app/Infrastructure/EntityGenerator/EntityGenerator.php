<?php
namespace App\Infrastructure\EntityGenerator;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class EntityGenerator
{
    /**
     * @var NameResolver
     */
    private $nameResolver;
    /**
     * @var FileWriter
     */
    private $fileWriter;

    /**
     * Entity constructor.
     * @param NameResolver $nameResolver
     * @param FileWriter $fileWriter
     */
    public function __construct(
        NameResolver $nameResolver,
        FileWriter $fileWriter
    ) {

        $this->nameResolver = $nameResolver;
        $this->fileWriter = $fileWriter;
    }

    public function make()
    {
        //make migration
        $exitCode = Artisan::call('make:migration', [
            'name' => 'create_table_' . $this->nameResolver->tableName(),
            '--create' => $this->nameResolver->tableName()
        ]);

        //make domain files + mapping
        if (!file_exists(app_path() . '/Domain/' . $this->nameResolver->entityName())) {
            File::makeDirectory(app_path() . '/Domain/' . $this->nameResolver->entityName(), 0777, true, true);
        }

        $entityName = $this->nameResolver->entityName();

        $this->fileWriter->makeFile(
            app_path() . '/Domain/' . $entityName . '/' . $entityName . '.php',
            resource_path() . '/generator-templates/entity/Domain/Entity'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Domain/' . $entityName . '/' . $entityName . 'Filter.php',
            resource_path() . '/generator-templates/entity/Domain/EntityFilter'
        );
/*
        $this->fileWriter->makeFile(
            app_path() . '/Domain/' . $entityName . '/' . $entityName . 'NotFound.php',
            resource_path() . '/generator-templates/entity/Domain/EntityNotFound'
        );*/

        $this->fileWriter->makeFile(
            app_path() . '/Domain/' . $entityName . '/' . $entityName . 'Repository.php',
            resource_path() . '/generator-templates/entity/Domain/EntityRepository'
        );

        //make infrastructure
        $this->fileWriter->makeFile(
            app_path() . '/Infrastructure/Eloquent/' . $entityName . 'RepositoryEloquent.php',
            resource_path() . '/generator-templates/entity/Infrastructure/Eloquent/EntityRepositoryEloquent'
        );

        //DomainServiceProvider
        $this->fileWriter->appendFile(
            app_path() . '/Providers/DomainServiceProvider.php',
            resource_path() . '/generator-templates/entity/DomainServiceProvider'
        );
    }
}
