<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PublicImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageAttribute($value): ?string
    {
        if($value)
            return Storage::url($value);
        return null;
    }
}
