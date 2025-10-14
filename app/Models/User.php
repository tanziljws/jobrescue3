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
        'role',
        'phone',
        'address',
        'city',
        'district',
        'subdistrict',
        'bio',
        'skills',
        'profile_photo',
        'is_verified',
        'is_active',
        'verified_at',
        'rating',
        'total_reviews',
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
            'verified_at' => 'datetime',
            'skills' => 'array',
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
            'rating' => 'decimal:2',
        ];
    }

    // Relationships
    public function employerJobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    public function reportedReports()
    {
        return $this->hasMany(Report::class, 'reported_user_id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'worker_id');
    }

    // Scopes
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeWorkers($query)
    {
        return $query->where('role', 'worker');
    }

    public function scopeEmployers($query)
    {
        return $query->where('role', 'employer');
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
