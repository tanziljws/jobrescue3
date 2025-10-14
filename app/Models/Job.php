<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_postings';

    protected $fillable = [
        'title',
        'description',
        'employer_id',
        'category_id',
        'budget_min',
        'budget_max',
        'budget_type',
        'location',
        'job_type',
        'status',
        'deadline',
        'requirements',
        'skills_required',
        'applications_count',
        'is_urgent',
        'approved_at',
        'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'requirements' => 'array',
            'skills_required' => 'array',
            'is_urgent' => 'boolean',
            'approved_at' => 'datetime',
            'budget_min' => 'decimal:2',
            'budget_max' => 'decimal:2',
        ];
    }

    // Relationships
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'reported_job_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true);
    }
}
