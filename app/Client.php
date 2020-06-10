<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Client extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Auditable;

    public $table = 'clients';

    const GENDER_RADIO = [
        '1' => 'Female',
        '2' => 'Male',
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

    protected $appends = [
        'passport_photo',
        'id_front',
        'id_back',
    ];

    const APPLICATION_RADIO = [
        '1' => 'First Application',
        '2' => 'Second Application',
        '3' => 'Third Application',
        '4' => 'Fourth Application',
        '5' => 'Fifth Application',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'id_number',
        'phone_number',
        'gender',
        'zone',
        'kra_pin',
        'postal_address',
        'email_address',
        'occupation',
        'application',
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

    public function clientCredits()
    {
        return $this->hasMany(Credit::class, 'client_id', 'id');
    }

    public function getPassportPhotoAttribute()
    {
        $file = $this->getMedia('passport_photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getIdFrontAttribute()
    {
        $file = $this->getMedia('id_front')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getIdBackAttribute()
    {
        $file = $this->getMedia('id_back')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }
}
