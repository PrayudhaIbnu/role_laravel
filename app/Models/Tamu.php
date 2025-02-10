<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tamu extends Model
{
    use HasFactory, Notifiable;

    // const ANGKATAN_22 = '22' ;
    // const ANGKATAN_23 = '23' ;
    // const ANGKATAN_24 = '24' ;
    // const ANGKATAN_25 = '25' ;
    // const ANGKATAN_26 = '26' ;

    protected $fillable = [
        'nama',
        'angkatan',
        'photo',
        'nomor_tempat_duduk'
    ];

    // public function hasAngkatan(string $angkatan): bool
    // {
    //     return $this->angkatan === $angkatan;
    // }

    // public function isAngkatan22(): bool
    // {
    //     return $this->hasAngkatan(self::ANGKATAN_22);
    // }

    // public function isAngkatan23(): bool
    // {
    //     return $this->hasAngkatan(self::ANGKATAN_23);
    // }

    // public function isAngkatan24(): bool
    // {
    //     return $this->hasAngkatan(self::ANGKATAN_24);
    // }

    // public function isAngkatan25(): bool
    // {
    //     return $this->hasAngkatan(self::ANGKATAN_25);
    // }

    // public function isAngkatan26(): bool
    // {
    //     return $this->hasAngkatan(self::ANGKATAN_26);
    // }
}
