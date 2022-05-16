<?php
namespace App\Http\Controllers\Helpers;
use App\Models\PersonneVulnerable;

class Fonction{

    public function getVulnerable(int $value){

    $id_vulnerable = 0;
    $vulnerable = PersonneVulnerable::get()->where("telephone","=",$value);

    foreach ($vulnerable as $vul)
    {
        $id_vulnerable = $vul->id;
    }
    return $id_vulnerable;
    dd($id_vulnerable);
    }
}
