<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationInformation extends Model
{
    use HasFactory;
    protected $table = 'publication_information';
    protected $fillable = ['general_information_id', 'publication_id', 'books_name', 'publication_date', 'comment', 'document'];

    //relationship

    public function generalInformation(){
        return $this->belongsTo(GeneralInformation::class);
    }

    public function publication(){
        return $this->belongsTo(Publication::class);
    }
}
