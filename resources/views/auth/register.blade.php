<x-guest-layout>
    <section class="relative table w-full py-36 lg:py-44">
        <div class="container">
            <div class="flex justify-center">
                <div
                    class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">

                    <a href="{{ route('homepage') }}">
                        <img src="{{ asset('images/logo.png') }}" class="mx-auto" />
                    </a>

                    <x-errors />

                    <h5 class="my-6 text-xl font-semibold">{{ __('Register') }}</h5>

                    <form class="text-left" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="grid grid-cols-1">
                            <div class="mb-4">
                                <x-input label="{{ __('Name') }}" name="name" placeholder="Your Name"
                                    type="text" required autofocus />
                            </div>

                            <div class="mb-4">
                                <x-input label="{{ __('Email') }}" name="email" placeholder="name@example.com"
                                    type="email" required />
                            </div>

                            <div class="mb-4">
                                <x-inputs.password label="{{ __('Password') }}" name="password" required />
                            </div>

                            <div class="mb-4">
                                <x-inputs.password label="{{ __('Confirm Password') }}" name="password_confirmation"
                                    required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                    href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <button type="submit"
                                    class="ml-4 text-white bg-indigo-600 border-indigo-600 rounded-md btn hover:bg-indigo-700 hover:border-indigo-700">
                                    {{ __('Register') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
