<?php
namespace App\Infrastructure\EntityGenerator;

class FileWriter
{
    /**
     * @var NameResolver
     */
    private $nameResolver;

    /**
     * FileWriter constructor.
     * @param NameResolver $nameResolver
     */
    public function __construct(NameResolver $nameResolver)
    {
        $this->nameResolver = $nameResolver;
    }

    /**
     * @param $destinationFilePath
     * @param $resourceFilePath
     */
    public function makeFile($destinationFilePath, $resourceFilePath)
    {
        $destinationFile = fopen($destinationFilePath, "w");
        $content = file_get_contents($resourceFilePath);
        //1 - entityName
        //2 - variableName
        //3 - viewFolderName
        //4 - titleName
        //5 - tableName
        fwrite(
            $destinationFile,
            sprintf(
                $content,
                $this->nameResolver->entityName(),
                $this->nameResolver->variableName(),
                $this->nameResolver->viewFolderName(),
                $this->nameResolver->titleName(),
                $this->nameResolver->tableName()
            )
        );
        fclose($destinationFile);
    }

    /**
     * @param $destinationFilePath
     * @param $resourceFilePath
     */
    public function appendFile($destinationFilePath, $resourceFilePath)
    {
        $content = file_get_contents($resourceFilePath);
        file_put_contents(
            $destinationFilePath,
            sprintf(
                $content,
                $this->nameResolver->entityName(),
                $this->nameResolver->variableName(),
                $this->nameResolver->viewFolderName(),
                $this->nameResolver->titleName(),
                $this->nameResolver->tableName()
            ),
            FILE_APPEND
        );
    }
}
