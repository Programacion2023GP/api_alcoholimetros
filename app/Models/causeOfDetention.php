<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class causeOfDetention extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'causeOfDetention';
    protected $fillable = ['active', 'name' . 'color'];
}
