<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class Dispositif extends Model
{
	protected $table = 'dispositif';
	public $timestamps = false;

	protected $dates = [
		'date'
	];

	protected $fillable = [
        'reference',
        'details',
        'telephone',
        'Adresse_ip',
        'status',
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
