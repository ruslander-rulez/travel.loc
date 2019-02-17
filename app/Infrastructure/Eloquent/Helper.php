<?php

namespace App\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Model;

trait Helper
{
    /**
     * @var Model
     */
    private $model;

    /**
     * @param Model $entity
     */
    public function store(Model $entity)
    {
        $entity->save();
    }

    /**
     * @param Model $entity
     * @throws \Exception
     */
    public function delete(Model $entity)
    {
        $entity->delete();
    }

    /**
     * @param int $id
     *
     * @return Model|null
     */
    public function byId($id)
    {
        return $this->model->where("id", $id)->first();
    }
}