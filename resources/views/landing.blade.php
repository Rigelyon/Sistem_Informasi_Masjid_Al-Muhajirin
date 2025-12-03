<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Al-Muhajirin</title>
    <meta name="description" content="Masjid Al-Muhajirin - Komunitas yang bersatu dalam iman, kasih sayang, dan pelayanan. Bergabunglah dengan kami untuk sholat harian, kelas Quran, dan program komunitas. Melayani sejak 1995.">
    <meta name="keywords" content="masjid, Islamic center, jadwal sholat, kelas Quran, komunitas Muslim, masjid Jakarta">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

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
                    <a href="#home" class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-islamic-green transition-colors">Beranda</a>

                    <!-- Dropdown untuk Tentang -->
                    <div class="relative group">
                        <button class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-islamic-green transition-colors flex items-center">
                            Tentang
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-200">
                            <div class="py-2">
                                <a href="#tentang" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Tentang
                                    Masjid</a>
                                <a href="#struktur" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Struktur
                                    Organisasi</a>
                                <a href="#galeri" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">Galeri</a>
                            </div>
                        </div>
                    </div>

                    <a href="#jadwal-sholat" class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-islamic-green transition-colors">Jadwal
                        Sholat</a>
                    <a href="#aktivitas" class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-islamic-green transition-colors">Aktivitas</a>
                    <a href="#zakat" class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-islamic-green transition-colors">Zakat</a>

                    <!-- Auth Links -->
                    @if (Route::has('login'))
                        <div class="ml-4 flex items-center space-x-2">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-islamic-green rounded-lg hover:bg-islamic-green-light transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-islamic-green border border-islamic-green rounded-lg hover:bg-islamic-green-lighter transition-colors">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-islamic-green rounded-lg hover:bg-islamic-green-light transition-colors">Register</a>
                                @endif
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
                    <a href="#home" class="px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Beranda</a>

                    <!-- Dropdown untuk Tentang (Mobile) -->
                    <div class="relative">
                        <button id="mobile-tentang-btn" class="w-full text-left px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors flex items-center justify-between">
                            Tentang
                            <svg id="mobile-tentang-icon" class="w-4 h-4 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="mobile-tentang-menu" class="hidden pl-6 mt-2 space-y-2">
                            <a href="#tentang" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Tentang
                                Masjid</a>
                            <a href="#struktur" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Struktur
                                Organisasi</a>
                            <a href="#galeri" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Galeri</a>
                        </div>
                    </div>

                    <a href="#jadwal-sholat" class="px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Jadwal Sholat</a>
                    <a href="#aktivitas" class="px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Aktivitas</a>
                    <a href="#zakat" class="px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Zakat</a>

                    <!-- Mobile Auth Links -->
                    @if (Route::has('login'))
                        <div class="pt-2 border-t border-gray-200">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">Register</a>
                                @endif
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

            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-100 z-0" style="background-image: url({{ asset('img/bg3.jpg') }})">
            </div>

            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0 z-[-1]" style="background-image: url({{ asset('img/bg2.jpeg') }})">
            </div>

            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0 z-[-1]" style="background-image: url({{ asset('img/bg1.jpg') }})">
            </div>
        </div>

        <div class="absolute inset-0 hero-overlay"></div>

        <div class="relative z-10 container mx-auto px-4 text-center text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Selamat Datang di Masjid Al-Muhajirin
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto opacity-95">
                Komunitas yang bersatu dalam iman, kasih sayang, dan pelayanan kepada Allah SWT
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#jadwal-sholat" class="inline-block bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white hover:bg-white/20 font-semibold text-lg px-8 py-3 rounded-lg transition-colors">
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
                            Masjid Al-Muhajirin telah melayani komunitas kami sejak 1995, menyediakan ruang suci untuk ibadah, pendidikan, dan pertemuan komunitas. Kami berkomitmen untuk memupuk nilai-nilai Islam dan mempromosikan persatuan di antara umat Muslim.
                        </p>
                        <p>
                            Masjid kami menyambut semua orang yang mencari ilmu, pertumbuhan spiritual, dan koneksi dengan komunitas Muslim. Kami menawarkan sholat harian, program pendidikan, dan berbagai layanan komunitas.
                        </p>
                    </div>
                    <div class="mt-8 space-y-4">
                        <div class="p-6 bg-islamic-green-lighter rounded-xl border border-islamic-green/20">
                            <h3 class="text-xl font-bold mb-2 text-islamic-green">Visi Kami</h3>
                            <p class="text-gray-600">
                                Menjadi pusat terkemuka dalam ilmu Islam dan pengembangan spiritual, memelihara komunitas Muslim yang kuat dan bersatu yang dipandu oleh prinsip-prinsip Al-Quran dan Sunnah.
                            </p>
                        </div>
                        <div class="p-6 bg-islamic-green-lighter rounded-xl border border-islamic-green/20">
                            <h3 class="text-xl font-bold mb-2 text-islamic-green">Misi Kami</h3>
                            <p class="text-gray-600">
                                Menyediakan pendidikan Islam berkualitas, memfasilitasi ibadah rutin, mendukung kesejahteraan komunitas, dan mempromosikan harmoni antar agama melalui kasih sayang dan pengertian.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="h-64 bg-gray-100 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('img/about.jpeg') }}" alt="Interior Masjid" class="w-full h-full object-cover">
                    </div>
                    <div class="h-64 bg-gray-100 rounded-2xl overflow-hidden shadow-lg mt-8 hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('img/about2.jpeg') }}" alt="Kegiatan Komunitas" class="w-full h-full object-cover">
                    </div>
                    <div class="h-64 bg-gray-100 rounded-2xl overflow-hidden shadow-lg -mt-8 hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('img/about3.jpeg') }}" alt="Detail Arsitektur" class="w-full h-full object-cover">
                    </div>
                    <div class="h-64 bg-gray-100 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('img/about4.jpeg') }}" alt="Jamaah Sholat" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal sholat Section -->
    <section id="jadwal-sholat" class="py-20 bg-gray-50 scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
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
                    Bergabunglah dengan kami dalam program yang beragam untuk memperkuat iman dan membangun komunitas
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-islamic-green/10 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl">📚</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Kajian Islam Mingguan</h3>
                    <p class="text-gray-600">Bergabunglah dengan para ulama kami setiap Jumat malam untuk diskusi yang mencerahkan tentang ajaran Islam dan isu-isu kontemporer.</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-islamic-green/10 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl">👥</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Kelas Quran & TPQ</h3>
                    <p class="text-gray-600">Pendidikan Al-Quran yang komprehensif untuk segala usia, dari tajwid dasar hingga studi tafsir tingkat lanjut.</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-islamic-green/10 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl">❤️</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Sedekah Jumat</h3>
                    <p class="text-gray-600">Program amal mingguan yang mendukung komunitas lokal kami, termasuk distribusi makanan dan bantuan bagi mereka yang membutuhkan.</p>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-14 h-14 bg-islamic-green/10 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl">🌙</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Acara Ramadan</h3>
                    <p class="text-gray-600">Program khusus selama Ramadan termasuk sholat tarawih, buka puasa bersama, dan Qiyam al-Layl.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur organisasi Section -->
    @php
        $structures = [
            ['name' => 'Ustadz Ahmad Ibrahim', 'role' => 'Ketua DKM', 'img' => 'st1.jpeg'],
            ['name' => 'Muhammad Yusuf', 'role' => 'Sekretaris', 'img' => 'st2.jpeg'],
            ['name' => 'Fatimah Hassan', 'role' => 'Bendahara', 'img' => 'st3.jpeg'],
            ['name' => 'Ustadz Abdullah Malik', 'role' => 'Bidang Keagamaan', 'img' => 'st4.jpeg'],
            ['name' => 'Sulaiman', 'role' => 'Bidang Pembangunan', 'img' => 'st5.jpeg'],
            ['name' => 'Khadijah Rahman', 'role' => 'Kegiatan Sosial', 'img' => 'st6.jpeg'],
            ['name' => 'Abdul Karawita', 'role' => 'Media & Publikasi', 'img' => 'st7.jpeg'],
            ['name' => 'Muhammad Sumbul', 'role' => 'Media & Publikasi', 'img' => 'st8.jpeg'],
        ];
    @endphp
    <section id="struktur" class="py-20 bg-gray-50 scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Struktur Organisasi</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Temui tim yang berdedikasi dalam mengelola dan melayani komunitas masjid kami
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 max-w-7xl mx-auto">
                @foreach($structures as $staff)
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                            <img src="{{ asset('img/' . $staff['img']) }}" alt="Foto {{ $staff['name'] }}" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-bold mb-2">{{ $staff['role'] }}</h4>
                        <p class="text-gray-600 font-medium">{{ $staff['name'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Galeri Section dengan Carousel -->
    @php
        $galleries = [
            [
                'title' => 'Pengajian MUI - DMI TK. Kelurahan Tamanjaya',
                'images' => ['pengajian.jpg', 'pengajian(2).jpg', 'pengajian(3).jpg']
            ],
            [
                'title' => 'Idul Adha',
                'images' => ['idul-adha.jpeg', 'idhul_adha(2).jpg', 'idhul_adha(3).jpg']
            ],
            [
                'title' => 'Tasyakur dan Akad Pembelian Ambulance',
                'images' => ['Tasyakur dan akad pembelian mobil ambulance.jpg', 'Tasyakur dan akad pembelian mobil ambulance(2).jpg', 'Tasyakur dan akad pembelian mobil ambulance(3).jpg']
            ],
            [
                'title' => 'Peringatan 1 Muharram',
                'images' => ['1 muharam.jpg', '1 muharam(2).jpg', '1 muharam(3).jpg']
            ],
            [
                'title' => 'Maulid Nabi',
                'images' => ['maulid(2).jpg', 'maulid.jpg', 'maulid(3).jpg']
            ],
            [
                'title' => 'Santunan Anak Yatim',
                'images' => ['santunan.jpg', 'santunan(2).jpg', 'santunan(3).jpg']
            ],
        ];
    @endphp
    <section id="galeri" class="py-20 bg-white scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Galeri Masjid</h2>
                <p class="text-lg text-gray-600">Momen dari komunitas kami yang dinamis</p>
            </div>

            <div class="gallery-grid">
                @foreach($galleries as $index => $gallery)
                <div class="gallery-item">
                    <div class="activity-carousel" id="carousel-{{ $index + 1 }}">
                        <div class="carousel-track">
                            @foreach($gallery['images'] as $image)
                            <div class="carousel-slide">
                                <img src="{{ asset('img/' . $image) }}" alt="{{ $gallery['title'] }}">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">{{ $gallery['title'] }}</h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="carousel-indicators">
                            @foreach($gallery['images'] as $key => $image)
                            <div class="carousel-indicator {{ $key === 0 ? 'active' : '' }}"></div>
                            @endforeach
                        </div>
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
                <p class="text-lg text-gray-600">Temukan kami dan bergabunglah dengan komunitas kami</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <div class="h-96 rounded-2xl overflow-hidden shadow-lg">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.62808360832!2d108.23546209999999!3d-7.3955039000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f57ff059f9f11%3A0x888b961677053487!2sMasjid%20Al-Muhajirin%20Perum%20Taman%20Jaya%20Indah!5e0!3m2!1sid!2sid!4v1764047049411!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="space-y-4">
                    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                        <h4 class="flex items-center gap-3 text-xl font-bold mb-3">
                            <span class="text-islamic-green">📍</span> Alamat
                        </h4>
                        <p class="text-gray-600">
                            J63P+Q5W, Perum Taman Jaya Indah,<br> Tamanjaya, Kec. Tamansari, Kab. Tasikmalaya,<br> Jawa Barat 46196
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                        <h4 class="flex items-center gap-3 text-xl font-bold mb-3">
                            <span class="text-islamic-green">🕐</span> Jam Operasional
                        </h4>
                        <p class="text-gray-600">
                            Buka Setiap Hari: 04:00 - 22:00<br> Sholat Jumat: 12:00 - 14:00<br> Jam Kantor: 08:00 - 16:00 (Sen-Jum)
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">
                        <h4 class="flex items-center gap-3 text-xl font-bold mb-3">
                            <span class="text-islamic-green">📞</span> Informasi Kontak
                        </h4>
                        <div class="space-y-2 text-gray-600">
                            <p class="flex items-center gap-2">
                                <span>📞</span> +62 852-2485-8017
                            </p>
                            <p class="flex items-center gap-2">
                                <span>✉️</span> info@alhikmahmosque.id
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
                        <input type="text" id="name" name="name" placeholder="Nama anda" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-islamic-green focus:border-transparent">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="email.anda@email.com" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-islamic-green focus:border-transparent">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="6" placeholder="Bagaimana kami bisa membantu Anda?" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-islamic-green focus:border-transparent"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-islamic-green hover:bg-islamic-green-light text-white font-semibold py-3 px-6 rounded-lg transition-colors">
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
