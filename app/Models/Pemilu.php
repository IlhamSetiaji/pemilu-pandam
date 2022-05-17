<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilu extends Model
{
    use HasFactory;
    protected $table = 'pemilu';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function osis()
    {
        return $this->hasMany(Osis::class);
    }
}
