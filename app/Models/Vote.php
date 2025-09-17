<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
     protected $fillable = [
         'voix','candidat_id','ip_adresse'
    ];

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }


}
