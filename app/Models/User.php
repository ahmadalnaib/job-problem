<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\JobApplication;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\Expo\ExpoPushToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'expo_push_token',
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
          'expo_push_token' => ExpoPushToken::class,
        ];
    }

    public function jobApplications()
{
    return $this->hasMany(JobApplication::class);
}


 public function routeNotificationForExpo(): ?ExpoPushToken
    {
        return $this->expo_push_token;
    }
}
