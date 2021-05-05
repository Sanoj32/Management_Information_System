<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BctSubject extends Model
{
    protected $guarded = [];

    use HasFactory;
    protected $primaryKey = 'subject_code';
    protected $keyType = 'string';
    public $incrementing = false;
    

    public function teachers()
    {
        return $this->belongsToMany(User::class);
    }
}
