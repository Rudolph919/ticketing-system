<?php

namespace App\Models;

use App\Models\Document;
use App\Models\Interest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'date_of_birth',
        'email',
        'phone_number',
        'gender',
    ];

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'interest_personal_detail', 'personal_detail_id', 'interest_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'interest_id');
    }

}
