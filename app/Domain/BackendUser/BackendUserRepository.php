<?php
namespace App\Domain\BackendUser;

use Illuminate\Database\Eloquent\Model;

interface BackendUserRepository
{
    /**
     * @param string $email
     *
     * @return BackendUser|null
     */
    public function byEmail($email);

    /**
     * @param int $id
     *
     * @return BackendUser|null
     */
    public function byId($id);

    /**
     * @param Model $admin
     */
    public function store(Model $admin);

    /**
     * @param Model $admin
     */
    public function delete(Model $admin);
}