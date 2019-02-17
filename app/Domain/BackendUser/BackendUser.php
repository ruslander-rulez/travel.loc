<?php
namespace App\Domain\BackendUser;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $login
 * @property string $password
 */
class BackendUser extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = "backend_user";
}