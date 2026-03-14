{{-- ========================================
     AI ASSISTANT COMPONENT - NulliCarbon
     Lokasi: resources/views/components/ai-assistant.blade.php
     ======================================== --}}

<!-- Load CSS -->
<link rel="stylesheet" href="{{ asset('css/ai-assistant.css') }}">

<!-- AI Chat Widget -->
<div class="ai-chat-widget">
    <!-- Chat Button -->
    <button class="chat-button" id="chatButton">
        <i class="bi bi-chat-dots-fill"></i>
        <span class="text">Butuh Bantuan?</span>
    </button>

    <!-- Chat Window -->
    <div class="chat-window" id="chatWindow">
        <!-- Header -->
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="chat-avatar">
                    <i class="bi bi-leaf"></i>
                </div>
                <div>
                    <div style="font-weight: 700; font-size: 16px;">NulliCarbon AI</div>
                    <div class="chat-status">Online • Siap Membantu</div>
                </div>
            </div>
            <button class="close-btn" id="closeButton">
                <i class="bi bi-x" style="font-size: 20px;"></i>
            </button>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <div class="quick-actions-title">PILIHAN CEPAT:</div>
            <div class="quick-actions-list">
                <button class="quick-btn" data-action="kalkulator">
                    <i class="bi bi-calculator"></i> Hitung Jejak Karbon
                </button>
                <button class="quick-btn" data-action="csr">
                    <i class="bi bi-tree"></i> Program CSR
                </button>
                <button class="quick-btn" data-action="perusahaan">
                    <i class="bi bi-building"></i> Untuk Perusahaan
                </button>
                <button class="quick-btn" data-action="tentang">
                    <i class="bi bi-people"></i> Tentang Kami
                </button>
                <button class="quick-btn" data-action="artikel">
                    <i class="bi bi-book"></i> Artikel & Tips
                </button>
                <button class="quick-btn" data-action="kontak">
                    <i class="bi bi-telephone"></i> Hubungi Kami
                </button>
            </div>
        </div>

        <!-- Messages Container -->
        <div class="chat-messages" id="chatMessages">
            <!-- Initial Welcome Message -->
            <div class="message bot">
                <div class="message-bubble">
                    Halo! Saya asisten NulliCarbon 🌱 Saya siap membantu Anda dengan informasi tentang kompensasi karbon, kalkulasi jejak karbon, dan program keberlanjutan kami. Ada yang bisa saya bantu?
                    <div class="message-time" id="initialTime"></div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="chat-input">
            <div class="input-group">
                <input type="text" id="messageInput" placeholder="Ketik pesan Anda..." autocomplete="off">
                <button class="send-btn" id="sendButton">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
            <div class="chat-footer">Powered by NulliCarbon AI Assistant</div>
        </div>
    </div>
</div>

<!-- Load JavaScript -->
<script src="{{ asset('js/ai-assistant.js') }}"></script>