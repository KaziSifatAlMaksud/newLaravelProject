<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
   protected $fillable = [
        'child_id',
        'parent_id',
        'content_id',
        'status',
    ];

    // public $timestamps = false;

    public function child_id()
    {
        return $this->belongsTo(ChildUser::class);
    }
    public function parent_id()
    {
        return $this->belongsTo(User::class);
    }
      public function content()
    {
        return $this->belongsTo(Categories::class, 'content_id');
    }
}
