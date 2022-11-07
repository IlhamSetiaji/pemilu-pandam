<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteModel extends Model
{
    use HasFactory;

    protected $table = 'user_has_votes';
    protected $guarded = ['id'];

    
}
