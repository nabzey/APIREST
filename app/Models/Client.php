<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'telephone',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * Get the user that owns the client.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comptes associated with the client.
     */
    public function comptes()
    {
        return $this->hasMany(Compte::class);
    }
}