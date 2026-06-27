<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'question',
        'answer',
        'sort_order',
        'status',
        'display_on_home',
        'display_on_service_detail',
        'display_on_expert_detail',
        'service_id',
        'expert_id',
    ];

    /**
     * Get the attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'display_on_home' => 'boolean',
            'display_on_service_detail' => 'boolean',
            'display_on_expert_detail' => 'boolean',
        ];
    }

    /**
     * Get the service this FAQ is assigned to.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the expert this FAQ is assigned to.
     */
    public function expert(): BelongsTo
    {
        return $this->belongsTo(Expert::class);
    }

    /**
     * Scope active FAQs ordered for display.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('question');
    }

    /**
     * Scope FAQs shown on the home page section.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForHome(Builder $query): Builder
    {
        return $query
            ->where('display_on_home', true)
            ->whereNull('service_id')
            ->whereNull('expert_id')
            ->activeOrdered();
    }

    /**
     * Scope FAQs shown on a service detail page.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForServiceDetail(Builder $query, Service $service): Builder
    {
        return $query
            ->where(function (Builder $builder) use ($service) {
                $builder
                    ->where('service_id', $service->id)
                    ->orWhere(function (Builder $global) {
                        $global
                            ->whereNull('service_id')
                            ->whereNull('expert_id')
                            ->where('display_on_service_detail', true);
                    });
            })
            ->activeOrdered();
    }

    /**
     * Scope FAQs shown on an expert detail page.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForExpertDetail(Builder $query, Expert $expert): Builder
    {
        return $query
            ->where(function (Builder $builder) use ($expert) {
                $builder
                    ->where('expert_id', $expert->id)
                    ->orWhere(function (Builder $global) {
                        $global
                            ->whereNull('service_id')
                            ->whereNull('expert_id')
                            ->where('display_on_expert_detail', true);
                    });
            })
            ->activeOrdered();
    }
}
