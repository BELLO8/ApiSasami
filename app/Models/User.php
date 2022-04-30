<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class User
 *
 * @property int $id
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $adresse
 * @property string|null $telephone
 * @property int $age
 * @property string|null $password
 *
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
        'nom',
        'prenom',
        'adresse',
        'telephone',
        'age',
        'password',
    ];
}
