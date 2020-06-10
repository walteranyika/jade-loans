<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Credit extends Model
{
    use SoftDeletes;

    public $table = 'credits';

    protected $dates = [
        'date_issued',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_id',
        'product_id',
        'amount',
        'guarantor_id',
        'status',
        'user_id',
        'date_issued',
        'total_repayment',
        'balance',
        'location_id',
        'mpesa_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function trackers()
    {
        return $this->hasMany(Tracker::class);
    }
    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }

    public function dailyPayment()
    {
        return $this->product->amount/$this->product->duration;
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function guarantor()
    {
        return $this->belongsTo(Guarantor::class, 'guarantor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusAttribute($value)
    {
        if ($value==0)
        {
            return "Active";
        }
        else if ($value==1)
        {
            return "Completed";
        }
        else{
            return "Dormant";
        }

    }
    public function getDateIssuedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateIssuedAttribute($value)
    {
        $this->attributes['date_issued'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }


}
