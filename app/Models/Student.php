<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable implements JWTSubject
{
     use HasFactory, Notifiable;

    protected $guarded=[];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

     public function enrolledCourses()
{
    return $this->belongsToMany(Course::class, 'student_transactions')
                ->withTimestamps()
                ->withPivot('status');
}

     public function transactions()
     {
        return $this->hasMany(StudentTransactions::class);
     }


}
