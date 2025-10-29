<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'worker_id',
        'cover_letter',
        'proposed_budget',
        'estimated_days',
        'portfolio_links',
        'status',
        'employer_notes',
        'applied_at',
        'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'portfolio_links' => 'array',
            'applied_at' => 'datetime',
            'responded_at' => 'datetime',
            'proposed_budget' => 'decimal:2',
        ];
    }

    // Relationships
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
