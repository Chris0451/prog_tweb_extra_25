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
        'username',
        'password',
        'nome',
        'cognome',
        'role'
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
            'password' => 'hashed',
        ];
    }
    /**
     * Verifica se il corretto ruolo dell'utente.
     *
     * @return bool
     */
    public function isTecnico():bool{
        return $this->ruolo === 'tecnico';
    }
    public function isStaff():bool{
        return $this->ruolo === 'staff';
    }
    public function isAdmin():bool{
        return $this->ruolo === 'admin';
    }

    public function profiloTecnico()
    {
        return $this->hasOne(Tecnico::class, 'id_utente');
    }

    /**
     * Verifica se l'utente appartiene a uno dei ruoli specificati.
     * Utile per controllare ruoli multipli.
     *
     * @param  array|string  $roles
     * @return bool
     */
    public function hasRole(array|string $roles): bool
    {
        // Se $roles è una stringa, la convertiamo in un array per uniformità
        if (is_string($roles)) {
            $roles = [$roles];
        }

        return in_array($this->role, $roles);
    }
}
