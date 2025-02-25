<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Jetstream\Agent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;

    protected $appends = ['expires_at', 'agent', 'is_current_device', 'last_active'];

    public function isExpired()
    {
        return $this->last_activity < Carbon::now()->subMinutes(intval(config('session.lifetime')))->getTimestamp();
    }

    public function getLastActiveAttribute()
    {
        return Carbon::createFromTimestamp($this->last_activity)->diffForHumans();
    }

    public function getAgentAttribute()
    {
        return tap(new Agent(), fn ($agent) => $agent->setUserAgent($this->user_agent));
    }

    public function getIsCurrentDeviceAttribute()
    {
        return $this->id == request()->session()->getId();
    }

    public function getExpiresAtAttribute()
    {
        return Carbon::createFromTimestamp($this->last_activity)->addMinutes(intval(config('session.lifetime')))->toDateTimeString();
    }
}
