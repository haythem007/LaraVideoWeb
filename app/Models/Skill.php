<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
   protected $fillable = ['name'];


   public function videos(){

    return $this->belongsToMany(Video::class, 'skills_videos');
}
}