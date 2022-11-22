<?php

namespace App\Models;

use App\Models\Profile as ModelsProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilu extends Model
{
    use HasFactory;
    protected $table = 'pemilu';
    protected $guarded = ['id'];

    public function pemilih()
    {
        return $this->hasMany(ModelsProfile::class, 'pemilu_id');
    }

    public function dapil(){
        return $this->hasMany(DapilModel::class, 'pemilu_id');
    }

    public function osis()
    {
        return $this->hasMany(Osis::class);
    }

    public function president(){
        return $this->hasMany(PresidentModel::class, 'pemilu_id');
    }
}
