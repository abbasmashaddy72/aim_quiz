<x-guest-layout>
    <section class="relative table w-full py-36 lg:py-44">

        <div class="container">
            <div class="flex justify-center">
                <div
                    class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">

                    <a href="{{ route('homepage') }}">
                        <img src="{{ asset('images/logo.png') }}" class="mx-auto" />
                    </a>

                    <h5 class="my-6 text-xl font-semibold">{{ __('Reset Password') }}</h5>

                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <form class="text-left" method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="ml-4 text-white bg-indigo-600 border-indigo-600 rounded-md btn hover:bg-indigo-700 hover:border-indigo-700">
                                {{ __('Resend Verification Email') }}</button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
