<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profiling
 * 
 * @property int $id
 * @property float|null $temperatureM
 * @property float|null $nombre_pasM
 * @property float|null $frequence_resM
 * @property float|null $rythme_cardM
 * @property Carbon|null $dates
 * @property int|null $id_assigner
 * 
 * @property Assigner|null $assigner
 *
 * @package App\Models
 */
class Profiling extends Model
{
	protected $table = 'profiling';
	public $timestamps = false;

	protected $casts = [
		'temperatureM' => 'float',
		'nombre_pasM' => 'float',
		'frequence_resM' => 'float',
		'rythme_cardM' => 'float',
		'id_assigner' => 'int'
	];

	protected $dates = [
		'dates'
	];

	protected $fillable = [
		'temperatureM',
		'nombre_pasM',
		'frequence_resM',
		'rythme_cardM',
		'dates',
		'id_assigner'
	];

	public function assigner()
	{
		return $this->belongsTo(Assigner::class, 'id_assigner');
	}
}
