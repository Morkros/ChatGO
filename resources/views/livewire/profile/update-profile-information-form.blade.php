<?php

use App\Models\User;
use App\Models\Contact;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $username = '';
    public string $email = '';
    public string $language = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        // dd(Auth::user());
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
        $this->language = Auth::user()->language;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'language' => ['required' , 'string'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        //dd($user,$this->username);
        $user->save();

        $this->dispatch('profile-updated', username: $user->username);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="username" :value="__('Name')" />
            <x-text-input wire:model="username" id="username" name="username" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

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
            <x-input-error class="mt-2" :messages="$errors->get('language')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
