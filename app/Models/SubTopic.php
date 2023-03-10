<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTopic extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_subtopic',
        'title',
        'result',
        'code_topic'
    ];

    public function TopicData()
    {
        $this->belongsTo(TopicData::class);
    }
}
