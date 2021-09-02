<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'address'];
    //con Livewire ciò che serve del Model sono solo i campi fillable
    //$guarded non lo posso mettere altrimenti il create genera un INSERT ch cerca di scrivere anche il campo id
}
