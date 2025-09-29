<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
         protected $fillable = ['nom', 'badge_color','show'];

    public function candidates()
    {
        return $this->hasMany(Candidat::class);
    }

}
