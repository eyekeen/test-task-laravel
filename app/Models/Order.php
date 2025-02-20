<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'status',
        'comment'
    ];

    /**
     * Связь с товарами
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity') // Включаем поле quantity из промежуточной таблицы
                    ->withTimestamps();    // Включаем timestamps из промежуточной таблицы
    }
}
