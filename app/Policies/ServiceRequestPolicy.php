<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    // Any signed-in user may reach the list; the controller scopes what they see.
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Owner or administrator.
    public function view(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->isAdmin() || (int) $serviceRequest->user_id === (int) $user->id;
    }

    // Students only.
    public function create(User $user): bool
    {
        return $user->role === 'student';
    }

    // Administrator only.
    public function updateStatus(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->isAdmin();
    }
}