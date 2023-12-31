<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Engine extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'engine';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_engine';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'capacity'
    ];

    /**
     * @return BelongsTo
     */
    public function engineType(): BelongsTo
    {
        return $this->belongsTo(EngineType::class);
    }

    /**
     * @return BelongsTo
     */
    public function modelBike(): BelongsTo
    {
        return $this->belongsTo(ModelBike::class);
    }
}
