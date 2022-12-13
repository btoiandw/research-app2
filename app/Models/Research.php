<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;
    protected $table=['research'];

    protected $fillable = [
        'research_id',
        'date_upload_file',
        'research_th',
        'research_en',
        'research_source_id',
        'type_research_id',
        'keyword',
        'date_research_start',
        'date_research_end',
        'research_area',
        'budage_research',
        'word_file',
        'pdf_file',
        'research_summary_feedback',
        'research_status',
        'year_research'
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function source(){
        return $this->hasOne(ResearchSource::class,'research_source_id','research_source_id');
    }
}
