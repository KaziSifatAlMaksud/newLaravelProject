<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';

    // Define the fillable properties
  protected $fillable = [
        'title',
        'description',
        'video',
        'image',
        'status',
        'user_id',
        'child_id'
    ];

    // Define relationships
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }


    public function child()
    {
        return $this->belongsTo(ChildUser::class, 'child_id');
    }

    // public function parentCategory()
    // {
    //     return $this->hasMany(Category::class, 'child_id');
    // }
}
