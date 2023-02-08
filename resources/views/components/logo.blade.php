<a href="{{ route('admin.dashboard') }}" {{ $attributes->merge(['class' => 'flex ']) }}>
    <img alt="{{ config('app.name', 'Laravel') }} Logo" class="w-6" src="{{ asset('temp/images/logo.svg') }}">
    {{ $slot }}
</a>
