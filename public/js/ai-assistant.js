/* ========================================
   AI ASSISTANT JAVASCRIPT - NulliCarbon
   Lokasi: public/js/ai-assistant.js
   ======================================== */

// Time formatting
function getCurrentTime() {
    return new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Set initial time
    const initialTime = document.getElementById('initialTime');
    if (initialTime) {
        initialTime.textContent = getCurrentTime();
    }

    // Toggle chat
    const chatButton = document.getElementById('chatButton');
    const chatWindow = document.getElementById('chatWindow');
    const closeButton = document.getElementById('closeButton');

    if (chatButton) {
        chatButton.addEventListener('click', () => {
            chatWindow.classList.add('active');
            chatButton.style.display = 'none';
        });
    }

    if (closeButton) {
        closeButton.addEventListener('click', () => {
            chatWindow.classList.remove('active');
            chatButton.style.display = 'flex';
        });
    }

    // Message handling
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');

    function addMessage(text, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        
        const time = getCurrentTime();
        messageDiv.innerHTML = `
            <div class="message-bubble">
                ${text.replace(/\n/g, '<br>')}
                <div class="message-time">${time}</div>
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showTyping() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'message bot';
        typingDiv.id = 'typingIndicator';
        typingDiv.innerHTML = `
            <div class="message-bubble">
                <div class="typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        `;
        chatMessages.appendChild(typingDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function removeTyping() {
        const typing = document.getElementById('typingIndicator');
        if (typing) typing.remove();
    }

    function getResponse(message) {
        const lowerMsg = message.toLowerCase();
        
        // Greeting
        if (lowerMsg.match(/^(hai|halo|hi|hello|hey|pagi|siang|sore|malam)/)) {
            return 'Halo! Senang bertemu dengan Anda 😊 Saya di sini untuk membantu Anda memahami lebih lanjut tentang kompensasi karbon dan bagaimana NulliCarbon dapat membantu perjalanan keberlanjutan Anda. Ada yang ingin Anda tanyakan?';
        }

        // Kalkulator
        if (lowerMsg.includes('kalkulator') || lowerMsg.includes('hitung') || lowerMsg.includes('kalkulasi') || lowerMsg.includes('jejak karbon')) {
            return 'Kalkulator jejak karbon kami membantu Anda memahami dampak aktivitas sehari-hari terhadap lingkungan. Anda dapat menghitung emisi dari:\n\n🚗 Transportasi (mobil, motor, pesawat)\n⚡ Konsumsi energi listrik\n🗑️ Pengelolaan sampah\n🍽️ Pola makan\n\nSetelah menghitung, kami akan memberikan rekomendasi program offset yang sesuai! Silakan kunjungi halaman Kalkulator kami untuk memulai.';
        }

        // CSR & Program
        if (lowerMsg.includes('csr') || lowerMsg.includes('program') || lowerMsg.includes('mangrove') || lowerMsg.includes('terumbu')) {
            return 'NulliCarbon menawarkan berbagai program keberlanjutan:\n\n🌿 CSR Mangrove - Restorasi mangrove berbasis komunitas\n🪸 Konservasi Terumbu Karang - Pemulihan ekosistem pesisir\n♻️ Daur Ulang Sampah - Manajemen limbah berkelanjutan\n⚡ Energi Terbarukan - Solusi energi bersih (micro water-turbine)\n\nSetiap program dirancang untuk memberikan dampak lingkungan dan sosial yang terukur. Tertarik untuk berpartisipasi?';
        }

        // Untuk Perusahaan
        if (lowerMsg.includes('perusahaan') || lowerMsg.includes('bisnis') || lowerMsg.includes('korporat') || lowerMsg.includes('b2b')) {
            return 'Kami membantu perusahaan mencapai target net-zero melalui:\n\n📊 Audit & Pengukuran Emisi Karbon\n🎯 Strategi Carbon Neutrality yang Terukur\n🤝 Program CSR yang Meaningful\n🏆 Sertifikasi & Pelaporan Keberlanjutan\n💼 Branding & Komunikasi Lingkungan\n\nKami telah bermitra dengan 50+ perusahaan terkemuka. Mari diskusikan bagaimana kami dapat membantu perusahaan Anda!';
        }

        // Tentang NulliCarbon
        if (lowerMsg.includes('tentang') || lowerMsg.includes('nullicarbon') || lowerMsg.includes('profil') || lowerMsg.includes('siapa')) {
            return 'NulliCarbon adalah perusahaan yang fokus pada solusi keberlanjutan melalui kompensasi karbon dan inisiatif berbasis komunitas.\n\n🌟 Dampak Kami:\n• 150K+ bibit & fragmen ditanam\n• 250K+ penerima manfaat\n• 500Ha+ area konservasi\n• 90K+ ton sampah didaur ulang\n• 50M+ tCO2e potensi kredit karbon\n\nKami percaya bahwa setiap langkah kecil hari ini menciptakan masa depan yang lebih hijau!';
        }

        // Artikel & Edukasi
        if (lowerMsg.includes('artikel') || lowerMsg.includes('berita') || lowerMsg.includes('tips') || lowerMsg.includes('edukasi') || lowerMsg.includes('belajar')) {
            return 'Kami memiliki berbagai artikel edukatif tentang:\n\n📰 Berita Lingkungan Terkini\n💡 Tips Mengurangi Jejak Karbon\n🔬 Panduan Sustainability\n♻️ Fakta Daur Ulang\n🌍 Isu Perubahan Iklim\n\nBeberapa artikel populer:\n• "Eco-Friendly vs Biodegradable: Apa Bedanya?"\n• "7 Simbol Daur Ulang pada Plastik"\n• "Tas Kain vs Tas Kertas: Mana yang Lebih Ramah?"\n\nKunjungi section News kami untuk membaca lebih lanjut!';
        }

        // Kontak
        if (lowerMsg.includes('kontak') || lowerMsg.includes('hubungi') || lowerMsg.includes('bicara') || lowerMsg.includes('konsultasi') || lowerMsg.includes('email') || lowerMsg.includes('telepon')) {
            return 'Kami senang mendengar dari Anda! 📞\n\nTim expert kami siap membantu untuk:\n• Konsultasi solusi carbon offset\n• Proposal kerjasama strategis\n• Pertanyaan program CSR\n• Audit emisi perusahaan\n\nSilakan kunjungi halaman "Contact Us" atau klik tombol "Let\'s Talk" untuk terhubung dengan tim kami. Kami akan merespons dalam 1x24 jam!';
        }

        // Harga & Biaya
        if (lowerMsg.includes('harga') || lowerMsg.includes('biaya') || lowerMsg.includes('berapa') || lowerMsg.includes('tarif') || lowerMsg.includes('cost')) {
            return 'Biaya kompensasi karbon bervariasi tergantung pada:\n\n📊 Jumlah emisi yang ingin di-offset\n🎯 Jenis program yang dipilih\n⏱️ Durasi komitmen\n🏢 Skala (individu/perusahaan)\n\nUntuk mendapatkan penawaran yang sesuai dengan kebutuhan Anda, saya sarankan:\n1. Gunakan kalkulator kami terlebih dahulu\n2. Hubungi tim kami untuk konsultasi gratis\n\nKami menawarkan solusi yang fleksibel dan terukur!';
        }

        // Sertifikasi
        if (lowerMsg.includes('sertifikat') || lowerMsg.includes('verifikasi') || lowerMsg.includes('bukti') || lowerMsg.includes('kredibel')) {
            return 'Setiap kontribusi Anda akan mendapatkan:\n\n✅ Sertifikat Carbon Offset yang Terverifikasi\n📊 Laporan Dampak yang Transparan\n📸 Dokumentasi Program (foto & video)\n🔍 Tracking Real-time\n🏆 Recognition di Platform Kami\n\nSemua program kami mengikuti standar internasional dan dapat diaudit. Kredibilitas dan transparansi adalah prioritas kami!';
        }

        // Cara Kerja
        if (lowerMsg.includes('cara kerja') || lowerMsg.includes('bagaimana') || lowerMsg.includes('proses') || lowerMsg.includes('langkah')) {
            return 'Prosesnya sangat mudah! 🚀\n\n1️⃣ HITUNG - Gunakan kalkulator untuk mengetahui jejak karbon Anda\n\n2️⃣ PILIH - Pilih program kompensasi yang sesuai (mangrove, terumbu karang, energi bersih, dll)\n\n3️⃣ KONTRIBUSI - Lakukan offset sesuai hasil kalkulasi\n\n4️⃣ PANTAU - Dapatkan laporan dampak dan sertifikat\n\nSetiap langkah kecil Anda berkontribusi pada masa depan yang lebih berkelanjutan! 🌍';
        }

        // Default
        return 'Terima kasih atas pertanyaan Anda! Saya dapat membantu Anda dengan informasi tentang:\n\n• Kalkulasi jejak karbon\n• Program CSR & kompensasi\n• Solusi untuk perusahaan\n• Artikel & tips keberlanjutan\n• Kontak & konsultasi\n\nBisa Anda jelaskan lebih detail apa yang ingin Anda ketahui? Atau pilih salah satu topik di atas 😊';
    }

    function sendMessage() {
        const text = messageInput.value.trim();
        if (!text) return;

        // Add user message
        addMessage(text, 'user');
        messageInput.value = '';

        // Show typing
        showTyping();

        // Simulate response delay
        setTimeout(() => {
            removeTyping();
            const response = getResponse(text);
            addMessage(response, 'bot');
        }, 1000 + Math.random() * 1000);
    }

    if (sendButton) {
        sendButton.addEventListener('click', sendMessage);
    }

    if (messageInput) {
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });
    }

    // Quick actions
    document.querySelectorAll('.quick-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const action = btn.getAttribute('data-action');
            messageInput.value = action;
            sendMessage();
        });
    });
});