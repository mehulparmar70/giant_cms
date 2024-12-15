<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    public function category()
{
    return $this->belongsTo(Category::class, 'media_id');  // Use the correct foreign key (media_id)
}

}
