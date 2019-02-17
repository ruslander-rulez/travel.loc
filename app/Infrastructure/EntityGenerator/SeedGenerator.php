<?php
namespace App\Infrastructure\EntityGenerator;

class SeedGenerator
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
     * CrudGenerator constructor.
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

    /**
     * make CRUD files
     */
    public function make()
    {
        $entityName = $this->nameResolver->entityName();

        $this->fileWriter->makeFile(
            base_path() . '/database/seeds/' . $entityName . 'TableSeeder.php',
            resource_path() . '/generator-templates/seed/EntityTableSeeder'
        );

        $this->fileWriter->appendFile(
            base_path() . '/database/seeds/DatabaseSeeder.php',
            resource_path() . '/generator-templates/seed/DatabaseSeeder'
        );
    }
}
