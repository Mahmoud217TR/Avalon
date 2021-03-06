<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'handle',
        'password',
        'note',
        'user_id',
    ];
    
    public function user(){
        return $this->hasOne(User::class);
    }
}
