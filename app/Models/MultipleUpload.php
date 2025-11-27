<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MultipleUpload;


class MultipleUpload extends Model
{
    use HasFactory;

    protected $table = 'multipleuploads';

    protected $fillable = [
        'file',
        'ref_table',
        'ref_id',
    ];
}
