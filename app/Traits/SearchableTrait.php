<?php
namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait SearchableTrait{

    public function scopeSearch(Builder $query,$searchTerm, array $colums){
        if($searchTerm){
            $query->where(function($query) use ($searchTerm,$colums){
                foreach ($colums as $colum){
                    $query->orWhere($colum,'like', "%{$searchTerm}%");
                }
            });
        }
    }
    
}

