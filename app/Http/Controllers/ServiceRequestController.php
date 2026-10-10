<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceRequestController extends Controller
{
    // LIST (GET)
    public function index(Request $request)
    {
        Gate::authorize('viewAny', ServiceRequest::class);
        $user = $request->user();

        $query = ServiceRequest::query();

        // Scope FIRST, by account ID (never by name or email). Filters, search and
        // pagination below are chained onto this scoped query, so they cannot widen it.
        if (! $user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('status')
            && in_array($request->input('status'), ServiceRequest::STATUSES, true)) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('q')) {
            $term = '%' . mb_substr((string) $request->input('q'), 0, 100) . '%';
            $query->where(fn ($w) => $w->where('item_name', 'like', $term)
                                       ->orWhere('purpose', 'like', $term));
        }

        return view('requests.index', [
            'requests' => $query->orderBy('id')->paginate(10)->withQueryString(),
        ]);
    }

    // CREATE FORM (GET)
    public function create()
    {
        Gate::authorize('create', ServiceRequest::class);
        return view('requests.create');
    }

    // CREATE (POST)
    public function store(Request $request)
    {
        Gate::authorize('create', ServiceRequest::class);

        $validated = $request->validate([
            'item_name' => ['required', 'string', 'max:150'],
            'quantity'  => ['required', 'integer', 'min:1', 'max:1000000'],
            'purpose'   => ['required', 'string', 'max:2000'],

            // Students must never send these:
            'user_id'         => ['prohibited'],
            'status'          => ['prohibited'],
            'is_admin'        => ['prohibited'],
            'role'            => ['prohibited'],
            'requester_name'  => ['prohibited'],
            'requester_email' => ['prohibited'],
        ]);

        $user = $request->user();

        // Explicit allowlist: only the three validated fields...
        $serviceRequest = new ServiceRequest([
            'item_name' => $validated['item_name'],
            'quantity'  => $validated['quantity'],
            'purpose'   => $validated['purpose'],
        ]);

        // ...and trusted values come from the signed-in account on the server.
        $serviceRequest->user_id         = $user->id;
        $serviceRequest->requester_name  = $user->name;
        $serviceRequest->requester_email = $user->email;
        $serviceRequest->status          = 'pending';
        $serviceRequest->save();

        return redirect()->route('requests.show', $serviceRequest)
                         ->with('status', 'Request submitted.');
    }

    // VIEW ONE (GET)
    public function show(ServiceRequest $serviceRequest)
    {
        Gate::authorize('view', $serviceRequest);
        return view('requests.show', ['r' => $serviceRequest]);
    }

    // UPDATE STATUS (PATCH)
    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        Gate::authorize('updateStatus', $serviceRequest); // before ANY database write

        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', ServiceRequest::STATUSES)],
        ]);

        $serviceRequest->status = $validated['status']; // only this column changes
        $serviceRequest->save();

        return back()->with('status', 'Status updated.');
    }
}