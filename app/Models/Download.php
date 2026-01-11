<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_id',
        'tool_id',
        'ip_address',
        'user_agent',
    ];

    // Relationships
    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
}