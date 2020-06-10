<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Product extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const CREATED_BY_RADIO = [
        '1' => 'Martha',
        '2' => 'Sarah',
    ];

    protected $fillable = [
        'package_name',
        'amount',
        'deposit',
        'duration',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function productCredits()
    {
        return $this->hasMany(Credit::class, 'product_id', 'id');
    }
}
