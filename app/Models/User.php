<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_expires_at' => 'datetime'
        ];
    }

    /**
     * Genera un código de verificación de 6 dígitos para el usuario
     * Este código se usa para la autenticación de dos factores (2FA)
     * El código expira después de 10 minutos
     */
    public function generateTwoFactorCode(): void
    {
        $this->timestamps = false;  // Evita actualizar el timestamp updated_at
        $this->two_factor_code = rand(100000, 999999);  // Genera un código aleatorio de 6 dígitos
        $this->two_factor_expires_at = now()->addMinutes(10);  // Establece la expiración a 10 minutos
        $this->save();
    }

    /**
     * Resetea el código de verificación 2FA y su tiempo de expiración
     * Se usa después de una verificación exitosa o cuando el código expira
     */
    public function resetTwoFactorCode(): void
    {
        $this->timestamps = false;  // Evita actualizar el timestamp updated_at
        $this->two_factor_code = null;  // Elimina el código de verificación
        $this->two_factor_expires_at = null;  // Elimina la fecha de expiración
        $this->save();
    }
}
