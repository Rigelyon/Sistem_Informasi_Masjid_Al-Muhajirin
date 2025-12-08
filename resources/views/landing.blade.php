<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Al-Muhajirin</title>
    <meta name="description"
        content="Masjid Al-Muhajirin - Komunitas yang bersatu dalam iman, kasih sayang, dan pelayanan. Bergabunglah dengan kami untuk sholat harian, kelas Quran, dan program komunitas. Melayani sejak 1995.">
    <meta name="keywords" content="masjid, Islamic center, jadwal sholat, kelas Quran, komunitas Muslim, masjid Jakarta">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/landing.css', 'resources/js/landing.js'])
</head>

<body class="bg-white text-gray-900">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <span class="text-2xl">
                            <img src="{{ asset('img/logo-masjid.png') }}" class="h-100 w-100">
                        </span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Masjid Al-Muhajirin</h1>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#home"
                        class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-islamic-green transition-colors">Beranda</a>

                    <!-- Dropdown untuk Tentang -->
                    <div class="relative group">
                        <button
                            class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-islamic-green transition-colors flex items-center">
                            Tentang
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-200">
                            <div class="py-2">
                                <a href="#tentang"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Tentang
                                    Masjid</a>
                                <a href="#struktur"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Struktur
                                    Organisasi</a>
                                <a href="#galeri"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Galeri</a>
                            </div>
                        </div>
                    </div>

                    <a href="#jadwal-sholat"
                        class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-islamic-green transition-colors">Jadwal
                        Sholat</a>
                    <a href="#aktivitas"
                        class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-islamic-green transition-colors">Aktivitas</a>

                    <!-- Auth Links -->
                    @if (Route::has('login'))
                        <div class="ml-4 flex items-center space-x-2">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="px-4 py-2 text-sm font-medium text-white bg-islamic-green rounded-lg hover:bg-islamic-green-light transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="px-6 py-2 text-sm font-medium text-white bg-islamic-green rounded-full hover:bg-islamic-green-light transition-colors shadow-md hover:shadow-lg">Masuk</a>
                            @endauth
                        </div>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-2">
                    <a href="#home"
                        class="px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Beranda</a>

                    <!-- Dropdown untuk Tentang (Mobile) -->
                    <div class="relative">
                        <button id="mobile-tentang-btn"
                            class="w-full text-left px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors flex items-center justify-between">
                            Tentang
                            <svg id="mobile-tentang-icon" class="w-4 h-4 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="mobile-tentang-menu" class="hidden pl-6 mt-2 space-y-2">
                            <a href="#tentang"
                                class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Tentang
                                Masjid</a>
                            <a href="#struktur"
                                class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Struktur
                                Organisasi</a>
                            <a href="#galeri"
                                class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Galeri</a>
                        </div>
                    </div>

                    <a href="#jadwal-sholat"
                        class="px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Jadwal Sholat</a>
                    <a href="#aktivitas"
                        class="px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Aktivitas</a>

                    <!-- Mobile Auth Links -->
                    @if (Route::has('login'))
                        <div class="pt-2 border-t border-gray-200">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="px-6 py-2 text-sm font-medium text-white bg-islamic-green rounded-full hover:bg-islamic-green-light transition-colors shadow-md hover:shadow-lg">Masuk</a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative h-screen flex items-center justify-center overflow-hidden">

        <div id="slideshow-bg" class="absolute inset-0">

            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-100 z-0"
                style="background-image: url({{ asset('img/bg1.jpg') }})">
            </div>

            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0 z-[-1]"
                style="background-image: url({{ asset('img/bg2.jpg') }})">
            </div>

            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0 z-[-1]"
                style="background-image: url({{ asset('img/bg3.jpg') }})">
            </div>
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0 z-[-1]"
                style="background-image: url({{ asset('img/bg4.jpg') }})">
            </div>
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0 z-[-1]"
                style="background-image: url({{ asset('img/bg5.jpg') }})">
            </div>
        </div>

        <div class="absolute inset-0 hero-overlay"></div>

        <div class="relative z-10 container mx-auto px-4 text-center text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Selamat Datang di Masjid Al-Muhajirin
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto opacity-95">
                Mewujudkan sarana ibadah yang nyaman dan khusyuk, serta mempererat Ukhuwah Islamiyah dalam menggapai
                ridha Allah SWT
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#jadwal-sholat"
                    class="inline-block bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white hover:bg-white/20 font-semibold text-lg px-8 py-3 rounded-full transition-colors">
                    Jadwal Sholat Hari Ini
                </a>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-20 bg-white scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Tentang Masjid </h2>
                    <div class="space-y-4 text-lg text-gray-600">
                        <p>
                            Riwayat berdirinya Masjid Al-Muhajirin bermula seiring dengan pembangunan Perumahan
                            Tamanjaya Indah
                            pada tahun 1990-an di bawah naungan Yayasan ASABRI. Awalnya didirikan untuk memenuhi
                            kebutuhan ibadah
                            anggota TNI yang bertugas di Tasikmalaya, masjid ini kini telah berkembang melayani
                            masyarakat umum
                            sejalan dengan mobilitas dan pertumbuhan penduduk di lingkungan tersebut.
                        </p>
                        <p>
                            Berawal dari bangunan sederhana, masjid ini mengalami renovasi besar sejak tahun 2005 untuk
                            mengakomodasi kebutuhan jemaah yang terus bertambah. Saat ini, masjid diproyeksikan mampu
                            menampung
                            700 hingga 1.000 jemaah. Selain fungsi utamanya sebagai tempat ibadah dan sekretariat DKM,
                            kami juga
                            menyediakan fasilitas pendidikan Madrasah Diniyah Awaliyah (MDA) di lantai dasar, serta
                            fasilitas
                            sosial berupa garasi ambulans untuk melayani umat dan kegiatan santunan yatim piatu.
                        </p>
                    </div>
                    <div class="mt-8 space-y-4">
                        <div class="p-6 bg-islamic-green-lighter rounded-xl border border-islamic-green/20">
                            <h3 class="text-xl font-bold mb-2 text-islamic-green">Visi Kami</h3>
                            <p class="text-gray-600">
                            <p class="font-bold">"Genah, Betah, Tuma'ninah Dina Ngalaksanakeun Ibadah." </p>
                            Mewujudkan masjid sebagai tempat yang nyaman, penuh kekeluargaan, dan menenangkan hati,
                            sehingga setiap jemaah dapat merasakan kekhusukan dalam beribadah kepada Allah SWT.
                            </p>
                        </div>
                        <div class="p-6 bg-islamic-green-lighter rounded-xl border border-islamic-green/20">
                            <h3 class="text-xl font-bold mb-2 text-islamic-green">Misi Kami</h3>
                            <div class="text-gray-600">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Menyediakan fasilitas ibadah yang suci, bersih, dan representatif.</li>
                                    <li>Menghadirkan imam dan mubaligh yang kompeten.</li>
                                    <li>Melayani pengelolaan ZISWAF dan ibadah Qurban secara profesional.</li>
                                    <li>Menyediakan layanan sosial kemasyarakatan (ambulans & pengurusan jenazah).</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div
                        class="h-64 bg-gray-100 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('img/about1.jpg') }}" alt="Interior Masjid"
                            class="w-full h-full object-cover">
                    </div>
                    <div
                        class="h-64 bg-gray-100 rounded-2xl overflow-hidden shadow-lg mt-8 hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('img/about2.jpg') }}" alt="Kegiatan Komunitas"
                            class="w-full h-full object-cover">
                    </div>
                    <div
                        class="h-64 bg-gray-100 rounded-2xl overflow-hidden shadow-lg -mt-8 hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('img/about3.jpg') }}" alt="Detail Arsitektur"
                            class="w-full h-full object-cover">
                    </div>
                    <div
                        class="h-64 bg-gray-100 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('img/about4.jpg') }}" alt="Jamaah Sholat"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal sholat Section -->
    <section id="jadwal-sholat" class="py-20 bg-gray-50 scroll-mt-20">
        <div class="container mx-auto px-4 ">
            <div class="text-center  mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Jadwal Sholat</h2>
                <p class="text-lg text-gray-600">Jadwal Sholat Hari ini</p>
            </div>

            <div class="max-w-4xl mx-auto mb-8">
                <div class="bg-islamic-green text-white rounded-xl p-6 text-center shadow-lg">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Jadwal Selanjutnya </span>
                    </div>
                    <h3 id="next-prayer" class="text-3xl font-bold mb-2">Loading...</h3>
                    <p id="countdown" class="text-2xl font-mono">Loading...</p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition-shadow">
                    <h4 class="text-center text-lg font-bold mb-3">Subuh</h4>
                    <p id="subuh" class="text-2xl font-bold text-center text-islamic-green">Loading...</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition-shadow">
                    <h4 class="text-center text-lg font-bold mb-3">Dzuhur</h4>
                    <p id="dzuhur" class="text-2xl font-bold text-center text-islamic-green">Loading...</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition-shadow">
                    <h4 class="text-center text-lg font-bold mb-3">Ashar</h4>
                    <p id="ashar" class="text-2xl font-bold text-center text-islamic-green">Loading...</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition-shadow">
                    <h4 class="text-center text-lg font-bold mb-3">Maghrib</h4>
                    <p id="maghrib" class="text-2xl font-bold text-center text-islamic-green">Loading...</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition-shadow">
                    <h4 class="text-center text-lg font-bold mb-3">Isya</h4>
                    <p id="isya" class="text-2xl font-bold text-center text-islamic-green">Loading...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- aktivitas Section -->
    <section id="aktivitas" class="py-20 bg-white scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Program & Aktivitas</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Menguatkan iman dan ukhuwah melalui kegiatan ibadah, pendidikan, dan kepedulian sosial bagi seluruh
                    jamaah.</p>
            </div>

            <div class="flex overflow-x-auto gap-6 pb-8 snap-x snap-mandatory scrollbar-hide"
                style="-ms-overflow-style: none; scrollbar-width: none;">
                @forelse($programs as $program)
                    <div class="min-w-[300px] md:min-w-[350px] snap-center bg-white rounded-xl shadow p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 cursor-pointer program-card group border border-gray-100"
                        data-emoji="{{ $program->emoji ?? '📝' }}" data-title="{{ $program->title }}"
                        data-description="{{ $program->description }}"
                        data-schedule-type="{{ $program->schedule_type }}"
                        data-start-date="{{ $program->start_date ? $program->start_date->translatedFormat('d F Y') : '' }}"
                        data-end-date="{{ $program->end_date ? $program->end_date->translatedFormat('d F Y') : '' }}"
                        data-start-time="{{ $program->start_time ? \Carbon\Carbon::parse($program->start_time)->format('H:i') : '' }}"
                        data-end-time="{{ $program->end_time ? \Carbon\Carbon::parse($program->end_time)->format('H:i') : '' }}"
                        data-day="{{ json_encode($program->day_of_week) }}"
                        data-custom="{{ $program->custom_text }}">

                        <div
                            class="w-14 h-14 bg-islamic-green/10 rounded-full flex items-center justify-center mb-4 group-hover:bg-islamic-green/20 transition-colors">
                            <span class="text-3xl">{{ $program->emoji ?? '📝' }}</span>
                        </div>
                        <h3
                            class="text-xl font-bold mb-3 text-gray-800 group-hover:text-islamic-green transition-colors">
                            {{ $program->title }}</h3>
                        <p class="text-gray-600 line-clamp-3 mb-4">{{ $program->description }}</p>

                        <div class="flex items-center text-sm text-islamic-green font-medium">
                            <span>Lihat Detail</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500 w-full">
                        <p>Belum ada program yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Program Detail Modal -->
    <div id="program-modal" class="fixed inset-0 z-[100] hidden opacity-0 transition-opacity duration-300"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" id="modal-overlay"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <!-- Modal Panel -->
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg scale-95 opacity-0 duration-300"
                    id="modal-panel">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <button type="button" id="modal-close"
                            class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 transition-colors">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                <div class="flex justify-center mb-6">
                                    <div
                                        class="w-20 h-20 bg-islamic-green/10 rounded-full flex items-center justify-center">
                                        <span id="modal-emoji" class="text-5xl"></span>
                                    </div>
                                </div>

                                <h3 class="text-2xl font-bold leading-6 text-gray-900 text-center mb-6"
                                    id="modal-title"></h3>

                                <div class="mt-4 bg-gray-50 rounded-xl p-4 mb-6 border border-gray-100">
                                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Waktu
                                        Pelaksanaan</h4>
                                    <p id="modal-schedule-text" class="text-gray-900 font-medium"></p>
                                </div>

                                <div class="mt-2">
                                    <p class="text-gray-600 whitespace-pre-line leading-relaxed"
                                        id="modal-description"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" id="modal-close-btn"
                            class="inline-flex w-full justify-center rounded-lg bg-islamic-green px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-islamic-green-light sm:ml-3 sm:w-auto transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Struktur organisasi Section -->
    @php
        $structures = [
            ['name' => 'Koswara, S.Pd, M.Pd.', 'role' => 'Ketua DKM', 'img' => 'ketumdkm.jpg'],
            ['name' => 'Erik Dudi Susanto, S.Pd, M.Pd.', 'role' => 'Wakil Ketua 1', 'img' => 'waketumdkm.jpg'],
            ['name' => 'Amir Syarifudin', 'role' => 'Wakil Ketua 2', 'img' => 'waketumdkm2.jpg'],
            ['name' => 'Abdul Gopur, S.Sos', 'role' => 'Sekretaris', 'img' => 'sekre.jpg'],
            ['name' => 'Herlianto', 'role' => 'Wakil Sekretaris', 'img' => 'staff_placeholder.png'],
            ['name' => 'Cucuk Supriadi, S.Pd.', 'role' => 'Bendahara', 'img' => 'bendahara.jpg'],
            ['name' => 'Herawan Setia Dipura', 'role' => 'Wakil Bendahara', 'img' => 'staff_placeholder.png'],
        ];
    @endphp
    <section id="struktur" class="py-20 bg-gray-50 scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Struktur Organisasi</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Mengenal jajaran Dewan Kemakmuran Masjid (DKM) yang amanah dalam melayani kebutuhan umat dan
                    memakmurkan masjid.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 max-w-7xl mx-auto">
                @foreach ($structures as $staff)
                    <div
                        class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                                <img src="{{ asset('img/' . $staff['img']) }}" alt="Foto {{ $staff['name'] }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <h4 class="text-lg font-bold mb-2">{{ $staff['role'] }}</h4>
                            <p class="text-gray-600 font-medium">{{ $staff['name'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="galeri" class="py-20 bg-white scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Galeri Masjid</h2>
                <p class="text-lg text-gray-600">Dokumentasi kegiatan ibadah, pendidikan MDA, dan kepedulian sosial
                    yang mempererat Ukhuwah Islamiyah.</p>
            </div>

            <div class="gallery-grid">
                @foreach ($galleries as $index => $group)
                    <div class="gallery-item">
                        <div class="activity-carousel" id="carousel-{{ $index + 1 }}">
                            <div class="carousel-track">
                                @foreach ($group->photos as $photo)
                                    <div class="carousel-slide">
                                        <img src="{{ asset('storage/' . $photo->image_path) }}"
                                            alt="{{ $photo->caption ?? $group->title }}">
                                        <div class="carousel-caption">
                                            <h4 class="font-bold text-xl mb-3">{{ $photo->caption ?? $group->title }}
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="carousel-indicators">
                                @foreach ($group->photos as $key => $photo)
                                    <div class="carousel-indicator {{ $key === 0 ? 'active' : '' }}"></div>
                                @endforeach
                            </div>
                        </div>

                        <div class="p-4 text-center border-t border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $group->title }}</h3>
                            @if ($group->description)
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $group->description }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section class="py-20 bg-white scroll-mt-24">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Kunjungi Kami</h2>
                <p class="text-lg text-gray-600">Mari memakmurkan masjid dan rasakan kenyamanan beribadah di lingkungan
                    Perumahan Tamanjaya Indah.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <div class="h-96 rounded-2xl overflow-hidden shadow-lg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.62808360832!2d108.23546209999999!3d-7.3955039000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f57ff059f9f11%3A0x888b961677053487!2sMasjid%20Al-Muhajirin%20Perum%20Taman%20Jaya%20Indah!5e0!3m2!1sid!2sid!4v1764047049411!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="space-y-4">
                    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                        <h4 class="flex items-center gap-3 text-xl font-bold mb-3">
                            <span class="text-islamic-green">📍</span> Alamat
                        </h4>
                        <p class="text-gray-600">
                            J63P+Q5W, Perum Taman Jaya Indah,<br> Tamanjaya, Kec. Tamansari, Kab. Tasikmalaya,<br> Jawa
                            Barat 46196
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                        <h4 class="flex items-center gap-3 text-xl font-bold mb-3">
                            <span class="text-islamic-green">📞</span> Informasi Kontak
                        </h4>
                        <div class="space-y-2 text-gray-600">
                            <p class="flex items-center gap-2">
                                <span>✉️</span> almuhajirintamanjaya@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact" class="py-20 bg-gray-50 scroll-mt-24">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Ada pertanyaan atau butuh bantuan? Kami di sini untuk membantu
                </p>
            </div>

            <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold mb-6">Kirim Pesan kepada Kami</h3>
                <form id="contact-form" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium mb-2">Kirim Pesan kepada Kami</label>
                        <input type="text" id="name" name="name" placeholder="Nama anda" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-islamic-green focus:border-transparent">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="email.anda@email.com"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-islamic-green focus:border-transparent">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="6" placeholder="Bagaimana kami bisa membantu Anda?" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-islamic-green focus:border-transparent"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-islamic-green hover:bg-islamic-green-light text-white font-semibold py-3 px-6 rounded-full transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0 duration-200">
                        Kirim Pesan
                    </button>
                </form>
                <div id="form-message" class="mt-4 text-center hidden"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-islamic-green text-white">
        <div class="container mx-auto px-2 py-10">
            <div class="border-t border-white/10 pt-6 text-center">
                <p class="text-sm opacity-80">
                    © <span id="current-year"></span> Masjid Al-Muhajirin.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
