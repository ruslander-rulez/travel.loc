<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Attachment\Attachment;
use App\Domain\Attachment\AttachmentRepository;

class AttachmentRepositoryEloquent implements AttachmentRepository
{
    use Helper;

    /**
     * @var Attachment
     */
    private $model;

    public function __construct(Attachment $model)
    {
        $this->model = $model;
    }
}