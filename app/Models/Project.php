<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_project',
        'slug',
        'url_github',
        'description',
        'type_id'
    ];


    public function type(){
        return $this->belongsTo(Type::class);
    }


    //techs = technologies
    public function technologies(){                            
        return $this->belongsToMany(Technology::class);
    }
}
