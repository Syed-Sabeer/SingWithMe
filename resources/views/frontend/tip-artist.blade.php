@extends('layouts.frontend.master')


@section('css')
  <style>
       

        

       .artistTip_sec {
        padding:3rem 0;
        position: relative;
    }
    .bottom_fixedMucicPlayer .player-controls {
        display: none;
    }
.artistTip_sec .artist-profile {
    background: #15012a !important;
    backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 40px;
    border: 1px solid rgb(103 58 183 / 63%);
    margin-bottom: 40px;
    animation: artistTip_fadeIn 0.6s ease;
}

.artistTip_sec .profile-header {
    display: flex;
    align-items: center;
    gap: 30px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.artistTip_sec .artist-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3em;
    border: 4px solid rgba(255, 255, 255, 0.2);
}

.artistTip_sec .artist-avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.artistTip_sec .artist-info h2 {
    font-size: 2em;
    margin-bottom: 10px;
    font-family: 'Poppins';
    font-weight: 500;
    color: white;
}

.artistTip_sec .artist-info p {
    color: #b8b8d4;
    font-size: 1.1em;
}

/* ================= SUPPORT SECTION ================= */

.artistTip_sec .support-section {
        background: linear-gradient(135deg, rgb(22 6 50), rgb(20 7 42));
    border: 2px solid rgb(103 58 183 / 76%);
    border-radius: 20px;
    padding: 35px;
    margin-top: 30px;
}

.artistTip_sec .support-header {
    text-align: center;
    margin-bottom: 30px;
}

.artistTip_sec .support-header h3 {
    font-size: 1.8em;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-family: 'Poppins';
    color: white;
}

.artistTip_sec .support-header p {
    color: #b8b8d4;
    font-size: 1em;
}

/* ================= TIP OPTIONS ================= */

.artistTip_sec .tip-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 15px;
    margin-bottom: 25px;
}

.artistTip_sec .tip-option {
    background: rgba(255, 255, 255, 0.08);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.artistTip_sec .tip-option:hover {
    transform: translateY(-5px);
        border-color: #673AB7 !important;
    background: rgb(159 84 245 / 14%) !important;
}

.artistTip_sec .tip-option.selected {
    //background: linear-gradient(135deg, rgba(245, 87, 108, 0.3), rgba(240, 147, 251, 0.3));
    border-color: #9f54f5 !important;
        box-shadow: 0 0 20px rgb(103 58 183 / 55%)
}

.artistTip_sec .tip-option.selected::after {
    content: '✓';
    position: absolute;
    top: 10px;
    right: 10px;
    background: #9f54f5;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9em;
    color:white;
}

.artistTip_sec .tip-amount {
    font-size: 2em;
    font-weight: 700;
    color: #fff;
    margin-bottom: 5px;
}

.artistTip_sec .tip-label {
    font-size: 0.85em;
    color: #b8b8d4;
}

/* ================= CUSTOM AMOUNT ================= */

.artistTip_sec .custom-amount {
    margin-top: 20px;
}

.artistTip_sec .custom-amount label {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
    color: #b8b8d4;
}

.artistTip_sec .custom-input-wrapper {
    display: flex;
    gap: 10px;
}

.artistTip_sec .custom-input-wrapper input {
    flex: 1;
    padding: 15px 20px;
    background: rgba(255, 255, 255, 0.08);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    color: #fff;
    font-size: 1.1em;
    transition: all 0.3s ease;
}

.artistTip_sec .custom-input-wrapper input:focus {
    outline: none;
    border-color: #673AB7 ;
    background: rgba(255, 255, 255, 0.12);
}

/* ================= TIP BUTTON ================= */

.artistTip_sec .tip-button {
    width: 100%;
    padding: 18px;
    //background: linear-gradient(45deg, #f5576c, #f093fb);
    background-color: #9f54f5;
    border: none;
    border-radius: 15px;
    font-size: 1.2em;
    font-weight: 700;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.artistTip_sec .tip-button:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 30px #673ab785 !important;
}

.artistTip_sec .tip-button:active {
    transform: scale(0.98);
}

.artistTip_sec .tip-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

/* ================= MODAL ================= */

.artistTip_sec .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.8);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999999999;
    backdrop-filter: blur(5px);
    animation: artistTip_fadeIn 0.3s ease;
}

.artistTip_sec .modal-overlay.active {
    display: flex;
}

.artistTip_sec .modal {
    background: linear-gradient(135deg, #1a1a2e, #16213e);
    border-radius: 25px;
    padding: 40px;
    max-width: 500px;
    width: 90%;
    border: 2px solid rgba(255, 255, 255, 0.1);
    animation: artistTip_slideUp 0.4s ease;
    position: relative;
    display:block;
    height: auto;
}

.artistTip_sec .modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    color: #fff;
    font-size: 1.5em;
    cursor: pointer;
    transition: all 0.3s ease;
}

.artistTip_sec .modal-close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(90deg);
}

/* ================= MODAL CONTENT ================= */

.artistTip_sec .modal-header {
    text-align: center;
    margin-bottom: 30px;
    justify-content:center;
}

.artistTip_sec .modal-header h3 {
   font-size: 1.8em;
    margin-bottom: 10px;
    font-family: 'Poppins';
    font-weight: 500;
    color: white;
}

.artistTip_sec .modal-icon {
    font-size: 4em;
    margin-bottom: 15px;
}

.artistTip_sec .payment-details {
        background: rgb(13 1 34 / 27%) !important;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
    border: 2px solid #8a4eef;
}

.artistTip_sec .payment-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.artistTip_sec .payment-row:last-child {
    border-bottom: none;
    font-size: 1.2em;
    font-weight: 700;
    color: #a877ff;
}

.artistTip_sec .payment-label {
    color: #ffffff;
}

.artistTip_sec .payment-value {
    font-weight: 600;
}

/* ================= PAYMENT METHODS ================= */

.artistTip_sec .payment-methods {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 25px;
}

.artistTip_sec .payment-method {
    background: rgba(255, 255, 255, 0.08);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 20px 10px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9em;
}

.artistTip_sec .payment-method:hover {
    border-color: #8d50f1;
    background: rgba(245, 87, 108, 0.1);
}

.artistTip_sec .payment-method.selected {
        border-color: #9f54f5;
    background: rgb(18 1 48 / 21%);
}

.artistTip_sec .payment-method-icon {
    font-size: 2em;
    margin-bottom: 8px;
}

/* ================= CONFIRM & STATUS ================= */

.artistTip_sec .confirm-button {
    width: 100%;
    padding: 18px;
    background: linear-gradient(45deg, #9f54f5, #884eef) ;
    border: none;
    border-radius: 15px;
    font-size: 1.2em;
    font-weight: 700;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.artistTip_sec .confirm-button:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 30px rgba(67, 233, 123, 0.4);
}

.artistTip_sec .success-modal .modal-icon {
    color: #43e97b;
}

.artistTip_sec .error-modal .modal-icon {
    color: #f5576c;
}

.artistTip_sec .message-text {
    text-align: center;
    color: #b8b8d4;
    line-height: 1.6;
    margin-bottom: 25px;
}

/* ================= ANIMATIONS ================= */

@keyframes artistTip_fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes artistTip_slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ================= RESPONSIVE ================= */

@media (max-width: 991px) {
    .artistTip_sec {
        padding:5rem 0;
    }
}
@media (max-width: 768px) {
    .artistTip_sec .profile-header {
        flex-direction: column;
        text-align: center;
    }

    .artistTip_sec .tip-options {
        grid-template-columns: 1fr 1fr;
    }

    .artistTip_sec .payment-methods {
        grid-template-columns: 1fr;
    }

    .artistTip_sec .modal {
        padding: 30px 20px;
    }
    .artistTip_sec .modal {
        height: 500px !important;
    }
}

@media (max-width: 476px) { 
    .artistTip_sec .artist-profile {
        padding: 14px;
    }
    .artistTip_sec .tip-amount {
            font-size: 24px;
    }
    .artistTip_sec .tip-label {
            font-size: 12px;
    }
}
    </style>
@endsection

@section('content')


<section class="artistTip_sec">
    <div class="container">
        <div class="artist-profile">
            <div class="profile-header">
                <div class="artist-avatar"><img src="https://img.freepik.com/premium-photo/music-industry-visual-photo-album-full-rhythm-harmony-every-moments_563241-49684.jpg?uid=R222349977&ga=GA1.1.368428666.1763141483&semt=ais_se_enriched&w=740&q=80" alt=""></div>
                <div class="artist-info">
                    <h2>Weeknd Starlight</h2>
                    <p>Electronic Pop Artist • 2.4M Monthly Listeners</p>
                </div>
            </div>

            <div class="support-section">
                <div class="support-header">
                    <h3> Support This Artist</h3>
                    <p>Your tip goes directly to the artist and helps them create more amazing music!</p>
                </div>

                <div class="tip-options">
                    <div class="tip-option" data-amount="500">
                        <div class="tip-amount">₹500</div>
                        <div class="tip-label">Coffee</div>
                    </div>
                    <div class="tip-option" data-amount="1000">
                        <div class="tip-amount">₹1000</div>
                        <div class="tip-label">Studio Time</div>
                    </div>
                    <div class="tip-option" data-amount="2000">
                        <div class="tip-amount">₹2000</div>
                        <div class="tip-label">Super Fan</div>
                    </div>
                    <div class="tip-option" data-amount="5000">
                        <div class="tip-amount">₹5000</div>
                        <div class="tip-label">Legend</div>
                    </div>
                </div>

                <div class="custom-amount">
                    <label>Or enter custom amount:</label>
                    <div class="custom-input-wrapper">
                        <input type="number" id="customAmount" placeholder="Enter amount in ₹" min="100">
                    </div>
                </div>

                <button class="tip-button" id="tipButton">
                    <span></span>
                    <span>Send Tip</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal">
            <button class="modal-close" onclick="closeModal('paymentModal')">×</button>
            <div class="modal-header">
                
                <h3>Complete Your Tip</h3>
            </div>

            <div class="payment-details">
                <div class="payment-row">
                    <span class="payment-label">Artist:</span>
                    <span class="payment-value">Luna Starlight</span>
                </div>
                <div class="payment-row">
                    <span class="payment-label">Tip Amount:</span>
                    <span class="payment-value" id="modalAmount">₹0</span>
                </div>
                <div class="payment-row">
                    <span class="payment-label">Platform Fee (5%):</span>
                    <span class="payment-value" id="modalFee">₹0</span>
                </div>
                <div class="payment-row">
                    <span class="payment-label">Total:</span>
                    <span class="payment-value" id="modalTotal">₹0</span>
                </div>
            </div>

            <div class="payment-methods">
                <div class="payment-method selected" data-method="upi">
                    <div class="payment-method-icon">📱</div>
                    <div>UPI</div>
                </div>
                <div class="payment-method" data-method="card">
                    <div class="payment-method-icon">💳</div>
                    <div>Card</div>
                </div>
                <div class="payment-method" data-method="wallet">
                    <div class="payment-method-icon">👛</div>
                    <div>Wallet</div>
                </div>
            </div>

            <button class="confirm-button" onclick="processTip()">Confirm Payment</button>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal-overlay" id="successModal">
        <div class="modal success-modal">
            <button class="modal-close" onclick="closeModal('successModal')">×</button>
            <div class="modal-header">
                <div class="modal-icon">✅</div>
                <h3>Tip Sent Successfully!</h3>
            </div>
            <p class="message-text">
                Your support means the world to Luna Starlight! Your tip of <strong id="successAmount">₹0</strong> has been sent directly to the artist.
            </p>
            <button class="confirm-button" onclick="closeModal('successModal')">Done</button>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal-overlay" id="errorModal">
        <div class="modal error-modal">
            <button class="modal-close" onclick="closeModal('errorModal')">×</button>
            <div class="modal-header">
                <div class="modal-icon">❌</div>
                <h3>Payment Failed</h3>
            </div>
            <p class="message-text">
                Oops! Something went wrong with your payment. Please try again or use a different payment method.
            </p>
            <button class="confirm-button" onclick="closeModal('errorModal')">Try Again</button>
        </div>
    </div>
    </section>

     
{{--@include('partials.frontend.newsletter')--}}

<script>
        let selectedAmount = 0;
        let selectedPaymentMethod = 'upi';

        // Handle tip option selection
        document.querySelectorAll('.tip-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.tip-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                selectedAmount = parseInt(this.dataset.amount);
                document.getElementById('customAmount').value = '';
            });
        });

        // Handle custom amount input
        document.getElementById('customAmount').addEventListener('input', function() {
            document.querySelectorAll('.tip-option').forEach(opt => opt.classList.remove('selected'));
            selectedAmount = parseInt(this.value) || 0;
        });

        // Handle payment method selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
                this.classList.add('selected');
                selectedPaymentMethod = this.dataset.method;
            });
        });

        // Open payment modal
        document.getElementById('tipButton').addEventListener('click', function() {
            if (selectedAmount < 100) {
                alert('Please select a tip amount of at least ₹100');
                return;
            }

            const fee = Math.round(selectedAmount * 0.05);
            const total = selectedAmount + fee;

            document.getElementById('modalAmount').textContent = '₹' + selectedAmount;
            document.getElementById('modalFee').textContent = '₹' + fee;
            document.getElementById('modalTotal').textContent = '₹' + total;

            openModal('paymentModal');
        });

        // Process tip (simulated)
        function processTip() {
            closeModal('paymentModal');
            
            // Simulate payment processing
            setTimeout(() => {
                // 90% success rate for demo
                if (Math.random() > 0.1) {
                    document.getElementById('successAmount').textContent = '₹' + selectedAmount;
                    openModal('successModal');
                } else {
                    openModal('errorModal');
                }
            }, 1500);
        }

        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.body.style.overflow = 'auto';
            
            if (modalId === 'successModal') {
                // Reset selection after success
                document.querySelectorAll('.tip-option').forEach(opt => opt.classList.remove('selected'));
                document.getElementById('customAmount').value = '';
                selectedAmount = 0;
            }
        }

        // Close modal on overlay click
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });
    </script>
@endsection
