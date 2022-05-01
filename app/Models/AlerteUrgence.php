<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlerteUrgence extends Model
{
    use HasFactory;

	public $timestamps = false;


    public function Alertes()
	{
		return $this->belongsTo(Alerte::class, 'id_alerte');
	}

	public function Contact_urgence()
	{
		return $this->belongsTo(ServiceUrgence::class, 'id_contact_urgence');
	}

}
