<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresidentModel extends Model
{
    use HasFactory;
    protected $table = 'president';
    protected $guarded = ['id'];
}
