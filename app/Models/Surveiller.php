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
    //public $incrementing = false;
	protected $casts = [
		'id_personne_vulnerable' => 'int',
		'id_personne_Affilee' => 'int'
	];

	protected $fillable = [
		'id_personne_vulnerable',
		'id_personne_Affilee'
	];

    //protected $primaryKey = ['id_personne_vulnerable','id_personne_Affilee'];

	public function Personne_affilee()
	{
		return $this->belongsTo(PersonneAffilee::class, 'id_personne_Affilee');
	}

	public function Personne_vulnerable()
	{
		return $this->belongsTo(PersonneVulnerable::class, 'id_personne_vulnerable');
	}
}
