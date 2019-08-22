<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Skill;


use Illuminate\Database\Eloquent\Model;

class Video extends Model
{


    protected $fillable = ['name',
                            'des',
                            'meta_des',
                            'meta_keywords',
                            'youtube',
                            'published',
                            'image',
                            'user_id',
                            'cat_id'];

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function cat(){

        return $this->belongsTo(Category::class,'cat_id');
    }

    public function skills(){

        return $this->belongsToMany(Skill::class, 'skills_videos');
    }


    public function tags(){

        return $this->belongsToMany(Tag::class, 'tags_videos');
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }

}