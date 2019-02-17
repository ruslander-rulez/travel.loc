<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\BackendUser\BackendUser;
use App\Domain\BackendUser\BackendUserRepository;

class BackendUserRepositoryEloquent implements BackendUserRepository
{
    use Helper;
    /**
     * @var BackendUser
     */
    private $model;

    public function __construct(BackendUser $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $email
     *
     * @return BackendUser|null
     */
    public function byEmail($email)
    {
        return $this->model->where("email", $email)->first();
    }
}