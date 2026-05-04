<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'kelas_id',
        'jenis_kelamin',
    ];

    /**
     * Get the class this student belongs to.
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Get treatments for this student.
     */
    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }
}
