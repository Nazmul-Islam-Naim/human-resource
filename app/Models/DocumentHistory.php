<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DocumentHistory extends Model
{
    use HasFactory;
    protected $table = 'document_histories';
    protected $fillable = [ 'general_information_id', 'documentable_id', 'documentable_type', 'document_title', 'document' ];

    // relations
    public function generalInformation() {
        return $this->belongsTo(GeneralInformation::class);
    }

    public function documentable():MorphTo {
        return $this->morphTo();
    }
}
