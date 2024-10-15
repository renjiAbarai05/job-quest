<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'location', 'salary', 'description', 'experience',
        'category',
    ];

    public static array $experience = ['entry', 'intermediate', 'senior'];

    public static array $category = ['IT', 'Finance', 'Sales', 'Marketing'];

    public function scopeFilter(Builder|QueryBuilder $query, array $filters): Builder|QueryBuilder
    {
        return $query->when($filters['search'] ?? null, fn ($query, $search) => $query->where(fn ($query) => $query->where('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->orWhereHas('employer', fn ($query) => $query
                ->where('company_name', 'like', '%'.$search.'%')
            )
        )
        )->when($filters['min_salary'] ?? null, fn ($query, $minSalary) => $query->where('salary', '>=', $minSalary)
        )->when($filters['max_salary'] ?? null, fn ($query, $maxSalary) => $query->where('salary', '<=', $maxSalary)
        )->when($filters['experience'] ?? null, fn ($query, $experience) => $query->where('experience', $experience)
        )->when($filters['category'] ?? null, fn ($query, $category) => $query->where('category', $category)
        );
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function hasUserApplied(Authenticatable|User|int $user): bool
    {
        // return $this->where('id', $this->id)->whereHas(
        //     'jobApplications',
        //     fn ($query) => $query->where('user_id', $user->id ?? $user)
        // )->exists();

        return $this->jobApplications()->where('user_id', $user->id ?? $user)->exists();
    }
}
