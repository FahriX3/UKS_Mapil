<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicine extends Model
{
    protected $fillable = [
        'nama_obat',
        'satuan',
        'stok',
    ];

    /**
     * Get treatments that used this medicine.
     */
    public function treatments(): BelongsToMany
    {
        return $this->belongsToMany(Treatment::class, 'treatment_details')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}
