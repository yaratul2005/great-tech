<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_id',
        'user_id',
        'license_key',
        'domain',
        'expires_at',
        'status',
        'max_downloads',
        'download_count',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // Relationships
    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function download()
    {
        return $this->hasOne(Download::class);
    }
}