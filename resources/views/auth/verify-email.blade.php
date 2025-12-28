<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Verify Your Email Address') }}</h2>
        <p class="text-gray-600 dark:text-gray-400">
            {{ __('Please verify your email to continue. We just sent a secure link to your inbox. If you didn\'t receive it, we can send you another one.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div
            class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 p-4 rounded-lg border border-green-200 dark:border-green-800">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="flex-1">
            @csrf

            <button type="submit"
                class="w-full justify-center inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>