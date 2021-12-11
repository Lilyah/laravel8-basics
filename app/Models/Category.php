<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'category_name',
    ];


    /* This method is needed if you are using Eloquent ORM in CategoryController
    */
    // Relation between $users->user_id and $category->user_id
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id'); // field 'id' from User::call to be related to 'user_id' in Category class
    }

}
