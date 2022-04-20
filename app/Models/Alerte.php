<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Alerte
 *
 * @property int $id
 * @property Carbon|null $date
 * @property int|null $incident
 *
 * @property Collection|ServiceUrgence[] $service_urgences
 *
 * @package App\Models
 */
class Alerte extends Model
{
	protected $table = 'alerte';
	public $timestamps = false;

	protected $casts = [
		'incident' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'date',
		'incident'
	];

	public function Incident()
	{
		return $this->belongsTo(Incident::class, 'incident');
	}

	public function service_urgences()
	{
		return $this->hasMany(ServiceUrgence::class, 'alerte');
	}
}
