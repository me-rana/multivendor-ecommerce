<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopInfo extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * Get the user that owns the shop info.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
