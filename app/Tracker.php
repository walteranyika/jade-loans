<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $fillable = ['credit_id','payment_date','amount','paid'];
    protected $dates = [
        'payment_date',
        'created_at',
        'updated_at',
    ];
    public function credit()
    {
       return $this->belongsTo(Credit::class, 'credit_id');
    }

}
