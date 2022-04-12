<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Incident
 * 
 * @property int $id
 * @property string|null $libincident
 * @property int $id_dispositif
 * @property Carbon|null $dates
 * 
 * @property Dispositif $dispositif
 * @property Collection|Alerte[] $alertes
 *
 * @package App\Models
 */
class Incident extends Model
{
	protected $table = 'incident';
	public $timestamps = false;

	protected $casts = [
		'id_dispositif' => 'int'
	];

	protected $dates = [
		'dates'
	];

	protected $fillable = [
		'libincident',
		'id_dispositif',
		'dates'
	];

	public function dispositif()
	{
		return $this->belongsTo(Dispositif::class, 'id_dispositif');
	}

	public function alertes()
	{
		return $this->hasMany(Alerte::class, 'incident');
	}
}
