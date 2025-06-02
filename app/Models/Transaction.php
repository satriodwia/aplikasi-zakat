<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['zakat_id', 'muzaki_id', 'quantity', 'total_amount', 'status'];

    public function zakat()
    {
        return $this->belongsTo(Zakat::class);
    }

    public function muzaki()
    {
        return $this->belongsTo(Muzaki::class);
    }
}
