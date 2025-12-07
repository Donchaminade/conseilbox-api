<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Facades\Filament;

class Login extends Component
{
    public string $code = '';

    public function login()
    {
        if ($this->code !== 'IrokouKaizen@') {
            $this->addError('code', 'Code incorrect.');
            return;
        }

        $user = User::first();

        if (! $user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@conseilbox.com',
                'password' => Hash::make(str()->random(12)),
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended(Filament::getHomeUrl());
    }

    public function render()
    {
        return view('livewire.login')->layout('vendor.filament-panels.components.layout.simple');
    }
}
