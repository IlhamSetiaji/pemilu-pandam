<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParlementModel extends Model
{
    use HasFactory;
    protected $table = 'parlement';
    protected $guarded = ['id'];

    public function dapil(){
        return $this->belongsTo(DapilModel::class);
    }

    public function votes(){
        return $this->hasMany(VoteModel::class, 'parlement_id');
    }
}
