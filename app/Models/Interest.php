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
        'personal_detail_id',
        'interest',
    ];

    public function personalDetails()
    {
        return $this->belongsToMany(PersonalDetail::class, 'interest_personal_detail', 'interest_id', 'personal_detail_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'personal_detail_id');
    }
}
