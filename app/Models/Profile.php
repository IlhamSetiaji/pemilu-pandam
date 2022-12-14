<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function dapil(){
        return $this->belongsTo(DapilModel::class);
    }

    public function pemilu()
    {
        return $this->belongsTo(Pemilu::class, 'pemilu_id');
    }

    public function vote(){
        return $this->hasOne(VoteModel::class, 'profile_id');
    }
}
