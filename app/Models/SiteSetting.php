<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    /**
     * Cast setting value based on type.
     */
    public function getCastedValueAttribute(): mixed
    {
        return match ($this->type) {
            'boolean', 'bool' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            'integer', 'int' => (int) $this->value,
            'float' => (float) $this->value,
            'json', 'array' => json_decode($this->value, true) ?? [],
            default => $this->value,
        };
    }
}
