<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParlementModel extends Model
{
    use HasFactory;
    protected $table = 'parlement';
    protected $guarded = ['id'];
}
