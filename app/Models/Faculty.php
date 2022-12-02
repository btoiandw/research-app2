<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizational',
        'major'
    ];

    public function research(){
        return $this->hasOne(Research::class,'id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'organization_id','id');
    }
}
