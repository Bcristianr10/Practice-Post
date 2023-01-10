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
use App\Traits\ApiTrait;


class Post extends Model
{
    use HasFactory, ApiTrait;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    protected $fillable = ['name','slug','extract','body','status','category_id','user_id'];

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
