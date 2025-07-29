<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
     protected $guarded=[];

     public function lessons()
     {
        return $this->hasMany(Lesson::class);
     }


     public function trainer()
     {
        return $this->belongsTo(Trainer::class);
     }

      public function enrolledStudents()
     {
        return $this->belongsToMany(Student::class ,'student_transactions');
     }

     public function studentTransactions()
{
    return $this->hasMany(StudentTransactions::class);
}

    public function enrolledStudentCount()
{
    return $this->StudentTransactions()
                ->where('status', 'approved')
                ->count();
}


}
