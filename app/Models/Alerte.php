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
 * @property int|null $id_incident
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
		'id_incident' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'date',
		'id_incident',
        'id_contact_urgence',
        'date_envoie'
	];

	public function Incident()
	{
		return $this->belongsTo(Incident::class, 'id_incident');
	}

    public function Contact_urgence()
	{
		return $this->belongsTo(ServiceUrgence::class, 'id_contact_urgence');
	}

    // public function ServiceUrgences(){
    //     return $this->belongsToMany(ServiceUrgence::class,'alerte_urgences');
    // }

    public function Alerte_urgence()
	{
		return $this->hasMany(AlerteUrgence::class, 'id_alerte');
	}

}
