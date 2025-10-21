<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'description',
        'available_copies',
        'price',
        'cover_image',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
