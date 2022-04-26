<?php

/**
 * Created by Reliese Model
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Surveiller
 *
 * @property int $id
 * @property int|null $personne_vulnerable
 * @property int|null $personne_Affilee
 *
 * @property PersonneAffilee|null $personne_affilee
 *
 * @package App\Models
 */
class Surveiller extends Model
{
	protected $table = 'surveiller';
	public $timestamps = false;

	protected $casts = [
		'personne_vulnerable' => 'int',
		'personne_Affilee' => 'int'
	];

	protected $fillable = [
		'personne_vulnerable',
		'personne_Affilee'
	];

	public function Personne_affilee()
	{
		return $this->belongsTo(PersonneAffilee::class, 'personne_Affilee');
	}

	public function Personne_vulnerable()
	{
		return $this->belongsTo(PersonneVulnerable::class, 'personne_vulnerable');
	}
}
