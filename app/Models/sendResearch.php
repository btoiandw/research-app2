<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sendResearch extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'research_id',
        'pc'
    ];

    
}
