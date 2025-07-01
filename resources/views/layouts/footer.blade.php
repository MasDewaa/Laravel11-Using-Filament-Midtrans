@extends('dashboard')
@section('footer')
<footer class="bg-white shadow">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{ route('dashboard') }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logoo.svg') }}" class="h-8" alt="NeXa Reach" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">NeXa Reach</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0">
                <li><a href="{{ route('dashboard') }}" class="hover:underline me-4 md:me-6">Home</a></li>
                <li><a href="{{ route('dashboard#tentangkami') }}" class="hover:underline me-4 md:me-6">Tentang Kami</a></li>
                <li><a href="{{ route('dashboard#katalog') }}" class="hover:underline me-4 md:me-6">Katalog</a></li>
                <li><a href="{{ route('transaksi.index') }}" class="hover:underline">Transaksi</a></li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center">© 2024 <a href="{{ route('dashboard') }}" class="hover:underline">NeXa Reach</a>. All Rights Reserved.</span>
    </div>
</footer>
@endsection