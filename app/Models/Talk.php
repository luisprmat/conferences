<?php

namespace App\Models;

use App\Enums\Talk\Length;
use App\Enums\Talk\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Talk extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'speaker_id' => 'integer',
            'status' => Status::class,
            'length' => Length::class,
        ];
    }

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    public function conferences(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class);
    }

    public function approve(): void
    {
        $this->status = Status::Approved;

        // Notify to speaker.

        $this->save();
    }

    public function reject(): void
    {
        $this->status = Status::Rejected;

        // Notify to speaker.

        $this->save();
    }
}
