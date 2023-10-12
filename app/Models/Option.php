<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        'option_text','question_id','next_question_id','recommendation_allowed'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function recommendation()
    {
        return $this->hasMany(Recommendation::class);
    }

}
