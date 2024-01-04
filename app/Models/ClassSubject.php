<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory;

    protected $fillable = ['school_class_id', 'school_subject_id', 'status', 'created_by'];

    public function schoolClasses()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id', 'id');
    }

    public function schoolSubjects()
    {
        return $this->belongsTo(SchoolSubject::class, 'school_subject_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeJoinSchoolClassesAndSubjects($query)
    {
        return $query->join('school_classes', 'class_subjects.school_class_id', '=', 'school_classes.id')
            ->join('school_subjects', 'class_subjects.school_subject_id', '=', 'school_subjects.id')
            ->select('class_subjects.*', 'school_classes.name as nameClass', 'school_subjects.name as nameSubject');
    }
}