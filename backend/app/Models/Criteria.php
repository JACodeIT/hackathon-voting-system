<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = "criterias";

    protected $fillable = [
        'criterion_id',
        'min_rating',
        'max_rating',
        'percentage_value',
    ];

    /**
     * Get the criterion associated with the Criteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function criterion()
    {
        return $this->hasOne(Criterion::class, 'id', 'criterion_id');
    }
}
