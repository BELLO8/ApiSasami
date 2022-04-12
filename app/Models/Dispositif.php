<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dispositif
 * 
 * @property int $id
 * @property string|null $ref
 * @property string|null $fiche
 * @property string|null $numero
 * @property Carbon|null $date
 * 
 * @property Collection|Assigner[] $assigners
 * @property Collection|Incident[] $incidents
 *
 * @package App\Models
 */
class Dispositif extends Model
{
	protected $table = 'dispositif';
	public $timestamps = false;

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'ref',
		'fiche',
		'numero',
		'date'
	];

	public function assigners()
	{
		return $this->hasMany(Assigner::class, 'id_dispositif');
	}

	public function incidents()
	{
		return $this->hasMany(Incident::class, 'id_dispositif');
	}
}
