<?php

namespace App\Models;

use App\Enums\AustralianState;
use DoubleThreeDigital\Runway\Traits\HasRunwayResource;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Glide\GlideImage;

class Donut extends Model
{
    use HasFactory;
    use HasRunwayResource;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'details',
        'location',
        'state',
        'type',
        'rating_size',
        'rating_appearance',
        'rating_value',
    ];

    protected $casts = [
        'rating_size' => 'float',
        'rating_appearance' => 'float',
        'rating_value' => 'float',
        //'state' => AustralianState::class,
        //'type' => Type::class,
    ];

    protected $attributes = [
        'state' => AustralianState::VIC,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function updatePhoto(UploadedFile $photo, $storagePath = 'donuts')
    {
        tap($this->photo_path, function ($previous) use ($photo, $storagePath) {
            $input = $photo->path();
            $filename = $photo->hashName($storagePath);
            $filename = substr($filename, 0, strrpos($filename, '.')).'.webp';
            $output = Storage::disk($this->photoDisk())->path($filename);

            GlideImage::create($input)
                ->modify(['w' => 1500, 'fm' => 'webp', 'q' => 70])
                ->save($output);

            $this->forceFill(['photo_path' => $filename])->save();

            if ($previous) {
                Storage::disk($this->photoDisk())->delete($previous);
            }
        });
    }

    protected function photoDisk()
    {
        return 'public';
    }

    public function photoUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->photo_path
                ? Storage::disk($this->photoDisk())->url($this->photo_path)
                : '/images/default.png';
        });
    }
}
