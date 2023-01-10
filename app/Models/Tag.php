<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Traits\ApiTrait;

class Tag extends Model
{
    use HasFactory, ApiTrait;

    //Relation many to many
    public function posts (){
        return $this->belongsToMany(Post::class);
    }
}
