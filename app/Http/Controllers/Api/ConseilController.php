<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConseilRequest;
use App\Http\Resources\ConseilResource;
use App\Models\Conseil;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConseilController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'status' => ['nullable', 'in:' . implode(',', Conseil::STATUSES)],
            'location' => ['nullable', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
            'search' => ['nullable', 'string', 'max:255'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
            'order' => ['nullable', 'in:latest,oldest,random'],
        ]);

        $query = Conseil::query();

        $status = $validated['status'] ?? Conseil::STATUS_PUBLISHED;
        $query->where('status', $status);

        if (! empty($validated['location'])) {
            $query->where('location', 'like', '%' . $validated['location'] . '%');
        }

        if (! empty($validated['author'])) {
            $query->where('author', 'like', '%' . $validated['author'] . '%');
        }

        if (! empty($validated['search'])) {
            $query->where(function ($builder) use ($validated): void {
                $builder
                    ->where('title', 'like', '%' . $validated['search'] . '%')
                    ->orWhere('content', 'like', '%' . $validated['search'] . '%')
                    ->orWhere('anecdote', 'like', '%' . $validated['search'] . '%');
            });
        }

        $order = $validated['order'] ?? 'latest';
        if ($order === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($order === 'random') {
            $query->inRandomOrder();
        } else {
            $query->orderByDesc('created_at');
        }

        $perPage = $validated['per_page'] ?? 15;

        return ConseilResource::collection(
            $query->paginate($perPage)->withQueryString()
        );
    }

    public function show(Conseil $conseil): ConseilResource
    {
        if ($conseil->status !== Conseil::STATUS_PUBLISHED) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return new ConseilResource($conseil);
    }

    public function store(StoreConseilRequest $request)
    {
        $data = $request->validated();
        $data['status'] = Conseil::STATUS_PENDING;

        $conseil = Conseil::create($data);

        return (new ConseilResource($conseil))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}

