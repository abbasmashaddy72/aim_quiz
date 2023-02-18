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

                    <h5 class="my-6 text-xl font-semibold">{{ __('Reset Password') }}</h5>

                    <form class="text-left" method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="grid grid-cols-1">
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
                                <button type="submit"
                                    class="ml-4 text-white bg-indigo-600 border-indigo-600 rounded-md btn hover:bg-indigo-700 hover:border-indigo-700">
                                    {{ __('Reset Password') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
