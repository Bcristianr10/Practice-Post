<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    User,
    Category,
    Tag,
    Image,
};


class Post extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;
//Relation one to many inversa
    public function user (){
        return $this->belongsTo(User::class);
    }
    public function category (){
        return $this->belongsTo(Category::class);
    }

    //Relation many to many
    public function tags (){
        return $this->belongsToMany(Tag::class);
    }

    //Polimor Relation one to many

    public function images (){
        return $this->morphMany(Image::class,'imageable'); 
    }
}
