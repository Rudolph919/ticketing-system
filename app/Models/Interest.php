<?php

namespace App\Models;

use App\Models\Document;
use App\Models\PersonalDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function personalDetails()
    {
        return $this->belongsToMany(PersonalDetail::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
