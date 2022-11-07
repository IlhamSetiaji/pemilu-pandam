<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DapilModel extends Model
{
    use HasFactory;
    protected $table = 'dapil';
    protected $guarded = ['id'];

    public function pemilu(){
        return $this->belongsTo(Pemilu::class);
    }

    public function parlement(){
        return $this->hasMany(ParlementModel::class, 'dapil_id');
    }
}
