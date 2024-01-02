<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'skor1',
        'skor2',
        'skor3',
        'skor4',
        'skor5',
        'skor6',
        'skor7',
        'skor8',
        'skor9',
        'skor10',];
}
