<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Guarantor extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'guarantors';

    protected $appends = [
        'id_number',
    ];

    const ADDED_BY_RADIO = [
        '1' => 'Martha',
        '2' => 'Sarah',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'idd_number',
        'phone_number',
        'id_back',
        'address',
        'added_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function guarantorCredits()
    {
        return $this->hasMany(Credit::class, 'guarantor_id', 'id');
    }

    public function getIdNumberAttribute()
    {
        $file = $this->getMedia('id_number')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }
}
