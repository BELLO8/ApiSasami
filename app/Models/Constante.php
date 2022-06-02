<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BroadcastsEvents;

/**
 * Class Constante
 *
 * @property int $id
 * @property float|null $temperature
 * @property float|null $nombre_pas
 * @property float|null $frequence_res
 * @property float|null $rythme_card
 * @property Carbon|null $date
 * @property int|null $id_assigner
 *
 * @property Assigner|null $assigner
 *
 * @package App\Models
 */
class Constante extends Model
{
    use BroadcastsEvents;

	protected $table = 'constante';
	public $timestamps = false;

	protected $casts = [
		'temperature' => 'float',
		'nombre_pas' => 'float',
		'frequence_res' => 'float',
		'rythme_card' => 'float',
		'id_assigner' => 'int'
	];

	protected $dates = [
		'dates'
	];

	protected $fillable = [
		'temperature',
		'nombre_pas',
		'frequence_res',
		'rythme_card',
        'position',
		'date',
		'id_assigner'
	];

	public function assigner()
	{
		return $this->belongsTo(Assigner::class, 'id_assigner');
	}

    // public function broadcastOn($event)
    // {
    //     return [$this, $this->assigner];
    // }
}
