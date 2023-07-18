<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $casts = [
        'items'=>'array'   //Especificar o dado para armazenar no banco,se não ira ser salvo como string
        
    ];
    protected $dates = ['date']; //Especificando o tipo da dado para armazenar no banco

    protected $guarded = []; //Autoriza atualizacao dos dados

    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
