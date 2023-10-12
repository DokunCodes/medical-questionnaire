<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'question_text','question_rank'
        ];

    public function options(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Option::class);
    }

    protected static function booted(): void
    {
        static::deleting(function ($question) {
            foreach ($question->options as $option) {
                $option->recommendation()->delete();
                $option->delete();
            }
        });
    }

}

