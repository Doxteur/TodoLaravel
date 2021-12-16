<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    use HasFactory;
    protected $primaryKey = 'ID';
    public $incrementing = true;
    protected $fillable = ['texte', 'termine', 'themes','important'];
    public $timestamps = false;
}
