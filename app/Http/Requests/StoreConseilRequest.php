<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConseilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'anecdote' => ['nullable', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'social_link_1' => ['nullable', 'url', 'max:255'],
            'social_link_2' => ['nullable', 'url', 'max:255'],
            'social_link_3' => ['nullable', 'url', 'max:255'],
        ];
    }
}

