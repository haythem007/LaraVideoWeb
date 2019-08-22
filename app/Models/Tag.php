<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Video;

class Tag extends Model
{
    
    protected $fillable=['name'];

    public function videos(){

        return $this->belongsToMany(Video::class, 'skills_videos');
    }
}
