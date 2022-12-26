<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'slug'
    ];

    protected $allowIncluded = ['posts','posts.user'];
    protected $allowFilter = ['id','name','slug'];
    protected $allowSort = ['id','name','slug'];

        //Relation one to many
    public function posts (){
        return $this->hasMany(Post::class);
    }
    public function scopeIncluded (Builder $query){
        if(empty($this->allowIncluded) ||empty(request('included'))){
            return;                 
        }
        //explode: convert string in array separated with ,
        $relations = explode(',',request('included'));
        $allowIcluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationsShip) { 
            // contains: if relationsSHip is in allowIncluded, in this case the condition is if isn't inside relationShip 
            if(!$allowIcluded->contains($relationsShip)){
                //unset(array[key])
                unset($relations[$key]);
            }
        }
        $query->with($relations);
    }
    public function scopeFilter (Builder $query){
        if(empty($this->allowFilter) ||empty(request('filter'))){
            return;                 
        }
        $filters = request('filter');
        $allowFilter  = collect($this->allowFilter);
        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter,'LIKE', '%'.$value.'%');
            }
        }
    }
    public function scopeSort (Builder $query){
        if(empty($this->allowSort) ||empty(request('sort'))){
            return;                 
        }        
        $sortFields = explode(',',request('sort'));
    }
}
