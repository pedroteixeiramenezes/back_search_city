<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','grupos_id'];

    public function grupo(){
        return $this->belongsTo('App\Models\Grupo','grupos_id');
    }
}