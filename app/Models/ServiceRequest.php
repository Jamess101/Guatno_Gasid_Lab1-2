<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    public const STATUSES = ['pending', 'approved', 'rejected'];

    protected $table = 'requests';

    // Only fields a student may submit. Owner, name, email and status are set by the server.
    protected $fillable = ['item_name', 'quantity', 'purpose'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}