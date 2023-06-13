<?php

namespace App\Models;

use App\Models\Interest;
use App\Models\PersonalDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'personal_details_id',
        'interest_id',
        'document_name',
        'file_path',
    ];

    public function personalDetails()
    {
        return $this->belongsTo(PersonalDetail::class);
    }

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }
}
