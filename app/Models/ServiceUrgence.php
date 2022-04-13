<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceUrgence
 *
 * @property int $id
 * @property string|null $nom
 * @property string|null $adresse
 * @property string|null $telephone
 * @property string|null $fixe
 * @property int|null $alerte
 *
 *
 * @package App\Models
 */
class ServiceUrgence extends Model
{
	protected $table = 'serviceUrgence';
	public $timestamps = false;

	protected $casts = [
		'alerte' => 'int'
	];

	protected $fillable = [
		'nom',
		'adresse',
		'telephone',
		'fixe',
		'alerte'
	];

	public function alerte()
	{
		return $this->belongsTo(Alerte::class, 'alerte');
	}
}
