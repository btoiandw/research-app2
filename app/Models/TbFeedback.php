<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbFeedback extends Model
{
    use HasFactory;
    protected $table =['tb_feedback'];

    protected $fillable = [
        'feedback_id','id','research_id','feedback','Assessment_result'
    ];
}
