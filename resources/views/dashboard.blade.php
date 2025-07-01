@extends('layouts/navigation')
@section('content')

<section class="bg-cover bg-center h-screen bg-blend-darken" style="background-image: url('{{ asset('https://img.freepik.com/free-vector/black-background-with-focus-spot-light_1017-27230.jpg') }}');">
    <div class="bg-transparent h-full flex justify-center items-center">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
            <!-- Judul Utama -->
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-green-500 md:text-5xl lg:text-6xl dark:text-green-500">
                <span class="text-green-600">Ne</span><span class="text-white">xa</span> Reach.
            </h1>
            <!-- Sub Judul -->
            <h2 class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-white md:text-3xl lg:text-4xl dark:text-white">
            Tingkatkan Bisnis Sosial Media Anda Secara Mudah.
            </h2>
            <!-- Deskripsi -->
            <p class="mb-8 text-lg font-normal text-yellow-100 lg:text-xl sm:px-16 lg:px-48">
            Solusi lengkap untuk membantu Anda dalam meningkatkan kehadiran brand media sosial Instagram dan Tiktok dengan strategi yang terbukti efektif.
            </p>
            <!-- Bagian Statistik -->
            <div class="mt-12 sm:mt-24 flex flex-col sm:flex-row justify-center gap-8 sm:gap-12">
                <div class="text-white text-lg">
                    <p class="font-semibold text-2xl sm:text-3xl md:text-4xl">&gt;10.000</p>
                    <p class="text-yellow-100 text-sm sm:text-lg md:text-xl">Promoted</p>
                </div>
                <div class="text-white text-lg">
                    <p class="font-semibold text-2xl sm:text-3xl md:text-4xl">&gt;47.000</p>
                    <p class="text-yellow-100 text-sm sm:text-lg md:text-xl">Followers Increase</p>
                </div>
                <div class="text-white text-lg">
                    <p class="font-semibold text-2xl sm:text-3xl md:text-4xl">&gt;30.000</p>
                    <p class="text-yellow-100 text-sm sm:text-lg md:text-xl">Loyal Customers</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tentangkami" class="py-16">
    <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
        <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Bukti nyata Nexa Reach emang jago bikin konten!</h2>
            <p class="mb-4">Nexa Reach sudah terbukti membantu banyak bisnis tumbuh lebih besar dan mendapatkan exposure yang luar biasa di media sosial. Dengan pendekatan yang kreatif dan strategi yang tepat, kami memastikan setiap konten yang kami buat mampu menarik perhatian audiens.</p>
            <p class="mb-4">Sebagai penyedia jasa konten media sosial, kami paham pentingnya membuktikan kualitas. Makanya, sebelum bantuin klien, kami duluan yang bikin konten keren untuk akun kami sendiri. Hasilnya? Views dan interaksinya selalu rame banget!</p>
            <p class="mb-4">Jangan cuma percaya kata-kata, langsung cek aja akun @nexareach di Instagram atau TikTok. Di sana, kamu bisa lihat sendiri gimana kami menciptakan konten yang seru, engaging, dan bikin audiens terus stay tuned!</p>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-8">
        <img class="mt-4 w-full lg:mt-10 rounded-lg" src="https://zyda.com/hubfs/Screen%20Shot%202022-12-07%20at%201.00.35%20PM.png" alt="design content 1">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="https://i0.wp.com/shipper.id/wp-content/uploads/2023/08/Benefit-menggunakan-TikTok-Ads-untuk-Bisnis-Kamu-scaled-1.webp?fit=1920%2C1601&ssl=1" alt="design content 2">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="https://alan.co.id/wp-content/uploads/2023/02/23.-mengenal-tiktok-ads-ladang-promosi-scaled.webp" alt="design content 3">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="https://i0.wp.com/blog.velocity.in/wp-content/uploads/2022/02/Blog-Cover-Image-2-How-to-design-Instagram-ads-01.jpg?fit=1200%2C900&ssl=1" alt="design content 4">
        </div>
    </div>
</section>

<section id="katalog" class="h-screen mb-10">
    <div class="bg-transparent h-full flex justify-center items-center">
        <div class="py-8 px-6 mx-auto max-w-screen-xl text-center lg:py-16">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white">Pilihan Katalog yang Tersedia</h1>
            <p class="text-lg text-gray-500 dark:text-gray-400 mt-4">
            Di Nexa Reach, kami membantu bisnis seperti Anda untuk berkembang di media sosial. Kami menyediakan layanan branding yang dibuat khusus, membantu Anda menciptakan konten menarik dan membangun identitas online yang unik. Semua ini kami lakukan untuk memastikan bisnis Anda terus tumbuh dan memberikan dampak positif dalam jangka panjang!
            </p>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8" id="katalog-items">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($katalog as $item)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 flex flex-col justify-between h-full">
                        <div>
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-full h-64 object-cover mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $item->nama }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $item->deskripsi }}</p>
                        </div>
                        <p class="text-xl font-bold text-gray-900 dark:text-white mt-auto">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                        <form action="{{ route('katalog.detail', $item->id) }}" method="GET" class="mt-4">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex justify-center items-center w-full py-2 px-5 text-base font-medium text-center text-white rounded-lg bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-900">
                                Lihat Detail
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="bg-white shadow">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="{{ route('dashboard') }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logoo.svg') }}" class="h-8" alt="NeXa Reach" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Nexa Reach</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0">
                <li><a href="{{ route('dashboard') }}" class="hover:underline me-4 md:me-6">Beranda</a></li>
                <li><a href="{{ route('dashboard#tentangkami') }}" class="hover:underline me-4 md:me-6">Tentang Kami</a></li>
                <li><a href="{{ route('dashboard#katalog') }}" class="hover:underline me-4 md:me-6">Katalog</a></li>
                <li><a href="{{ route('transaksi.index') }}" class="hover:underline">Transaksi</a></li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center">©️ 2024 <a href="{{ route('dashboard') }}" class="hover:underline">Nexa Reach</a>. Privacy Policy.</span>
    </div>
</footer>

@endsection