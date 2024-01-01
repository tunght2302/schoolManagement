<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SchoolSubject extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name','school_subject_type_id','status'];

    public function schoolSubjectTypes()
    {
        return $this->belongsTo(SchoolSubjectType::class, 'school_subject_type_id', 'id');
    }
}