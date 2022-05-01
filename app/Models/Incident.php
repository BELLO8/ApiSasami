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
		'id_assigner' => 'int'
	];

	protected $dates = [
		'date_declenchement'
	];

	protected $fillable = [
		'libincident',
		'id_assigner',
		'date_declenchement'
	];

	public function Assigner()
	{
		return $this->belongsTo(Assigner::class, 'id_assigner');
	}

	public function alertes()
	{
		return $this->hasMany(Alerte::class, 'id_incident');
	}

}
