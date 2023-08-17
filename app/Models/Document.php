<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [

        'user_id',
        'country_code',
        'document_type_id',
        'transaction_id',
        'image',
    ];
}
