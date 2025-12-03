<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Al-Muhajirin</title>
    <meta name="description" content="Masjid Al-Muhajirin - Komunitas yang bersatu dalam iman, kasih sayang, dan pelayanan. Bergabunglah dengan kami untuk sholat harian, kelas Quran, dan program komunitas. Melayani sejak 1995.">
    <meta name="keywords" content="masjid, Islamic center, jadwal sholat, kelas Quran, komunitas Muslim, masjid Jakarta">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'islamic-green': '#2d7a5e',
                        'islamic-green-light': '#3a9373',
                        'islamic-green-lighter': '#e8f5f1',
                        'islamic-gold': '#f5c842',
                        'islamic-gold-dark': '#e6b82e',
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'Georgia', 'serif'],
                        'body': ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', Georgia, serif;
        }
        
        .hero-overlay {
            background: linear-gradient(180deg, rgba(81, 156, 128, 0.6), rgba(34, 95, 73, 0.7));
        }
        
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
        
        .rotate-180 {
            transform: rotate(180deg);
        }
        /* Styling untuk carousel kegiatan */
        
        .activity-carousel {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 300px;
            margin-bottom: 20px;
        }
        
        .carousel-track {
            display: flex;
            height: 100%;
            transition: transform 0.5s ease-in-out;
        }
        
        .carousel-slide {
            min-width: 100%;
            position: relative;
        }
        
        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        /* Keterangan yang muncul di tengah saat hover */
        
        .carousel-caption {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            opacity: 0;
            transform: scale(0.9);
            transition: all 0.3s ease;
        }
        
        .carousel-slide:hover .carousel-caption {
            opacity: 1;
            transform: scale(1);
        }
        
        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.7);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.3s ease;
            opacity: 0;
            z-index: 10;
        }
        
        .activity-carousel:hover .carousel-nav {
            opacity: 1;
        }
        
        .carousel-nav:hover {
            background: rgba(255, 255, 255, 0.9);
        }
        
        .carousel-prev {
            left: 10px;
        }
        
        .carousel-next {
            right: 10px;
        }
        
        .carousel-indicators {
            display: flex;
            justify-content: center;
            margin-top: 10px;
            gap: 6px;
        }
        
        .carousel-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ccc;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .carousel-indicator.active {
            background: #2d7a5e;
        }
        /* Grid layout untuk galeri */
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .gallery-item {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover {
            transform: translateY(-5px);
        }
        
        .activity-info {
            padding: 15px;
        }
        
        .activity-info h3 {
            margin: 0 0 10px 0;
            color: #2d7a5e;
            font-size: 1.2rem;
        }
        
        .activity-info p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
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
    <!-- kalau bisa integrasi sama api -->
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
    <!-- Foto bisa diganti menjadi icon kalau tidak ada foto yang resmi -->
    <section id="struktur" class="py-20 bg-gray-50 scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Struktur Organisasi</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Temui tim yang berdedikasi dalam mengelola dan melayani komunitas masjid kami
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 max-w-7xl mx-auto">

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                            <img src="{{ asset('img/st1.jpeg') }}" alt="Foto Ustadz Ahmad Ibrahim" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-bold mb-2">Ketua DKM</h4>
                        <p class="text-gray-600 font-medium">Ustadz Ahmad Ibrahim</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                            <img src="{{ asset('img/st2.jpeg') }}" alt="Foto Muhammad Yusuf" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-bold mb-2">Sekretaris</h4>
                        <p class="text-gray-600 font-medium">Muhammad Yusuf</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                            <img src="{{ asset('img/st3.jpeg') }}" alt="Foto Fatimah Hassan" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-bold mb-2">Bendahara</h4>
                        <p class="text-gray-600 font-medium">Fatimah Hassan</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                            <img src="{{ asset('img/st4.jpeg') }}" alt="Foto Ustadz Abdullah Malik" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-bold mb-2">Bidang Keagamaan</h4>
                        <p class="text-gray-600 font-medium">Ustadz Abdullah Malik</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                            <img src="{{ asset('img/st5.jpeg') }}" alt="Foto Sulaiman" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-bold mb-2">Bidang Pembangunan</h4>
                        <p class="text-gray-600 font-medium">Sulaiman</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                            <img src="{{ asset('img/st6.jpeg') }}" alt="Foto Khadijah Rahman" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-bold mb-2">Kegiatan Sosial</h4>
                        <p class="text-gray-600 font-medium">Khadijah Rahman</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                            <img src="{{ asset('img/st7.jpeg') }}" alt="Foto Omar Khalid" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-bold mb-2">Media & Publikasi</h4>
                        <p class="text-gray-600 font-medium">Abdul Karawita</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-200">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 shadow-md">
                            <img src="{{ asset('img/st8.jpeg') }}" alt="Foto Omar Khalid" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-bold mb-2">Media & Publikasi</h4>
                        <p class="text-gray-600 font-medium">Muhammad Sumbul</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Section dengan Carousel -->
    <section id="galeri" class="py-20 bg-white scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Galeri Masjid</h2>
                <p class="text-lg text-gray-600">Momen dari komunitas kami yang dinamis</p>
            </div>

            <div class="gallery-grid">
                <!-- Kegiatan 1: Pengajian MUI -->
                <div class="gallery-item">
                    <div class="activity-carousel" id="carousel-1">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="{{ asset('img/pengajian.jpg') }}" alt="Pengajian MUI - DMI TK. Kelurahan Tamanjaya">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Pengajian MUI - DMI TK. Kelurahan Tamanjaya</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/pengajian(2).jpg') }}" alt="Pengajian MUI - DMI TK. Kelurahan Tamanjaya">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Pengajian MUI - DMI TK. Kelurahan Tamanjaya</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/pengajian(3).jpg') }}" alt="Pengajian MUI - DMI TK. Kelurahan Tamanjaya">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Pengajian MUI - DMI TK. Kelurahan Tamanjaya</h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-indicators">
                            <div class="carousel-indicator active"></div>
                            <div class="carousel-indicator"></div>
                            <div class="carousel-indicator"></div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 2: Idul Adha -->
                <div class="gallery-item">
                    <div class="activity-carousel" id="carousel-2">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="{{ asset('img/idul-adha.jpeg') }}" alt="Idul Adha">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Idul Adha</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/idhul_adha(2).jpg') }}" alt="Idul Adha">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Idul Adha</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/idhul_adha(3).jpg') }}" alt="Idul Adha">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Idul Adha</h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-indicators">
                            <div class="carousel-indicator active"></div>
                            <div class="carousel-indicator"></div>
                            <div class="carousel-indicator"></div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 3: Tasyakur Ambulance -->
                <div class="gallery-item">
                    <div class="activity-carousel" id="carousel-3">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="{{ asset('img/Tasyakur dan akad pembelian mobil ambulance.jpg') }}" alt="Tasyakur dan akad pembelian mobil ambulance">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Tasyakur dan Akad Pembelian Ambulance</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/Tasyakur dan akad pembelian mobil ambulance(2).jpg') }}" alt="Tasyakur dan akad pembelian mobil ambulance">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Tasyakur dan Akad Pembelian Ambulance</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/Tasyakur dan akad pembelian mobil ambulance(3).jpg') }}" alt="Tasyakur dan akad pembelian mobil ambulance">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Tasyakur dan Akad Pembelian Ambulance</h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-indicators">
                            <div class="carousel-indicator active"></div>
                            <div class="carousel-indicator"></div>
                            <div class="carousel-indicator"></div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 4: 1 Muharram -->
                <div class="gallery-item">
                    <div class="activity-carousel" id="carousel-4">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="{{ asset('img/1 muharam.jpg') }}" alt="Peringatan 1 Muharram">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Peringatan 1 Muharram</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/1 muharam(2).jpg') }}" alt="Peringatan 1 Muharram">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Peringatan 1 Muharram</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/1 muharam(3).jpg') }}" alt="Peringatan 1 Muharram">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Peringatan 1 Muharram</h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-indicators">
                            <div class="carousel-indicator active"></div>
                            <div class="carousel-indicator"></div>
                            <div class="carousel-indicator"></div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 5: Ramadhan -->
                <div class="gallery-item">
                    <div class="activity-carousel" id="carousel-5">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="{{ asset('img/maulid(2).jpg') }}" alt="Maulid Nabi">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Maulid Nabi</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/maulid.jpg') }}" alt="Maulid Nabi">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Maulid Nabi</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/maulid(3).jpg') }}" alt="Maulid Nabi">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Maulid Nabi</h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-indicators">
                            <div class="carousel-indicator active"></div>
                            <div class="carousel-indicator"></div>
                            <div class="carousel-indicator"></div>
                        </div>
                    </div>
                </div>

                <!-- Kegiatan 6: Santunan Anak Yatim -->
                <div class="gallery-item">
                    <div class="activity-carousel" id="carousel-6">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="{{ asset('img/santunan.jpg') }}" alt="Santunan Anak Yatim">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Santunan Anak Yatim</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/santunan(2).jpg') }}" alt="Santunan Anak Yatim">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Santunan Anak Yatim</h4>
                                </div>
                            </div>
                            <div class="carousel-slide">
                                <img src="{{ asset('img/santunan(3).jpg') }}" alt="Santunan Anak Yatim">
                                <div class="carousel-caption">
                                    <h4 class="font-bold text-xl mb-3">Santunan Anak Yatim</h4>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-indicators">
                            <div class="carousel-indicator active"></div>
                            <div class="carousel-indicator"></div>
                            <div class="carousel-indicator"></div>
                        </div>
                    </div>
                </div>
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

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('bg-white/95', 'backdrop-blur-sm', 'shadow-md');
            } else {
                navbar.classList.remove('bg-white/95', 'backdrop-blur-sm', 'shadow-md');
            }
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Contact Form Submission
        const contactForm = document.getElementById('contact-form');
        const formMessage = document.getElementById('form-message');

        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            if (!name || !email || !message) {
                formMessage.textContent = 'Mohon isi semua kolom';
                formMessage.className = 'mt-4 text-center text-red-600';
                formMessage.classList.remove('hidden');
                return;
            }

            formMessage.textContent = 'Terima kasih telah menghubungi kami. Kami akan segera menghubungi Anda kembali.';
            formMessage.className = 'mt-4 text-center text-green-600';
            formMessage.classList.remove('hidden');

            contactForm.reset();

            setTimeout(() => {
                formMessage.classList.add('hidden');
            }, 5000);
        });

        // Set Current Year in Footer
        document.getElementById('current-year').textContent = new Date().getFullYear();

        function startSlideshow() {
            const slides = document.querySelectorAll('#slideshow-bg > div');
            let currentSlide = 0;

            function nextSlide() {
                // Sembunyikan slide saat ini
                slides[currentSlide].classList.remove('opacity-100', 'z-0');
                slides[currentSlide].classList.add('opacity-0', 'z-[-1]');

                // Hitung slide berikutnya
                currentSlide = (currentSlide + 1) % slides.length;

                // Tampilkan slide berikutnya dengan transisi fade
                slides[currentSlide].classList.remove('opacity-0', 'z-[-1]');
                slides[currentSlide].classList.add('opacity-100', 'z-0');
            }

            // Mulai slideshow, ganti gambar setiap 5 detik (5000ms)
            if (slides.length > 1) {
                setInterval(nextSlide, 5000);
            }
        }

        startSlideshow();

        // Mobile Dropdown Toggle
        const mobileTentangBtn = document.getElementById('mobile-tentang-btn');
        const mobileTentangMenu = document.getElementById('mobile-tentang-menu');
        const mobileTentangIcon = document.getElementById('mobile-tentang-icon');

        mobileTentangBtn.addEventListener('click', () => {
            mobileTentangMenu.classList.toggle('hidden');
            mobileTentangIcon.classList.toggle('rotate-180');
        });

        // Close mobile dropdown when clicking a link
        document.querySelectorAll('#mobile-tentang-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileTentangMenu.classList.add('hidden');
                mobileTentangIcon.classList.remove('rotate-180');
                mobileMenu.classList.add('hidden'); // Close the entire mobile menu
            });
        });

        // Inisialisasi semua carousel
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan semua carousel
            const carousels = document.querySelectorAll('.activity-carousel');

            // Inisialisasi setiap carousel
            carousels.forEach((carousel, index) => {
                initCarousel(carousel, index);
            });

            function initCarousel(carousel, carouselIndex) {
                const track = carousel.querySelector('.carousel-track');
                const slides = Array.from(track.children);
                const prevButton = carousel.querySelector('.carousel-prev');
                const nextButton = carousel.querySelector('.carousel-next');
                const indicators = Array.from(carousel.querySelectorAll('.carousel-indicator'));

                let currentIndex = 0;
                let autoSlideInterval;

                // Fungsi untuk memperbarui carousel
                function updateCarousel() {
                    track.style.transform = `translateX(-${currentIndex * 100}%)`;

                    // Update indicators
                    indicators.forEach((indicator, index) => {
                        indicator.classList.toggle('active', index === currentIndex);
                    });
                }

                // Fungsi untuk pindah ke slide berikutnya
                function nextSlide() {
                    currentIndex = (currentIndex + 1) % slides.length;
                    updateCarousel();
                }

                // Fungsi untuk pindah ke slide sebelumnya
                function prevSlide() {
                    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                    updateCarousel();
                }

                // Event listeners untuk tombol navigasi
                // nextButton.addEventListener('click', nextSlide);
                // prevButton.addEventListener('click', prevSlide);

                // Event listeners untuk indicators
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => {
                        currentIndex = index;
                        updateCarousel();
                        resetAutoSlide();
                    });
                });

                // Fungsi untuk memulai auto slide
                function startAutoSlide() {
                    autoSlideInterval = setInterval(nextSlide, 6000); // Ganti slide setiap 4 detik
                }

                // Fungsi untuk mereset auto slide
                function resetAutoSlide() {
                    clearInterval(autoSlideInterval);
                    startAutoSlide();
                }

                // Hentikan auto slide saat hover
                carousel.addEventListener('mouseenter', () => {
                    clearInterval(autoSlideInterval);
                });

                // Lanjutkan auto slide saat mouse leave
                carousel.addEventListener('mouseleave', () => {
                    startAutoSlide();
                });

                // Mulai auto slide
                startAutoSlide();

                // Inisialisasi posisi carousel
                updateCarousel();
            }
        });

        // CONFIG LOKASI
        const KODE_KOTA = 1218; // Tasikmalaya

        // LOAD JADWAL HARI INI
        async function loadPrayerTimes() {
            const today = new Date().toISOString().split("T")[0];
            const url = `https://api.myquran.com/v2/sholat/jadwal/${KODE_KOTA}/${today}`;

            try {
                const res = await fetch(url);
                const json = await res.json();
                const jadwal = json.data.jadwal;

                // Update HTML jadwal
                document.getElementById("subuh").textContent = jadwal.subuh;
                document.getElementById("dzuhur").textContent = jadwal.dzuhur;
                document.getElementById("ashar").textContent = jadwal.ashar;
                document.getElementById("maghrib").textContent = jadwal.maghrib;
                document.getElementById("isya").textContent = jadwal.isya;

                updateNextPrayer(jadwal);
            } catch (err) {
                console.log("Gagal load jadwal sholat:", err);
            }
        }

        // HITUNG NEXT PRAYER + COUNTDOWN
        function updateNextPrayer(jadwal) {
            const now = new Date();
            const names = ["Subuh", "Dzuhur", "Ashar", "Maghrib", "Isya"];
            const times = [
                jadwal.subuh,
                jadwal.dzuhur,
                jadwal.ashar,
                jadwal.maghrib,
                jadwal.isya
            ];

            let nextName = "";
            let nextTime = null;

            for (let i = 0; i < times.length; i++) {
                const [h, m] = times[i].split(":").map(Number);
                const prayerTime = new Date();
                prayerTime.setHours(h, m, 0, 0);

                if (prayerTime > now) {
                    nextName = names[i];
                    nextTime = prayerTime;
                    break;
                }
            }

            // Jika semua jadwal hari ini sudah lewat → Subuh besok
            if (!nextTime) {
                const [h, m] = jadwal.subuh.split(":").map(Number);
                nextTime = new Date();
                nextTime.setDate(nextTime.getDate() + 1);
                nextTime.setHours(h, m, 0, 0);
                nextName = "Subuh";
            }

            // Update UI
            document.getElementById("next-prayer").textContent = nextName;

            // Countdown update
            setInterval(() => {
                const now = new Date();
                const diff = nextTime - now;
                const h = Math.floor(diff / 1000 / 60 / 60);
                const m = Math.floor((diff / 1000 / 60) % 60);
                const s = Math.floor((diff / 1000) % 60);

                document.getElementById("countdown").textContent = h + " j " + m + " m " + s + " d";
            }, 1000);
        }

        // AUTO REFRESH SETIAP HARI SAMPAI 2050
        function autoDailyRefresh() {
            const now = new Date();
            const next = new Date();

            next.setDate(now.getDate() + 1);
            next.setHours(0, 5, 0, 0); // refresh jam 00:05

            const diff = next - now;

            setTimeout(() => {
                loadPrayerTimes(); // muat jadwal baru
                autoDailyRefresh(); // set ulang timer
            }, diff);
        }

        // INIT
        document.addEventListener("DOMContentLoaded", () => {
            loadPrayerTimes();
            autoDailyRefresh();
        });
    </script>
</body>

</html>
