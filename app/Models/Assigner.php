<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Assigner
 *
 * @property int $id
 * @property int|null $frequenceD
 * @property Carbon|null $dates
 * @property int|null $id_personneV
 * @property int|null $id_dispositif
 *
 * @property Dispositif|null $dispositif
 * @property profile|null $personne_vulnerable
 * @property Collection|Constante[] $constantes
 * @property Collection|Profiling[] $profilings
 *
 * @package App\Models
 */
class Assigner extends Model
{
	protected $table = 'assigner';
	public $timestamps = false;

	protected $casts = [
		'frequenceD' => 'int',
		'id_personneV' => 'int',
		'id_dispositif' => 'int'
	];

	protected $dates = [
		'dates'
	];

	protected $fillable = [
		'frequenceD',
		'dates',
		'id_personneV',
		'id_dispositif'
	];

	public function dispositif()
	{
		return $this->belongsTo(Dispositif::class, 'id_dispositif');
	}

	public function personne_vulnerable()
	{
		return $this->belongsTo(profile::class, 'id_personneV');
	}

	public function constantes()
	{
		return $this->hasMany(Constante::class, 'id_assigner');
	}

	public function profilings()
	{
		return $this->hasMany(Profiling::class, 'id_assigner');
	}
}
