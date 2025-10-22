<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_compte',
        'type',
        'statut',
        'solde',
        'client_id',
    ];

    protected $casts = [
        'id' => 'string',
        'solde' => 'decimal:2',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * Générer automatiquement le numéro de compte
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($compte) {
            if (empty($compte->numero_compte)) {
                $compte->numero_compte = 'SN' . date('Y') . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Relation belongsTo vers Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
