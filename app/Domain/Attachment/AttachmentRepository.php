<?php
namespace App\Domain\Attachment;

use Illuminate\Database\Eloquent\Model;

interface AttachmentRepository
{

    /**
     * @param int $id
     *
     * @return Attachment|null
     */
    public function byId($id);

    /**
     * @param Model $attachment
     */
    public function store(Model $attachment);

    /**
     * @param Model $attachment
     */
    public function delete(Model $attachment);
}