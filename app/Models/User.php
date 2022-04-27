<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $password
 *
 * @package App\Models
 */
class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'users';


	protected $hidden = [
        'password',
        'remember_token',
    ];

	protected $fillable = [
		'name',
		'email',
		'password',
	];
}
