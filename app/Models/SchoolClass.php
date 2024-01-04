<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'school_classes';

    protected $fillable = ['name', 'status', 'created_by'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function school_subjects()
    {
        return $this->belongsToMany(SchoolSubject::class, 'class_subjects');
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'school_class_id', 'id');
    }
}