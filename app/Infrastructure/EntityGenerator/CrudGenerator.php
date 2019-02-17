<?php
namespace App\Infrastructure\EntityGenerator;

use Illuminate\Support\Facades\File;

class CrudGenerator
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

/*        //make commands
        if (!file_exists(app_path() . '/Application/' . $entityName)) {
            File::makeDirectory(app_path() . '/Application/' . $entityName, 0777, true, true);
        }

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Register' . $entityName . '.php',
            resource_path() . '/generator-templates/crud/Commands/RegisterEntity'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Register' . $entityName . 'Handler.php',
            resource_path() . '/generator-templates/crud/Commands/RegisterEntityHandler'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Get' . $entityName . 'ById.php',
            resource_path() . '/generator-templates/crud/Commands/GetEntityById'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Get' . $entityName . 'ByIdHandler.php',
            resource_path() . '/generator-templates/crud/Commands/GetEntityByIdHandler'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Get' . $entityName . 'List.php',
            resource_path() . '/generator-templates/crud/Commands/GetEntityList'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Get' . $entityName . 'ListHandler.php',
            resource_path() . '/generator-templates/crud/Commands/GetEntityListHandler'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Update' . $entityName . '.php',
            resource_path() . '/generator-templates/crud/Commands/UpdateEntity'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Update' . $entityName . 'Handler.php',
            resource_path() . '/generator-templates/crud/Commands/UpdateEntityHandler'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Delete' . $entityName . '.php',
            resource_path() . '/generator-templates/crud/Commands/DeleteEntity'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Application/' . $entityName . '/Delete' . $entityName . 'Handler.php',
            resource_path() . '/generator-templates/crud/Commands/DeleteEntityHandler'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Http/Requests/Create' . $entityName . 'Request.php',
            resource_path() . '/generator-templates/crud/Requests/CreateEntityRequest'
        );

        $this->fileWriter->makeFile(
            app_path() . '/Http/Requests/Update' . $entityName . 'Request.php',
            resource_path() . '/generator-templates/crud/Requests/UpdateEntityRequest'
        );
*/
        $viewFolderName = $this->nameResolver->viewFolderName();

        //make view
        if (!file_exists(base_path() . '/resources/views/dashboard/' . $viewFolderName)) {
            File::makeDirectory(base_path() . '/resources/views/dashboard/' . $viewFolderName, 0777, true, true);
        }

        $this->fileWriter->makeFile(
            base_path() . '/resources/views/dashboard/' . $viewFolderName . '/index.blade.php',
            resource_path() . '/generator-templates/crud/view/index'
        );

        if (!file_exists(base_path() . '/resources/assets/js/components/' . $viewFolderName)) {
            File::makeDirectory(base_path() . '/resources/assets/js/components/' . $viewFolderName, 0777, true, true);
        }

        $this->fileWriter->makeFile(
            base_path() . '/resources/assets/js/components/' . $viewFolderName . '/app.js',
            resource_path() . '/generator-templates/crud/components/app'
        );

        $this->fileWriter->makeFile(
            base_path() . '/resources/assets/js/components/' . $viewFolderName . '/Table.vue',
            resource_path() . '/generator-templates/crud/components/Table'
        );

  /*      $this->fileWriter->makeFile(
            base_path() . '/resources/views/dashboard/' . $viewFolderName . '/edit.blade.php',
            resource_path() . '/generator-templates/crud/view/edit.blade'
        );

        //make controller
        $this->fileWriter->makeFile(
            app_path() . '/Http/Controllers/Dashboard/' . $entityName . 'Controller.php',
            resource_path() . '/generator-templates/crud/Controller/EntityController'
        );


        //make routes
        $this->fileWriter->appendFile(
            base_path() . '/routes/dashboard.php',
            resource_path() . '/generator-templates/crud/routes/dashboard'
        );*/
    }
}
