import '../css/landing.css';

// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');

if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking a link
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
}

// Navbar Scroll Effect
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            navbar.classList.add('bg-white', 'shadow-md');
        } else {
            navbar.classList.remove('bg-white', 'shadow-md');
        }
    });
}

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

if (contactForm && formMessage) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const message = document.getElementById('message').value;
        const submitBtn = contactForm.querySelector('button[type="submit"]');

        if (!name || !email || !message) {
            formMessage.textContent = 'Mohon isi semua kolom';
            formMessage.className = 'mt-4 text-center text-red-600';
            formMessage.classList.remove('hidden');
            return;
        }

        // Disable button & show loading state
        const originalBtnText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Mengirim...';
        formMessage.classList.add('hidden');

        fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: name,
                email: email,
                message: message
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            formMessage.textContent = 'Terima kasih telah menghubungi kami. Kami akan segera menghubungi Anda kembali.';
            formMessage.className = 'mt-4 text-center text-green-600';
            formMessage.classList.remove('hidden');
            contactForm.reset();
        })
        .catch(error => {
            console.error('Error:', error);
            formMessage.textContent = error.message || 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi nanti.';
            formMessage.className = 'mt-4 text-center text-red-600';
            formMessage.classList.remove('hidden');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
            
            if (formMessage.classList.contains('text-green-600')) {
                setTimeout(() => {
                    formMessage.classList.add('hidden');
                }, 5000);
            }
        });
    });
}

// Set Current Year in Footer
const currentYearEl = document.getElementById('current-year');
if (currentYearEl) {
    currentYearEl.textContent = new Date().getFullYear();
}

function startSlideshow() {
    const slides = document.querySelectorAll('#slideshow-bg > div');
    if (!slides.length) return;

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

if (mobileTentangBtn && mobileTentangMenu && mobileTentangIcon) {
    mobileTentangBtn.addEventListener('click', () => {
        mobileTentangMenu.classList.toggle('hidden');
        mobileTentangIcon.classList.toggle('rotate-180');
    });

    // Close mobile dropdown when clicking a link
    document.querySelectorAll('#mobile-tentang-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileTentangMenu.classList.add('hidden');
            mobileTentangIcon.classList.remove('rotate-180');
            if (mobileMenu) mobileMenu.classList.add('hidden'); // Close the entire mobile menu
        });
    });
}

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
        if (!track) return;
        
        const slides = Array.from(track.children);
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
            autoSlideInterval = setInterval(nextSlide, 3000); // Ganti slide setiap 3 detik
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
        const subuhEl = document.getElementById("subuh");
        if (subuhEl) subuhEl.textContent = jadwal.subuh;
        
        const dzuhurEl = document.getElementById("dzuhur");
        if (dzuhurEl) dzuhurEl.textContent = jadwal.dzuhur;
        
        const asharEl = document.getElementById("ashar");
        if (asharEl) asharEl.textContent = jadwal.ashar;
        
        const maghribEl = document.getElementById("maghrib");
        if (maghribEl) maghribEl.textContent = jadwal.maghrib;
        
        const isyaEl = document.getElementById("isya");
        if (isyaEl) isyaEl.textContent = jadwal.isya;

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
    const nextPrayerEl = document.getElementById("next-prayer");
    if (nextPrayerEl) nextPrayerEl.textContent = nextName;

    // Countdown update
    const countdownEl = document.getElementById("countdown");
    if (countdownEl) {
        setInterval(() => {
            const now = new Date();
            const diff = nextTime - now;
            const h = Math.floor(diff / 1000 / 60 / 60);
            const m = Math.floor((diff / 1000 / 60) % 60);
            const s = Math.floor((diff / 1000) % 60);

            countdownEl.textContent = h + " j " + m + " m " + s + " d";
        }, 1000);
    }
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
    initProgramModal();
    initProgramCarouselNav();
});

function initProgramModal() {
    const modal = document.getElementById('program-modal');
    const modalPanel = document.getElementById('modal-panel');
    const modalOverlay = document.getElementById('modal-overlay');
    const closeBtns = document.querySelectorAll('#modal-close, #modal-close-btn');
    const programCards = document.querySelectorAll('.program-card');

    if (!modal) return;

    function openModal(card) {
        // Populate Data
        document.getElementById('modal-emoji').textContent = card.dataset.emoji;
        document.getElementById('modal-title').textContent = card.dataset.title;
        document.getElementById('modal-description').textContent = card.dataset.description;

        // Format Schedule Text
        let scheduleText = '';
        const type = card.dataset.scheduleType;
        
        if (type === 'one_time') {
            scheduleText = `${card.dataset.startDate}`;
            if (card.dataset.startTime) scheduleText += ` • ${card.dataset.startTime}`;
            if (card.dataset.endTime) {
                scheduleText += ` - ${card.dataset.endTime}`;
            } else if (card.dataset.startTime) {
                scheduleText += ` - Selesai`;
            }
        } else if (type === 'weekly') {
            try {
                const days = JSON.parse(card.dataset.day);
                scheduleText = `Setiap Hari ${Array.isArray(days) ? days.join(', ') : days}`;
            } catch (e) {
                scheduleText = `Setiap Hari ${card.dataset.day}`;
            }
            
            if (card.dataset.startTime) {
                scheduleText += ` • Pukul ${card.dataset.startTime}`;
                if (card.dataset.endTime) {
                    scheduleText += ` - ${card.dataset.endTime}`;
                } else {
                    scheduleText += ` - Selesai`;
                }
            }
        } else {
            scheduleText = card.dataset.custom || 'Jadwal Menyesuaikan';
        }
        
        document.getElementById('modal-schedule-text').textContent = scheduleText;

        // Show Modal
        modal.classList.remove('hidden');
        // Small delay to allow display:block to apply before opacity transition
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalPanel.classList.remove('scale-95', 'opacity-0');
            modalPanel.classList.add('scale-100', 'opacity-100');
        }, 10);
        
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        modalPanel.classList.remove('scale-100', 'opacity-100');
        modalPanel.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }

    // Event Listeners
    programCards.forEach(card => {
        card.addEventListener('click', () => openModal(card));
    });

    closeBtns.forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    modalOverlay.addEventListener('click', closeModal);

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
}

function initProgramCarouselNav() {
    const programContainer = document.getElementById('program-scroll-container');
    const programPrevBtn = document.getElementById('program-prev');
    const programNextBtn = document.getElementById('program-next');

    if (programContainer && programPrevBtn && programNextBtn) {
        programNextBtn.addEventListener('click', () => {
            programContainer.scrollBy({ left: 340, behavior: 'smooth' });
        });

        programPrevBtn.addEventListener('click', () => {
            programContainer.scrollBy({ left: -340, behavior: 'smooth' });
        });
    }
}
