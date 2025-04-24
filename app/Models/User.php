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
        ];
    }
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';

    // Check if the user is an admin
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // Check if the user is a manager
    public function isManager()
    {
        return $this->role === self::ROLE_MANAGER;
    }

    // Check if the user is a regular user
    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }
}
