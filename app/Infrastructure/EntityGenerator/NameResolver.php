<?php

namespace App\Infrastructure\EntityGenerator;

class NameResolver
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $entityName;

    /**
     * NameResolver constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->entityName = ucfirst($name);
    }

    /**
     * @return string[]|null
     */
    private function pieces()
    {
        $pieces = preg_split('/(?=[A-Z])/', $this->entityName);
        return array_filter($pieces, function ($value) {
            return $value !== '';
        });
    }

    /**
     * @return string
     */
    public function entityName()
    {
        return $this->entityName;
    }

    /**
     * @return string
     */
    public function tableName()
    {
        $pieces = $this->pieces();
        $pieces = array_map('strtolower', $pieces);
        return implode('_', $pieces);
    }

    /**
     * @return string
     */
    public function viewFolderName()
    {
        $pieces = $this->pieces();
        $pieces = array_map('strtolower', $pieces);
        return implode('-', $pieces);
    }

    /**
     * @return string
     */
    public function variableName()
    {
        $pieces = array_values($this->pieces());
        $pieces[0] = lcfirst($pieces[0]);
        return implode('', $pieces);
    }

    /**
     * @return string
     */
    public function titleName()
    {
        $pieces = $this->pieces();
        return implode(' ', $pieces);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'entityName' => $this->entityName,
            'tableName' => $this->tableName(),
            'viewFolderName' => $this->viewFolderName(),
            'variableName' => $this->variableName(),
            'titleName' => $this->titleName()
        ];
    }
}
