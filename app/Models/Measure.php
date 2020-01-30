<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    protected $fillable = [
        'id', 'idUser', 'leftArm', 'rightArm', 'leftForearm', 'rightForearm', 'contractedRightArm',
        'contractedLeftArm', 'leftThigh', 'rightThigh', 'leftCalf', 'rightCalf', 'chest', 'waist',
        'abdomen', 'hip', 'abdominal', 'supraIliac', 'triceps', 'subScapula', 'biceps', 'breastplate',
        'auxiliaryMedia', 'thigh', 'calf', 'weight', 'height', 'currentIMC', 'currentFat', 'RCQ'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
