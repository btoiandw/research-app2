<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ResearchSource extends Model
{
    use HasFactory;

    //protected $table = ['research_sources'];

    protected $fillable = [
        'research_sources_id',
        'research_source_name',
        'Year_source',
        'type_research_source',
        'ex_research',
    ];

    public function research()
    {
        return $this->belongsTo(Research::class, 'research_source_id', 'research_source_id');
    }
}
