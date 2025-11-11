<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
      protected $primaryKey = 'id';
    protected $table = 'doctor';
    protected $fillable = ['active', 'name'. 'certificate'];

}
