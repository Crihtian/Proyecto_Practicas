<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
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

    #[Scope]
    public function Search($query, $q)
{
    if (!$q) return $query;

    $q = "%$q%";

    return $query->when($q, function ($query, $q) {
        $query->where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                  ->orWhere('lastname', 'like', "%$q%")
                  ->orWhere('idcard', 'like', "%$q%")
                  ->orWhere('address', 'like', "%$q%")
                  ->orWhere('birthday', 'like', "%$q%")
                  ->orWhere('disability', 'like', "%$q%");
        });
    });
}

#[Scope]
    public function Filter($query,$filters)
{
 return $query->when($filters['name'] ?? false, function ($query, $name) {
        $query->where('name', 'like', "%$name%");
    })->when($filters['lastname'] ?? false, function ($query, $lastname) {
        $query->where('lastname', 'like', "%$lastname%");
    })->when($filters['idcard'] ?? false, function ($query, $idcard) {
        $query->where('idcard', 'like', "%$idcard%");
    })->when($filters['email'] ?? false, function ($query, $email) {
        $query->where('email', 'like', "%$email%");
    })->when($filters['birthday'] ?? false, function ($query, $birthday) {
        $query->whereDate('birthday', $birthday);
    })->when($filters['disability'] ?? null, function ($query, $disability) {
        $query->where('disability', $disability);
    });

}

}



