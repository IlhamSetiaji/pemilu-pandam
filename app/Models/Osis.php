<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Osis extends Model
{
    use HasFactory;
    protected $table = 'osis';
    protected $guarded = ['id'];

    public function pemilu()
    {
        return $this->belongsTo(Pemilu::class,'pemilu_id');
    }

    public function pemilih_osis()
    {
        return $this->belongsToMany(User::class,'pemilih_osis','osis_id','user_id')->withTimestamps();
    }
}
