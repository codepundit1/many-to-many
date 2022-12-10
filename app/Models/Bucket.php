<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bucket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute($value): ?string
    {
        if ($value)
            return Storage::disk('s3')->url($value);

        return null;
    }
}
