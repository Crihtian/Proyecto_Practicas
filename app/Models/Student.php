<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'lastname',
        'idcard',
        'email',
        'birthday',
        'disability',
        'address',
    ];
    protected $casts = [


        'birthday' => 'date',
        'disability' => 'boolean',
    ];


    public function scopeSearch($query, $term)
    {
        if (!$term) return $query;

        $term = "%$term%";

        return $query->where(function($q)use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('lastname', 'like', $term)
                  ->orWhere('idcard', 'like', $term)
                  ->orWhere('address', 'like', $term)
                  ->orWhere('birthday', 'like', $term)
                  ->orWhere('disability', 'like', $term);
        });

    }


   public function scopeFilter($query, $filters)
    {
    return $query->when($filters['name'] ?? false, fn($q, $name) =>
            $q->where('name', 'like', "%$name%"))
        ->when($filters['lastname'] ?? false, fn($q, $lastname) =>
            $q->where('lastname', 'like', "%$lastname%"))
        ->when($filters['idcard'] ?? false, fn($q, $idcard) =>
            $q->where('idcard', $idcard))
        ->when($filters['email'] ?? false, fn($q, $email) =>
            $q->where('email', 'like', "%$email%"))
         ->when(array_key_exists('disability', $filters), fn($q) =>
            $q->where('disability', $filters['disability']))
        ->when($filters['birthday'] ?? false, fn($q, $birthday) =>
            $q->whereDate('birthday', $birthday))
        ->when($filters['address'] ?? false, fn($q, $address) =>
            $q->where('address', 'like', "%$address%"));
    }


}



