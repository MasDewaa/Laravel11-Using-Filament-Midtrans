<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexa Reach</title>
    <link rel="icon" href="{{ asset('images/logoo.svg') }}">
    @vite('resources/css/app.css') <!-- Ganti dengan path CSS Anda -->
</head>

<body class="bg-gray-200">
<header>
    <nav class="py-2.5">
        <div class="flex flex-wrap justify-between items-center max-w-screen-xl mx-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('images/logoo.svg') }}" class="mr-3 h-6 sm:h-9" alt="NeXa Reach" />
                <span class="self-center text-xl font-semibold whitespace-nowrap">Nexa Reach</span>
            </a>

            <!-- Mobile menu button -->
            <div class="lg:hidden flex items-center">
                <button type="button" class="text-gray-700 hover:text-primary-700" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5h14a1 1 0 110 2H3a1 1 0 110-2zM3 9h14a1 1 0 110 2H3a1 1 0 110-2zM3 13h14a1 1 0 110 2H3a1 1 0 110-2z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Navbar Menu for larger screens -->
            <div class="hidden lg:flex items-center space-x-4 lg:space-x-10">
                
                @guest
                <!-- Buttons for non-authenticated users -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-900 bg-gray border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">Register</a>
                </div>
                @endguest

                @auth
                <!-- Dropdown for authenticated users -->
                <div class="relative">
                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-50 hover:rounded-xl" id="menu-button" aria-expanded="false" aria-haspopup="true">
                        <img src="{{ asset('images/profile.svg') }}" alt="Profile" class="w-8 h-8 rounded-full mr-2">
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        <svg class="w-5 h-5 ml-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div class="hidden absolute right-0 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5" id="user-dropdown" role="menu" aria-orientation="vertical" aria-labelledby="menu-button">
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700">Account settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full block px-4 py-2 text-left text-sm text-gray-700">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="lg:hidden" id="mobile-menu" style="display: none;">
        <ul class="space-y-4 py-4 px-6 bg-gray-100">
            <!-- User Profile or Login/Register options -->
            @auth
            <!-- Dropdown for authenticated users -->
            <li>
                <div class="relative">
                    <button type="button" class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50 rounded-lg focus:outline-none" id="mobile-user-dropdown-button">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('images/profile.svg') }}" alt="Profile" class="w-6 h-6 rounded-full">
                            <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Mobile dropdown menu -->
                    <div class="hidden absolute left-0 mt-2 w-full origin-top-right bg-white shadow-lg ring-1 ring-black/5 rounded-md z-50" id="mobile-user-dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="mobile-user-dropdown-button">
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700">Account settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full block px-4 py-2 text-left text-sm text-gray-700">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @endauth

            @guest
            <li class="flex space-x-4">
                <a href="{{ route('login') }}" class="flex-1 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Login</a>
                <a href="{{ route('register') }}" class="flex-1 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Register</a>
            </li>
            @endguest
        </ul>
    </div>

</header>


<main>

<section class="bg-cover bg-center h-screen bg-blend-darken" style="background-image: url('{{ asset('https://img.freepik.com/free-vector/black-background-with-focus-spot-light_1017-27230.jpg') }}');">
    <div class="bg-transparent h-full flex justify-center items-center">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
            <!-- Judul Utama -->
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-green-500 md:text-5xl lg:text-6xl dark:text-green-500">
                <span class="text-green-600">Ne</span><span class="text-white">xa</span> Reach
            </h1>
            <!-- Sub Judul -->
            <h2 class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-white md:text-3xl lg:text-4xl dark:text-white">
                Tingkatkan Bisnis Sosial Media Anda Secara Mudah.
            </h2>
            <!-- Deskripsi -->
            <p class="mb-8 text-lg font-normal text-yellow-100 lg:text-xl sm:px-16 lg:px-48">
                Solusi lengkap untuk membantu Anda dalam meningkatkan kehadiran brand media sosial Instagram dan Tiktok dengan strategi yang terbukti efektif.
            </p>
            <a href="#cobanya" class="inline-block px-8 py-3 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-200">
                Coba Nexa Reach Sekarang!
            </a>
        </div>
    </div>
</section>

<!-- What is Nexa Reach? Section -->
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

<!-- Fitur Section -->
<section id="fitur" class="py-16 bg-gray-100">
    <div class="max-w-screen-xl mx-auto px-4">
        <h2 class="text-4xl font-extrabold mb-8 text-center text-gray-800">Fitur Unggulan Nexa Reach</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg">
                <img src="https://lh3.googleusercontent.com/36vuyuzHWmerzTcKs0UAr7LcH3ppPm2P4vJiyP9kBtpmm6OKohgUK9WU1IgJ7GYlpoeHuF0SxQmu700y31EnIPOlQKo_845W4tIze7tIanPjJb7voj9H1myAONrJN3UHdE0uiN1DVh4fOihITZ_AYNA" alt="Content Management" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-lg font-bold">Manajemen Sosial Media</h3>
                    <p class="mt-2 text-gray-300">Kelola semua akun media sosial kamu tanpa ribet! Dari jadwal posting sampai kampanye iklan, kami bikin semuanya lebih gampang dan sesuai kebutuhan brand kamu. Tinggal fokus ngembangin bisnis, sisanya serahin ke kami!</p>
                </div>
            </div>
            <div class="relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg">
                <img src="https://cdn.prod.website-files.com/655e0fa544c67c1ee5ce01c7/655e0fa544c67c1ee5ce0f19_a-guide-to-facebook-and-instagram-ads-for-musicians-header.webp" alt="Order Ads Services" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-lg font-bold">Manajemen Konten Instagram</h3>
                    <p class="mt-2 text-gray-300">Bikin Instagram bisnis kamu jadi lebih kece dan menarik perhatian! Kami siap bantu kamu bikin konten yang nggak cuma keren, tapi juga efektif buat promosi produk dan layanan kamu biar makin banyak yang kepo dan beli.</p>
                </div>
            </div>
            <div class="relative bg-gray-800 text-white rounded-lg overflow-hidden shadow-lg">
                <img src="https://adflex.io/wp-content/uploads/2022/08/tiktok-ads-step-by-step-guide.jpg" alt="Strategy & Analytics" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-lg font-bold">Manajemen Konten TikTok</h3>
                    <p class="mt-2 text-gray-300">Yuk, viral bareng TikTok! Kami bakal bantu kamu bikin konten yang fun, kreatif, dan sesuai tren, biar audiens makin betah scroll dan kampanye kamu jadi booming.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Testimonial Section -->
<section id="testimoni" class="bg-gray-100 py-16">
    <div class="max-w-screen-xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-extrabold mb-8">Testimoni Pengguna</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <figure class="max-w-screen-md mx-auto text-center">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
                    </svg>
                    <blockquote>
                        <p class="text-2xl italic font-medium text-gray-900 dark:text-white">"Sejak menggunakan layanan Nexa Reach, interaksi di media sosial bisnis kami meningkat pesat. Konten yang mereka buat selalu relevan dan menarik perhatian audiens kami."</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3 rtl:space-x-reverse">
                    <svg class="w-6 h-6 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 50 50">
                            <circle cx="25" cy="25" r="12" fill="#9CA3AF" />
                        </svg>
                        <div class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-500 dark:divide-gray-700">
                            <cite class="pe-3 font-medium text-gray-900 dark:text-white">Zulfikar Al Rasyid</cite>
                            <cite class="ps-3 text-sm text-gray-500 dark:text-gray-400">Web Developer at Microsoft</cite>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <figure class="max-w-screen-md mx-auto text-center">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
                    </svg>
                    <blockquote>
                        <p class="text-2xl italic font-medium text-gray-900 dark:text-white">"Dengan Nexa Reach, semua jadi lebih mudah. Dari perencanaan hingga eksekusi konten, semuanya dikerjakan profesional. Bisnis kami pun berkembang pesat!"</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3 rtl:space-x-reverse">
                        <svg class="w-6 h-6 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 50 50">
                            <circle cx="25" cy="25" r="12" fill="#9CA3AF" />
                        </svg>
                        <div class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-500 dark:divide-gray-700">
                            <cite class="pe-3 font-medium text-gray-900 dark:text-white">Mahbub Faisal</cite>
                            <cite class="ps-3 text-sm text-gray-500 dark:text-gray-400">Social Media Strategist at Meta</cite>
                        </div>
                    </figcaption>
                </figure>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <figure class="max-w-screen-md mx-auto text-center">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
                    </svg>
                    <blockquote>
                        <p class="text-2xl italic font-medium text-gray-900 dark:text-white">"Hasilnya luar biasa! Nexa Reach tidak hanya membuat konten menarik, tetapi juga meningkatkan engagement dan loyalitas pelanggan secara nyata."</p>
                    </blockquote>
                    <figcaption class="flex items-center justify-center mt-6 space-x-3 rtl:space-x-reverse">
                        <svg class="w-6 h-6 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 50 50">
                            <circle cx="25" cy="25" r="12" fill="#9CA3AF" />
                        </svg>
                        <div class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-500 dark:divide-gray-700">
                            <cite class="pe-3 font-medium text-gray-900 dark:text-white">Mifta Aulia</cite>
                            <cite class="ps-3 text-sm text-gray-500 dark:text-gray-400">Marketing Specialist at Tiktok</cite>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="my-20">
    <div class="container mx-auto p-5">
        <h2 class="text-4xl font-extrabold mb-8 text-center text-gray-800">Pertanyaan Umum (FAQ)</h2>
        <div class="border-5 border-cyan-600 w-52 sm:w-[500px] mx-auto"></div>
        <div id="accordion-color" data-accordion="collapse" class="mt-20">
            <!-- FAQ 1 -->
            <h2 id="accordion-color-heading-1">
                <button type="button"
                    class="flex items-center justify-between p-5 w-full font-medium text-left border border-gray-200 rounded-t-xl"
                    data-accordion-target="#accordion-color-body-1" aria-expanded="false"
                    aria-controls="accordion-color-body-1">
                    <span>Apa itu Nexa Reach?</span>
                    <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
                <div class="p-5 border border-gray-200 dark:border-gray-700 border-b-0">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Nexa Reach adalah platform layanan pemasaran media sosial yang dirancang untuk membantu UMKM (Usaha Mikro Kecil dan Menengah) serta personal brand dalam meningkatkan visibilitas dan keterlibatan di berbagai kanal media sosial. Dengan Nexa Reach, Anda dapat mengelola kampanye pemasaran, membuat konten menarik, dan menjangkau lebih banyak audiens potensial dengan mudah.</p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <h2 id="accordion-color-heading-2">
                <button type="button"
                    class="flex items-center justify-between p-5 w-full font-medium text-left border border-gray-200 rounded-t-xl"
                    data-accordion-target="#accordion-color-body-2" aria-expanded="false"
                    aria-controls="accordion-color-body-2">
                    <span>Siapa target pengguna Nexa Reach?</span>
                    <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-color-body-2" class="hidden" aria-labelledby="accordion-color-heading-2">
                <div class="p-5 border border-gray-200 dark:border-gray-700 border-b-0">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Nexa Reach ditujukan untuk UMKM yang ingin memaksimalkan potensi pemasaran melalui media sosial, serta individu yang membangun personal brand dan ingin menjangkau lebih banyak audiens dengan strategi pemasaran yang efektif dan efisien.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <h2 id="accordion-color-heading-3">
                <button type="button"
                    class="flex items-center justify-between p-5 w-full font-medium text-left border border-gray-200 rounded-t-xl"
                    data-accordion-target="#accordion-color-body-3" aria-expanded="false"
                    aria-controls="accordion-color-body-3">
                    <span>Fitur-fitur apa saja yang tersedia di Nexa Reach?</span>
                    <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-color-body-3" class="hidden" aria-labelledby="accordion-color-heading-3">
                <div class="p-5 border border-gray-200 dark:border-gray-700 border-t-0">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Nexa Reach menawarkan berbagai fitur yang mendukung pemasaran media sosial, seperti pembuatan dan jadwal posting konten, analisis kinerja kampanye, manajemen akun sosial, serta rekomendasi strategi yang disesuaikan dengan kebutuhan bisnis Anda.</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <h2 id="accordion-color-heading-4">
                <button type="button"
                    class="flex items-center justify-between p-5 w-full font-medium text-left border border-gray-200 rounded-t-xl"
                    data-accordion-target="#accordion-color-body-4" aria-expanded="false"
                    aria-controls="accordion-color-body-4">
                    <span>Apakah Nexa Reach mudah digunakan?</span>
                    <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-color-body-4" class="hidden" aria-labelledby="accordion-color-heading-4">
                <div class="p-5 border border-gray-200 dark:border-gray-700 border-t-0">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Tentu! Nexa Reach dirancang dengan antarmuka yang intuitif dan user-friendly, sehingga mudah digunakan oleh pemilik bisnis maupun individu tanpa perlu keahlian teknis yang mendalam.</p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <h2 id="accordion-color-heading-5">
                <button type="button"
                    class="flex items-center justify-between p-5 w-full font-medium text-left border border-gray-200 rounded-t-xl"
                    data-accordion-target="#accordion-color-body-5" aria-expanded="false"
                    aria-controls="accordion-color-body-5">
                    <span>Bagaimana cara memulai menggunakan Nexa Reach?</span>
                    <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-color-body-5" class="hidden" aria-labelledby="accordion-color-heading-5">
                <div class="p-5 border border-gray-200 dark:border-gray-700 border-t-0">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">Untuk memulai, cukup kunjungi situs Nexa Reach, buat akun, dan jelajahi berbagai fitur yang tersedia. Anda dapat segera membuat kampanye pertama dan memanfaatkan semua keunggulan platform ini untuk memperluas jangkauan media sosial bisnis Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    
<!-- Call to Action -->
<section id="cobanya" class="py-16 bg-gray-100">
    <div class="max-w-screen-xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-extrabold mb-8">Bergabunglah dengan Nexa Reach</h2>
        <p class="mb-4 text-lg font-normal text-gray-500">Bergabunglah dengan Nexa Reach sekarang dan mulailah perjalanan brand anda menuju kesuksesan digital!</p>
        <a href="{{ route('register') }}" class="inline-block px-8 py-3 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-200">
            Daftar Sekarang
        </a>
    </div>
</section>



<script>
    document.addEventListener('DOMContentLoaded', () => {
    const accordions = document.querySelectorAll('[data-accordion="collapse"]');

    accordions.forEach(accordion => {
        const headers = accordion.querySelectorAll('h2 button');

        headers.forEach(header => {
            header.addEventListener('click', () => {
                const target = document.querySelector(header.getAttribute('data-accordion-target'));
                const isExpanded = header.getAttribute('aria-expanded') === 'true';

                header.setAttribute('aria-expanded', !isExpanded);
                target.classList.toggle('hidden');

                if (isExpanded) {
                    target.setAttribute('aria-hidden', 'true');
                } else {
                    target.removeAttribute('aria-hidden');
                }
            });
        });
    });
});

</script>

   
</main>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const userDropdownButton = document.getElementById('menu-button');
        const userDropdownMenu = document.getElementById('user-dropdown');
        const mobileUserDropdownButton = document.getElementById('mobile-user-dropdown-button');
        const mobileUserDropdownMenu = document.getElementById('mobile-user-dropdown-menu');

        // Toggle mobile menu visibility
        mobileMenuButton.addEventListener('click', function () {
            mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Toggle user dropdown menu on click
        userDropdownButton.addEventListener('click', function () {
            userDropdownMenu.classList.toggle('hidden');
        });

        mobileUserDropdownButton.addEventListener('click', function () {
            mobileUserDropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown menu when clicking outside
        document.addEventListener('click', function (event) {
            if (!userDropdownMenu.contains(event.target) && !userDropdownButton.contains(event.target)) {
                userDropdownMenu.classList.add('hidden');
            }
            if (!mobileUserDropdownMenu.contains(event.target) && !mobileUserDropdownButton.contains(event.target)) {
                mobileUserDropdownMenu.classList.add('hidden');
            }
        });
    });
</script>

</body>
</html>