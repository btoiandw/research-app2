<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_sources_id',
        'research_source_name',
        'Year_source',
        'type_research_source',
        'ex_research',
    ];
}
