<?php

namespace App\Models;

use Database\Factories\MediaFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    /** @use HasFactory<MediaFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'file_name',
        'disk',
        'mime_type',
        'size',
        'width',
        'height',
        'alt_text',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'url',
        'is_image',
        'human_size',
        'dimensions',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
        ];
    }

    /**
     * Get the public URL for the media file.
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn (): string => Storage::disk($this->disk ?? 'public')->url($this->file_name),
        );
    }

    /**
     * Check if the media file is an image.
     */
    protected function isImage(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => str_starts_with($this->mime_type ?? '', 'image/'),
        );
    }

    /**
     * Get human-readable file size.
     */
    protected function humanSize(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $bytes = $this->size ?? 0;
                if ($bytes >= 1048576) {
                    return number_format($bytes / 1048576, 1).' MB';
                }
                if ($bytes >= 1024) {
                    return number_format($bytes / 1024, 0).' KB';
                }

                return $bytes.' B';
            },
        );
    }

    /**
     * Get image dimensions string if available.
     */
    protected function dimensions(): Attribute
    {
        return Attribute::make(
            get: fn (): ?string => ($this->width && $this->height) ? "{$this->width}×{$this->height}" : null,
        );
    }
}
