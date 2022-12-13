<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sendResearch extends Model
{
    use HasFactory;

    protected $table=['send_research'];

    protected $fillable = [
        'id',
        'research_id',
        'pc'
    ];
    /* protected $casts = [
        'id' => 'array',
        'research_id' => 'array',
        'pc' => 'array'
    ]; */
}
