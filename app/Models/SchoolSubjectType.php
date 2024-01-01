<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolSubjectType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function schoolSubjects()
    {
        return $this->hasMany(SchoolSubject::class, 'school_subject_type_id', 'id');
    }
}