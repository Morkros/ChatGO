<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $username = '';
    public string $email = '';
    public string $language = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'language' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Language -->
        <div>
            <x-input-label for="language" :value="__('Language')" />
            <select wire:model="language" id="language" name="language" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="" disabled selected>{{ __('Select a language') }}</option>
                <option value="EN-GB">{{ __('English - British (EN-GB)') }}</option>
                <option value="EN-US">{{ __('English - American (EN-US)') }}</option>
                <option value="ES">{{ __('Español (ES)') }}</option>
                <option value="AR">{{ __('عربي (AR)') }}</option>
                <option value="BG">{{ __('български (BG)') }}</option>
                <option value="CS">{{ __('čeština (CS)') }}</option>
                <option value="DA">{{ __('dansk (DA)') }}</option>
                <option value="DE">{{ __('Deutsch (DE)') }}</option>
                <option value="FR">{{ __('Français (FR)') }}</option>
                <option value="EL">{{ __('ελληνικά (EL)') }}</option>
                <option value="ET">{{ __('eesti keel (ET)') }}</option>
                <option value="FI">{{ __('suomalainen (FI)') }}</option>
                <option value="HU">{{ __('magyar (HU)') }}</option>
                <option value="ID">{{ __('Indonesia (ID)') }}</option>
                <option value="IT">{{ __('Italiano (IT)') }}</option>
                <option value="JA">{{ __('日本語 (JA)') }}</option>
                <option value="KO">{{ __('한국인 (KO)') }}</option>
                <option value="LT">{{ __('lietuvių (LT)') }}</option>
                <option value="LV">{{ __('latviski (LV)') }}</option>
                <option value="NB">{{ __('norsk bokmål (NB)') }}</option>
                <option value="NL">{{ __('Nederlands (NL)') }}</option>
                <option value="PL">{{ __('Polski (PL)') }}</option>
                <option value="PT-BR">{{ __('Português - Brasileiro (PT-BR)') }}</option>
                <option value="PT-PT">{{ __('Português (PT-PT)') }}</option>
                <option value="RO">{{ __('română (RO)') }}</option>
                <option value="RU">{{ __('Русский (RU)') }}</option>
                <option value="SK">{{ __('slovenský (SK)') }}</option>
                <option value="SL">{{ __('slovenski (SL)') }}</option>
                <option value="SV">{{ __('svenska (SV)') }}</option>
                <option value="TR">{{ __('Türkçe (TR)') }}</option>
                <option value="UK">{{ __('українська (UK)') }}</option>
                <option value="ZH-HANS">{{ __('中文 - 简体 (ZH-HANS)') }}</option>
                <option value="ZH-HANT">{{ __('中文 - 繁体 (ZH-HANT)') }}</option>
            </select>
            <x-input-error :messages="$errors->get('language')" class="mt-2" />
        </div>
        

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
