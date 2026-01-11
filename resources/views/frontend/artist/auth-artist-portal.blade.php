{{-- This file is included in artisit-portal.blade.php, so no layout extension needed --}}

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* Music name input styling to match upload boxes */
#musicName::placeholder {
    color: rgba(255, 255, 255, 0.6);
    opacity: 1;
}

#musicName:focus::placeholder {
    color: rgba(255, 255, 255, 0.8);
}

/* Override form-control styles for music name input */
#musicName.form-control {
    background: rgba(255, 255, 255, 0.1) !important;
    border: none !important;
    color: white !important;
    text-align: center !important;
}

#musicName.form-control:focus {
    background: rgba(255, 255, 255, 0.2) !important;
    border: none !important;
    color: white !important;
    box-shadow: none !important;
}

/* Dark theme SweetAlert styling */
.swal2-popup {
    background-color: #1a1a1a !important;
    color: white !important;
    border: 1px solid #333 !important;
}
.audio-box {
    width:unset;
}
.popular-songs li {
    gap: 20px;
}
.artAllBtn {
    background: linear-gradient(135deg, #452d64, #21183c, #321a4a);
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    width: 200px;
    font-weight: 600;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    transition: background 0.4s ease, transform 0.3s ease; /* Added transition */
}

.artAllBtn:hover {
    background: linear-gradient(135deg, #8a57ff, #9f54f5);
    transform: translateY(-2px); /* optional small lift effect */
}
.swal2-title {
    color: white !important;
}

.swal2-content {
    color: #ccc !important;
}

.swal2-confirm {
    background-color: #9f54f5 !important;
    border: none !important;
    color: white !important;
    font-weight: 600 !important;
    padding: 10px 30px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
}

.swal2-confirm:hover {
    background-color:rgb(92, 0, 179) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(119, 0, 255, 0.3) !important;
}

.swal2-cancel {
    background-color: #6c757d !important;
    border: none !important;
    color: white !important;
    font-weight: 600 !important;
    padding: 10px 30px !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
}

.swal2-cancel:hover {
    background-color: #545b62 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3) !important;
}

.swal2-close {
    color: #ccc !important;
}

.swal2-close:hover {
    color: white !important;
}


.swal2-success-circular-line-left,
.swal2-success-circular-line-right,
.swal2-success-fix {
    background-color: #1a1a1a !important;
}

.swal2-success-ring {
    border-color: #9f54f5 !important;
}

.swal2-success-line-tip,
.swal2-success-line-long {
    background-color: #9f54f5 !important;
}

/* Error icon styling */
.swal2-error {
    border-color: #dc3545 !important;
}

.swal2-x-mark-line-left,
.swal2-x-mark-line-right {
    background-color: #dc3545 !important;
}

/* Progress bar styling */
.swal2-timer-progress-bar {
    background-color: #9f54f5 !important;
}

/* Input styling for SweetAlert */
.swal2-input {
    background-color: #2a2a2a !important;
    border: 1px solid #333 !important;
    color: white !important;
}

.swal2-input:focus {
    border-color: #9f54f5 !important;
    box-shadow: 0 0 0 0.2rem rgba(174, 0, 255, 0.25) !important;
}

/* Toast styling */
.swal2-toast {
    background-color: #1a1a1a !important;
    color: white !important;
    border: 1px solid #333 !important;
}



// withdrawal payment css

        .withdrawalPayment_popup .demo-trigger {
    padding: 15px 30px;
    background: linear-gradient(45deg, #f5576c, #f093fb);
    border: none;
    border-radius: 12px;
    font-size: 1.1em;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.withdrawalPayment_popup .demo-trigger:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(245, 87, 108, 0.4);
}

.withdrawalPayment_popup .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999999999;
    backdrop-filter: blur(8px);
    animation: withdrawal_fadeIn 0.3s ease;
    padding: 20px;
}

.withdrawalPayment_popup .modal-overlay.active {
    display: flex;
}

.withdrawalPayment_popup .modal {
     display:block;
    background: #cabfeb;
    backdrop-filter: blur(20px);
    border-radius: 20px;
    max-width: 600px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    animation: withdrawal_slideUp 0.4s ease;
    position: relative;
}

.withdrawalPayment_popup .modal-header {
    background: linear-gradient(135deg, #8650c3, #603a87);
    padding: 30px;
    border-radius: 20px 20px 0 0;
    position: relative;
    display:block;
}

.withdrawalPayment_popup .modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 222;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    color: #fff;
    font-size: 1.5em;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.withdrawalPayment_popup .modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.withdrawalPayment_popup .modal-title {
    font-size: 1.8em;
    font-weight: 700;
    margin-bottom: 8px;
    color: #fff;
}

.withdrawalPayment_popup .modal-subtitle {
    font-size: 1em;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 400;
}

.withdrawalPayment_popup .balance-display {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 12px;
    margin-top: 20px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.withdrawalPayment_popup .balance-label {
    font-size: 0.9em;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 8px;
}

.withdrawalPayment_popup .balance-amount {
    font-size: 2.2em;
    font-weight: 700;
    color: #fff;
}

.withdrawalPayment_popup .modal-body {
    padding: 30px;
    color: #1a1a1a;
}

.withdrawalPayment_popup .form-section {
    margin-bottom: 25px;
    display: block;
    padding: 0;
}

.withdrawalPayment_popup .form-section:last-child {
    margin-bottom: 0;
}

.withdrawalPayment_popup .form-label {
    display: block;
    font-size: 0.95em;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.withdrawalPayment_popup .form-label.required::after {
    content: '*';
    color: #e74c3c;
    margin-left: 4px;
}

.withdrawalPayment_popup .input-wrapper {
    position: relative;
}

.withdrawalPayment_popup .currency-symbol {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-weight: 600;
    color: #7f8c8d;
    font-size: 1.1em;
}

.withdrawalPayment_popup .form-input {
    width: 100%;
    padding: 14px 15px 14px 40px;
    border: 2px solid #e0e6ed;
    border-radius: 10px;
    font-size: 1em;
    color: #2c3e50;
    transition: all 0.3s ease;
    background: #fff;
    margin:0;
}

.withdrawalPayment_popup .form-input:focus {
    outline: none;
    border-color: #b673ff;
    box-shadow: 0 0 0 3px rgba(170, 152, 250, 0.1);
}

.withdrawalPayment_popup .form-input.error {
    border-color: #e74c3c;
}

.withdrawalPayment_popup .helper-text {
    font-size: 0.85em;
    margin: 10px 0 0 0px;
    font-weight: 600;
    color: #2c3e50;
}

.withdrawalPayment_popup .error-text {
    font-size: 0.85em;
    color: #e74c3c;
    margin-top: 6px;
    display: none;
}

.withdrawalPayment_popup .error-text.show {
    display: block;
}

.withdrawalPayment_popup .auto-fill-btn {
    margin-top: 10px;
    padding: 12px 16px;
    background: linear-gradient(135deg, #ab5eff, #59367d);
    border: 1px solid #d0d7de;
    border-radius: 8px;
    font-size: 0.9em;
    font-weight: 600;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.withdrawalPayment_popup .auto-fill-btn:hover {
    border-color: #ffffff;
}

.withdrawalPayment_popup .form-select {
    width: 100%;
    padding: 14px 15px;
    border: 2px solid #e0e6ed;
    border-radius: 10px;
    font-size: 1em;
    color: #2c3e50;
    background: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.withdrawalPayment_popup .form-select:focus {
    outline: none;
    border-color: #b673ff;
    box-shadow: 0 0 0 3px rgba(170, 152, 250, 0.1);
}

.withdrawalPayment_popup .account-info {
    background: #e4dbff;
    border: 2px solid #9559ff;
    border-radius: 10px;
    padding: 15px;
    margin-top: 10px;
}

.withdrawalPayment_popup .account-info-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 0.9em;
}

.withdrawalPayment_popup .account-info-label {
    color: #2c3e50;
    font-weight: 600;
}

.withdrawalPayment_popup .account-info-value {
    font-weight: 600;
    color: #2c3e50;
}

.withdrawalPayment_popup .info-card {
    background: #7446a6;
    border-left: 4px solid #000000;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.withdrawalPayment_popup .info-card-title {
    font-size: 0.95em;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 10px;
}

.withdrawalPayment_popup .info-item {
    display: flex;
    justify-content: space-between;
    padding: 6px 0;
    font-size: 0.9em;
}

.withdrawalPayment_popup .info-label {
    color: #ffffff;
}

.withdrawalPayment_popup .info-value {
    font-weight: 600;
    color: #ffffff;
}

.withdrawalPayment_popup .info-value.highlight {
    color: #e4d5ff;
    font-size: 1.1em;
}

.withdrawalPayment_popup .checkbox-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-top: 20px;
    padding: 15px;
    background: #fff9e6;
    border: 1px solid #f39c12;
    border-radius: 10px;
}

.withdrawalPayment_popup .checkbox-wrapper input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    margin-top: 2px;
}

.withdrawalPayment_popup .checkbox-label {
    font-size: 0.9em;
    color: #2c3e50;
    line-height: 1.5;
}

.withdrawalPayment_popup .security-note {
    background: #f0f3f7;
    border-left: 4px solid #95a5a6;
    padding: 12px 15px;
    border-radius: 8px;
    margin-top: 15px;
    font-size: 0.85em;
    color: #5a6c7d;
}

.withdrawalPayment_popup .modal-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.withdrawalPayment_popup .btn {
    flex: 1;
    padding: 15px;
    border: none;
    border-radius: 10px;
    font-size: 1em;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.withdrawalPayment_popup .btn-primary {
    background: linear-gradient(135deg, #ab5eff, #59367d);
    color: #fff;
}

.withdrawalPayment_popup .btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.withdrawalPayment_popup .btn-primary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.withdrawalPayment_popup .btn-secondary {
    background: #fff;
    color: #7f8c8d;
    border: 2px solid #e0e6ed;
}

.withdrawalPayment_popup .btn-secondary:hover {
    background: #f8f9fa;
    border-color: #d0d7de;
}

.withdrawalPayment_popup .loading-spinner {
    width: 18px;
    height: 18px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: withdrawal_spin 0.8s linear infinite;
    display: none;
}

.withdrawalPayment_popup .btn-primary.loading .loading-spinner {
    display: block;
}

.withdrawalPayment_popup .btn-primary.loading .btn-text {
    display: none;
}

.withdrawalPayment_popup .success-message {
    background: #d4edda;
    border: 2px solid #28a745;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    display: none;
}

.withdrawalPayment_popup .success-message.show {
    display: block;
}

.withdrawalPayment_popup .success-icon {
    font-size: 2em;
    margin-bottom: 15px;
}

.withdrawalPayment_popup .success-title {
    font-size: 1.3em;
    font-weight: 700;
    color: #155724;
    margin-bottom: 8px;
}

.withdrawalPayment_popup .success-text {
    font-size: 0.95em;
    color: #155724;
    line-height: 1.5;
}

/* ================= KEYFRAMES ================= */

@keyframes withdrawal_fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes withdrawal_slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes withdrawal_spin {
    to { transform: rotate(360deg); }
}

/* ================= RESPONSIVE ================= */

@media (max-width: 640px) {
    .withdrawalPayment_popup .modal {
        max-height: 95vh;
    }

    .withdrawalPayment_popup .modal-header {
        padding: 25px 20px;
    }

    .withdrawalPayment_popup .modal-title {
        font-size: 1.5em;
    }

    .withdrawalPayment_popup .balance-amount {
        font-size: 1.8em;
    }

    .withdrawalPayment_popup .modal-body {
        padding: 20px;
    }

    .withdrawalPayment_popup .modal-actions {
        flex-direction: column;
    }

    .withdrawalPayment_popup .btn {
        width: 100%;
    }
}

/* ================= SCROLLBAR ================= */

.withdrawalPayment_popup .modal::-webkit-scrollbar {
    width: 8px;
}

.withdrawalPayment_popup .modal::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.withdrawalPayment_popup .modal::-webkit-scrollbar-thumb {
    background: #d0d7de;
    border-radius: 4px;
}

.withdrawalPayment_popup .modal::-webkit-scrollbar-thumb:hover {
    background: #b0b7be;
}
@media (max-width: 476px) { 
    .withdrawalPayment_popup .info-item {
        font-size: 12px;
    }
    .withdrawalPayment_popup .checkbox-label {
            font-size: 10px;
            text-align: left;
    }
    .withdrawalPayment_popup .security-note {
            font-size: 10px;
            line-height: 1.5;
    }
}
a .payout-btn {
        width: 300px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
}
// withdrawal payment css



</style>

   <!-- Start of InnerBanner -->
        <section class="inner-banner contact-banner">
            <div class="contact_child">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="h1-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
                                Royalty Collection
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of InnerBanner -->

        <!-- uplaod section -->
        <section class="secRoyalty">
            <div class="container">
                <!-- Stats Overview -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stats-icon">
                            <h2>Total Streams</h2>
                            <lord-icon src="https://cdn.lordicon.com/hmabmtlg.json" trigger="loop" delay="2000"
                                colors="primary:#7166ee,secondary:#110a5c">
                            </lord-icon>
                        </div>
                        <div>
                            <p>3.2M</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stats-icon">
                            <h2>Total Earnings</h2>
                            <lord-icon src="https://cdn.lordicon.com/ecngpoqo.json" trigger="loop" delay="2000"
                                colors="primary:#7166ee,secondary:#110a5c">
                            </lord-icon>
                        </div>
                        <div>
                            <p>$45,230</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stats-icon">
                            <h2>Pending Payout</h2>
                            <lord-icon src="https://cdn.lordicon.com/dhzbkemf.json" trigger="loop"
                                colors="primary:#7166ee,secondary:#110a5c">
                            </lord-icon>
                        </div>
                        <div>
                            <p>$4,500</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stats-icon">
                            <h2>Last Payout</h2>
                            <lord-icon src="https://cdn.lordicon.com/bsdkzyjd.json" trigger="loop" delay="2000"
                                colors="primary:#7166ee,secondary:#7166ee">
                            </lord-icon>
                        </div>
                        <div>
                            <p>June 15, 2025</p>

                        </div>
                    </div>
                </div>

                <!-- Monthly Chart -->
                <section class="secGraph">
                <div class="container">
                    <div class="dashboard">
                        <div class="graph-container">
                            <div class="graph-header">
                                <h2 class="graph-title">Monthly Earnings</h2>
                                <div class="time-filters">
                                    <button class="filter-btn" data-period="3">3M</button>
                                    <button class="filter-btn active" data-period="6">6M</button>
                                    <button class="filter-btn" data-period="12">1Y</button>
                                    <button class="filter-btn" data-period="all">All</button>
                                </div>
                            </div>

                            <div class="chart-wrapper">
                                <canvas id="earningsChart"></canvas>
                            </div>

                            <div class="earnings-summary">
                                <div class="summary-item">
                                    <div class="summary-label">Average Monthly</div>
                                    <div class="summary-value">$7,538</div>
                                    <div class="summary-change positive">↑ 12.5%</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">Highest Month</div>
                                    <div class="summary-value">$9,800</div>
                                    <div class="summary-change">December</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">Growth Rate</div>
                                    <div class="summary-value">+18%</div>
                                    <div class="summary-change positive">↑ vs last period</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">Total Revenue</div>
                                    <div class="summary-value">$45.2K</div>
                                    <div class="summary-change">Last 6 months</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </section>

                <!-- Payout Section -->
                <div class="payout-section py-4">
                    <h2>Request Payout</h2>
                    <button class="payout-btn" onclick="openModall()">Withdraw Funds</button>
                </div>
                <div class="withdrawalPayment_popup">
                    {{--<button class="demo-trigger" >Open Withdraw Funds</button>--}}
                    <div class="modal-overlay" id="withdrawModal">
                        <div class="modal">
                            <div class="modal-header">
                                <button class="modal-close" onclick="closeModall()">×</button>
                                <h2 class="modal-title">Withdraw Funds</h2>
                                <p class="modal-subtitle">Request payout from your available balance</p>
                                
                                <div class="balance-display">
                                    <div class="balance-label">Available Balance</div>
                                    <div class="balance-amount" id="availableBalance">£1,250.00</div>
                                </div>
                            </div>

                            <div class="modal-body">
                                <div id="withdrawForm">
                                    <div class="form-section">
                                        <label class="form-label required">Withdrawal Amount</label>
                                        <div class="input-wrapper">
                                            <span class="currency-symbol">£</span>
                                            <input 
                                                type="number" 
                                                class="form-input" 
                                                id="withdrawAmount" 
                                                placeholder="0.00"
                                                min="10"
                                                step="0.01"
                                            >
                                        </div>
                                        <p class="helper-text">Minimum withdrawal: £10.00</p>
                                        <p class="error-text" id="amountError">Please enter a valid amount</p>
                                        <button class="auto-fill-btn" onclick="fillFullBalance()">Withdraw Full Balance</button>
                                    </div>

                                    <div class="form-section">
                                        <label class="form-label required">Payout Method</label>
                                        <select class="form-select" id="payoutMethod" onchange="updateAccountDetails()">
                                            <option value="">Select payout method</option>
                                            <option value="bank">Bank Transfer</option>
                                            <option value="paypal">PayPal</option>
                                            <option value="wise">Wise (TransferWise)</option>
                                        </select>

                                        <div class="account-info" id="accountInfo" style="display: none;">
                                            <div class="account-info-row">
                                                <span class="account-info-label">Account:</span>
                                                <span class="account-info-value" id="accountDisplay">••••••1234</span>
                                            </div>
                                            <div class="account-info-row">
                                                <span class="account-info-label">Account Name:</span>
                                                <span class="account-info-value">Luna Starlight</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="info-card">
                                        <div class="info-card-title">Processing Information</div>
                                        <div class="info-item">
                                            <span class="info-label">Processing Time:</span>
                                            <span class="info-value">3–5 business days</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Platform Fee (2%):</span>
                                            <span class="info-value" id="platformFee">£0.00</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Net Amount:</span>
                                            <span class="info-value highlight" id="netAmount">£0.00</span>
                                        </div>
                                    </div>

                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="confirmCheckbox">
                                        <label class="checkbox-label" for="confirmCheckbox">
                                            I confirm that the payout details are correct and understand that this withdrawal request cannot be cancelled once submitted.
                                        </label>
                                    </div>

                                    <div class="security-note">
                                        🔒 For your protection, withdrawals may be reviewed by our security team. Large withdrawals may require additional verification.
                                    </div>

                                    <div class="modal-actions">
                                        <button class="btn btn-secondary" onclick="closeModall()">Cancel</button>
                                        <button class="btn btn-primary" id="submitBtn" onclick="submitWithdrawal()">
                                            <span class="loading-spinner"></span>
                                            <span class="btn-text">Submit Withdrawal Request</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="success-message" id="successMessage">
                                    <div class="success-icon">✅</div>
                                    <div class="success-title">Withdrawal Request Submitted!</div>
                                    <p class="success-text">
                                        Your withdrawal request of <strong id="successAmount">£0.00</strong> has been submitted successfully. 
                                        The funds will be processed within 3–5 business days and sent to your selected payout method.
                                    </p>
                                    <button class="btn btn-primary" onclick="closeModall()" style="margin-top: 20px;">Done</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               {{--
                <div class="payment-popup">
                    <!-- <button class="withdraw-btn" >
                        Withdraw Funds
                    </button> -->
                    <div class="overlay" id="overlay" onclick="closePopup(event)">
                        <div class="popup" onclick="event.stopPropagation()">
                            <div class="popup-header">
                                <h2 class="popup-title">Withdraw Funds</h2>
                                <button class="close-btn" onclick="closePopup()">&times;</button>
                            </div>

                            <div class="amount-section">
                                <div class="amount-label">Amount to withdraw</div>
                                <input type="number" class="amount-input" placeholder="0.00" min="1" step="0.01">
                            </div>

                            <div class="payment-methods">
                                <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon paypal">PP</div>
                                    <div class="payment-info">
                                        <h3>PayPal</h3>
                                        <p>Instant transfer to your PayPal account</p>
                                    </div>
                                </div>

                                <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon cashapp">CA</div>
                                    <div class="payment-info">
                                        <h3>Cash App</h3>
                                        <p>Direct deposit to your Cash App</p>
                                    </div>
                                </div>

                                <!-- <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon venmo">V</div>
                                    <div class="payment-info">
                                        <h3>Venmo</h3>
                                        <p>Send to your Venmo account</p>
                                    </div>
                                </div> -->

                                <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon bank">BT</div>
                                    <div class="payment-info">
                                        <h3>Bank Transfer</h3>
                                        <p>2-3 business days to your bank</p>
                                    </div>
                                </div>

                                <!-- <div class="payment-method" onclick="selectMethod(this)">
                                    <div class="payment-icon crypto">₿</div>
                                    <div class="payment-info">
                                        <h3>Cryptocurrency</h3>
                                        <p>Bitcoin, Ethereum, or other crypto</p>
                                    </div>
                                </div> -->
                            </div>

                            <div class="withdraw-action">
                                <button class="btn-cancel" onclick="closePopup()">Cancel</button>
                                <button class="btn-confirm" onclick="processWithdraw()">Confirm Withdrawal</button>
                            </div>
                        </div>
                    </div>
                </div>
                --}} 

                <!-- Payout History -->
                <div class="payout-history">
                    <h2 style="margin-bottom: 10px;">Payout History</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>June 15, 2025</td>
                                <td>$5,000</td>
                                <td>Completed</td>
                            </tr>
                            <tr>
                                <td>May 10, 2025</td>
                                <td>$3,200</td>
                                <td>Completed</td>
                            </tr>
                            <tr>
                                <td>April 6, 2025</td>
                                <td>$2,750</td>
                                <td>Completed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="/payout-history">
                 <button class="payout-btn mt-4">View All</button>
                </a>
            </div>
        </section>
        <!-- uplaod section -->


        <!-- upload section -->
        <div class="container py-5">
            <div class="upload-container">
                <div class="upload-header mb-5">
                    <h2 style="text-align: center;">Upload Your Music & Videos</h2>
                    <!-- <p>Effortlessly upload to major platforms like YouTube, Spotify, iTunes, TikTok, and more.</p> -->
                </div>

                {{-- Success/Error messages will be shown via SweetAlert --}}

                <form method="POST" action="{{ route('artist.music.upload') }}" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    
                   
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-8">
                            <div class="upload-box" style="text-align: center; padding: 20px;">
                                <div style="color: white; margin-bottom: 15px; font-size: 18px; font-weight: 600;">
                                    🎵 Music Name *
                                </div>
                                <input type="text" 
                                       class="form-control" 
                                       id="musicName" 
                                       name="name" 
                                       placeholder="Enter your music/song name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       style="padding: 12px; border-radius: 8px; border: none; background: rgba(255, 255, 255, 0.1); color: white; font-size: 16px; text-align: center; width: 100%; max-width: 400px; margin: 0 auto;"
                                       onfocus="this.style.background='rgba(255, 255, 255, 0.2)'; this.style.outline='none';"
                                       onblur="this.style.background='rgba(255, 255, 255, 0.1)';">
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 py-4">
                            <div class="upload-box">
                            <div style="color: white;">🎵 Upload Music File *</div>
                                <input type="file" name="music_file" id="musicInput" accept="audio/*" style="display:none;" required />
                                <button type="button" class="upload-btn" id="musicSelectBtn" onclick="document.getElementById('musicInput').click();">
                                Select Music
                            </button>

                            <div id="musicPreviewContainer"
                                style="margin-top:15px; position:relative; display:inline-block;width: 100%;display: flex;justify-content: center;">
                                <audio id="musicPreview" controls style="display:none; border-radius:10px;"></audio>
                                    <button type="button" id="closeMusicBtn"
                                    style="display: block; position: absolute; top: -12px; right: 0px; background: #9f54f5; color: white; border: none; border-radius: 50%; width: 25px; height: 25px; cursor: pointer; display: flex; justify-content: center; align-items: center; display: none;">
                                    ×
                                </button>
                                </div>
                            </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 py-4">
                            <div class="upload-box">
                            <div style="color: white;">📹 Upload Video File (Optional)</div>
                                <input type="file" name="video_file" id="videoInput" accept="video/*" style="display: none;" />
                                <button type="button" class="upload-btn" id="videoSelectBtn" onclick="document.getElementById('videoInput').click();">
                                Select Video
                            </button>

                            <div id="previewContainer"
                                    style="margin-top:15px; position:relative; display:inline-block; width: 100%; display: flex; justify-content: center;">
                                <video id="videoPreview" width="300" controls
                                    style="display:none; border-radius:10px;"></video>
                                    <button type="button" id="closeBtn"
                                    style="position: absolute;top: -10px; right: 0px; background: rgb(137, 108, 179);color: white; border: none; border-radius: 50%; width: 29px; height: 29px; cursor: pointer; display: block; justify-content: center; align-items: baseline; display: none;">
                                    ×
                                </button>
                                </div>
                            </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 py-4">
                            <div class="upload-box">
                            <div style="color: white;">🖼️ Upload Thumbnail *</div>
                                <input type="file" name="thumbnail_image" id="thumbInput" accept="image/*" style="display:none;" required />
                                <button type="button" class="upload-btn" id="thumbSelectBtn" onclick="document.getElementById('thumbInput').click();">
                                Select Thumbnail
                            </button>

                            <div id="thumbPreviewContainer"
                                style="margin-top:15px; position:relative; display:flex; justify-content:center; width:100%;">
                                <img id="thumbPreview"
                                    style="display:none; max-width:200px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.2);" />
                                    <button type="button" id="closeThumbBtn" style="display:none; position:absolute; top:-11px; right:0px;
                   background:#9f54f5; color:white; border:none; border-radius:50%;
                   width:25px; height:25px; cursor:pointer; display:flex;
                   justify-content:center; align-items:center; display: none;">
                                    ×
                                </button>
                            </div>
                            </div>
                        </div>
                            </div>

                    <div class="row justify-content-center mt-4">
                        <div class="col-12 text-center">
                            <button type="submit" class="upload-btn" style="padding: 15px 40px; font-size: 18px;  color: white; border: none; border-radius: 8px; cursor: pointer;">
                                Upload Files
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>


        <section class="artWork">
            <div class="container">
                <div class="header">
                    <h1>Artwork & Photo Upload</h1>
                    <p>Upload your album artwork, promotional photos, and graphics, so your visual identity shines just
                        as brightly as your music.</p>
                </div>

                {{-- Success/Error messages will be shown via SweetAlert --}}

                <form method="POST" action="{{ route('artist.artwork.upload') }}" enctype="multipart/form-data" id="artworkForm">
                    @csrf
                <div class="upload-area" id="uploadArea">
                    <div class="upload-icon">📁</div>
                    <div class="upload-text">Drag & drop your files here or</div>
                        <div class="upload-subtext">Support for multiple files (JPEG, PNG, GIF, WebP)</div>
                        <input type="file" id="fileInput" name="images[]" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp,image/avif" multiple style="display: none;" />
                    <button type="button" class="browse-btn" onclick="document.getElementById('fileInput').click();">
                        Browse Files
                    </button>

                    <div class="preview-gallery" id="previewGallery"></div>
                        
                        <div class="text-center mt-4" id="uploadButtonContainer" style="display: none;">
                            <button type="submit" class="upload-btn" style="padding: 15px 40px; font-size: 18px;  color: white; border: none; border-radius: 8px; cursor: pointer;">
                                Upload Artwork
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </section>

        <section class="artworkUploaded-Sec py-5">
            <div class="container">
                <div class="gallery-header">
                <h1>Our Uploaded Artwork</h1>
                    <p>A curated collection of artworks shared by creators.</p>

                </div>

                <div class="gallery-grid">
                    @forelse($artworkPhotos as $index => $artwork)
                        <div class="gallery-item gallery-item22" data-index="{{ $index }}">
                            <img src="{{ $artwork->image_url }}" alt="Artwork {{ $index + 1 }}" onerror="this.src='https://via.placeholder.com/400x400?text=Image+Not+Found'">
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No artwork uploaded yet. Upload your first artwork above!</p>
                        </div>
                    @endforelse
                </div>
                <div>
                <a href="/all-artwork">
                    <button class="artAllBtn mt-4">View All</button>
                </a>
                </div>
            </div>

            <div class="modal" id="modal22">
                <div class="close-button" id="closeBtn22"></div>
                <div class="nav-button prev" id="prevBtn22"></div>
                <div class="nav-button next" id="nextBtn22"></div>
                <div class="modal-content">
                <img class="modal-image" id="modalImage22" src="" alt="">
                <div class="modal-info">
                    <div class="modal-title" id="modalTitle22"></div>
                    <div class="modal-subtitle" id="modalSubtitle22"></div>
                </div>
                </div>
            </div>
        </section>
    
        <section class="album-banner mb-5">
            <div class="container-fulid">
                <div class="album-image">
                    <div class="back-img" style="background-image: url({{asset('FrontendAssets/images/singWithMe/music&video.jpg')}});">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="album-details">
                            <div class="title">
                                @php
                                    $totalListeners = \App\Models\ArtistMusic::where('driver_id', auth()->id())->sum('listeners');
                                    $formattedListeners = $totalListeners >= 1000000 ? 
                                        round($totalListeners / 1000000, 1) . 'M' : 
                                        ($totalListeners >= 1000 ? round($totalListeners / 1000, 1) . 'K' : $totalListeners);
                                @endphp
                                <h2 class="h1-title">{{ auth()->user()->name }}</h2>
                                <span class="small-text">{{ $formattedListeners }} monthly listeners</span>
                            </div>

                            <div class="album-songs-detail">
                                <div class="popular-songs">
                                    <h4>popular songs</h4>
                                    <ul class="single-albums-list-box">
                                        @php
                                            $topMusics = \App\Models\ArtistMusic::where('driver_id', auth()->id())
                                                ->orderBy('listeners', 'desc')
                                                ->take(3)
                                                ->get();
                                        @endphp
                                        
                                        @forelse($topMusics as $index => $music)
                                            <li class="music-list-box {{ $index === 0 ? 'current_play' : '' }}">
                                            <div class="songs-name">
                                                <div class="back-img"
                                                        style="background-image: url({{ $music->thumbnail_image_url ?: asset('FrontendAssets/images/default-music.jpg') }});">
                                                </div>
                                                <h3 class="h3-title">
                                                        {{ $music->name }}
                                                </h3>
                                            </div>
                                            <div class="audio-box ">
                                                <div class="music-controls play play_btn">
                                                        <div data-id="{{ $music->id }}" class="music-controls-item">
                                                        <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                                        </div>
                                                </div>
                                            </div>
                                        </li>
                                        @empty
                                        <li class="music-list-box">
                                            <div class="songs-name">
                                                <div class="back-img"
                                                        style="background-image: url({{asset('FrontendAssets/images/default-music.jpg')}});">
                                                    </div>
                                                    <h3 class="h3-title">
                                                        No music uploaded yet
                                                    </h3>
                                            </div>
                                            <div class="audio-box ">
                                                <div class="music-controls play play_btn">
                                                        <div class="music-controls-item">
                                                            <i class="fas fa-plus music-controls-item--icon play-icon"></i>
                                                        </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="similar-artists">
                                    <h4>similar artists</h4>
                                    <ul>
                                        <li>
                                            <div class="songs-name similar-artists-box">
                                                <a href="javascript:void(0)">
                                                    <div class="back-img"
                                                        style="background-image: url({{asset('FrontendAssets/images/vishnu-r-nair.jpg')}});">
                                                    </div>
                                                    <div class="similar-artists-text">
                                                        <h3 class="h3-title">vishnu r nair</h3>
                                                        <span class="small-text">1.9M monthly listeners</span>
                                                    </div>
                                                </a>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="songs-name similar-artists-box">
                                                <a href="javascript:void(0)">
                                                    <div class="back-img"
                                                        style="background-image: url({{asset('FrontendAssets/images/slim-emcee.jpg')}});">
                                                    </div>
                                                    <div class="similar-artists-text">
                                                        <h3 class="h3-title">slim emcee</h3>
                                                        <span class="small-text">1.8M monthly listeners</span>
                                                    </div>
                                                </a>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="songs-name similar-artists-box">
                                                <a href="javascript:void(0)">
                                                    <div class="back-img"
                                                        style="background-image: url({{asset('FrontendAssets/images/joshua-fuller.jpg')}});">
                                                    </div>
                                                    <div class="similar-artists-text">
                                                        <h3 class="h3-title">joshua fuller</h3>
                                                        <span class="small-text">1.7M monthly listeners</span>
                                                    </div>
                                                </a>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="music_content ">
                                @php
                                    $topMusic = \App\Models\ArtistMusic::where('driver_id', auth()->id())
                                        ->orderBy('listeners', 'desc')
                                        ->first();
                                @endphp
                                <div class="music-info">
                                    <h2 class="music-name">{{ $topMusic->name ?? 'No Music' }}</h2>
                                    <p class="music-artist">{{ auth()->user()->name }}</p>
                                </div>
                                <audio id="audio1" data-id="{{ $topMusic->id ?? 'default' }}" src="{{ $topMusic->music_file_url ?? asset('FrontendAssets/songs/default-music.mp3') }}"></audio>
                                <div class="music-progress">
                                    <div id="progress-bar" class="music-progress-bar"></div>
                                    <div class="music-progress__time">
                                        <span class="music-progress__time-item music-current-time">00:00</span>
                                        <span class="music-progress__time-item music-duration-time">00:00</span>
                                    </div>
                                </div>
                                <div class="music-controls music-controls-single-albums">
                                    <div class="music-controls-item play">
                                        <i class="fas fa-play music-controls-item--icon play-icon"></i>
                                        <div class="play-icon-background"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    




        <!-- Track Collaboration Section -->
        <section class="collaboration-section py-5" style="background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="collaboration-header text-center mb-5">
                            <h2 style="color: #fbfbfb; font-size: 2.5rem; margin-bottom: 15px;">Track Collaborations & Revenue Split</h2>
                            <p style="color: #b8a8d0; font-size: 1.1rem;">Manage collaborative tracks and split ownership percentages for fair revenue distribution</p>
                        </div>

                        <!-- Create Collaboration Form -->
                        <div class="collaboration-card mb-4" style="background: rgba(45, 27, 78, 0.6); border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 30px; margin-bottom: 30px;">
                            <h3 style="color: #fbfbfb; margin-bottom: 20px; font-size: 1.8rem;">
                                <i class="fas fa-users" style="margin-right: 10px; color: #b794f6;"></i>
                                Create New Collaboration
                            </h3>
                            
                            <form id="collaborationForm" method="POST" action="">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Select Track *</label>
                                        <select name="music_id" id="collaboration_music_id" class="form-control" required style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 12px; border-radius: 8px;">
                                            <option value="">-- Select a track --</option>
                                            @foreach($musics as $music)
                                                <option value="{{ $music->id }}" data-has-collab="{{ $music->collaboration ? '1' : '0' }}">
                                                    {{ $music->name }} 
                                                    @if($music->collaboration)
                                                        <span style="color: #b794f6;">(Has Collaboration)</span>
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Collaboration Type *</label>
                                        <select name="collaboration_type" id="collaboration_type" class="form-control" required style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 12px; border-radius: 8px;">
                                            <option value="collaboration">Collaboration</option>
                                            <option value="feature">Feature</option>
                                            <option value="remix">Remix</option>
                                            <option value="producer">Producer</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Collaborators Section -->
                                <div class="collaborators-container">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label style="color: #b8a8d0; font-size: 1.1rem; font-weight: 600;">Collaborators & Ownership Split</label>
                                        <button type="button" class="btn btn-sm" id="addCollaboratorBtn" style="background: #b794f6; color: white; border: none; padding: 8px 20px; border-radius: 6px; cursor: pointer;">
                                            <i class="fas fa-plus"></i> Add Collaborator
                                        </button>
                                    </div>

                                    <div id="collaboratorsList">
                                        <!-- Collaborators will be added dynamically here -->
                                    </div>

                                    <div class="ownership-summary mt-3" style="background: rgba(183, 148, 246, 0.1); padding: 15px; border-radius: 8px; border: 1px solid rgba(183, 148, 246, 0.3);">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong style="color: #b794f6;">Primary Artist (You):</strong>
                                                <span id="primaryArtistOwnership" style="color: #fbfbfb; font-size: 1.2rem; font-weight: bold; margin-left: 10px;">100%</span>
                                            </div>
                                            <div class="col-md-6">
                                                <strong style="color: #b794f6;">Total Collaborators Share:</strong>
                                                <span id="totalCollaboratorsShare" style="color: #fbfbfb; font-size: 1.2rem; font-weight: bold; margin-left: 10px;">0%</span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div id="ownershipStatus" style="color: #f1c40f; font-weight: 600;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn" id="submitCollaborationBtn" style="background: linear-gradient(135deg, #b794f6, #9d50bb); color: white; border: none; padding: 12px 40px; font-size: 1.1rem; border-radius: 8px; cursor: pointer; font-weight: 600;">
                                        <i class="fas fa-save"></i> Create Collaboration
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Existing Collaborations -->
                        <div class="collaborations-list">
                            <h3 style="color: #fbfbfb; margin-bottom: 25px; font-size: 1.8rem;">
                                <i class="fas fa-list" style="margin-right: 10px; color: #b794f6;"></i>
                                My Collaborations
                            </h3>

                            @forelse($collaborations as $collaboration)
                                <div class="collaboration-item mb-4" style="background: rgba(45, 27, 78, 0.6); border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 25px;">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h4 style="color: #fbfbfb; margin-bottom: 10px;">
                                                <i class="fas fa-music" style="color: #b794f6; margin-right: 10px;"></i>
                                                {{ $collaboration->music->name }}
                                            </h4>
                                            <div style="color: #b8a8d0; margin-bottom: 15px;">
                                                <span class="badge" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; padding: 5px 12px; border-radius: 20px; margin-right: 10px;">
                                                    {{ ucfirst($collaboration->collaboration_type) }}
                                                </span>
                                                <span class="badge" style="background: {{ $collaboration->status === 'active' ? 'rgba(0, 242, 254, 0.3)' : 'rgba(241, 196, 15, 0.3)' }}; color: {{ $collaboration->status === 'active' ? '#00f2fe' : '#f1c40f' }}; padding: 5px 12px; border-radius: 20px;">
                                                    {{ ucfirst($collaboration->status) }}
                                                </span>
                                            </div>
                                            
                                            <!-- Ownership Splits -->
                                            <div class="ownership-splits mt-3">
                                                <h5 style="color: #b794f6; font-size: 1rem; margin-bottom: 10px;">Ownership Distribution:</h5>
                                                <div class="row">
                                                    @foreach($collaboration->ownershipSplits as $split)
                                                        <div class="col-md-6 mb-2">
                                                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px; background: rgba(183, 148, 246, 0.1); border-radius: 6px;">
                                                                <span style="color: #fbfbfb;">
                                                                    {{ $split->artist->name }}
                                                                    @if($split->is_primary)
                                                                        <span style="color: #b794f6;">(Primary)</span>
                                                                    @endif
                                                                </span>
                                                                <span style="color: #b794f6; font-weight: bold; font-size: 1.1rem;">
                                                                    {{ number_format($split->ownership_percentage, 2) }}%
                                                                </span>
                                                            </div>
                                                            @if(!$split->is_primary && !$split->approved_by_artist && $split->artist_id === auth()->id())
                                                                <form method="POST" action="{{ route('artist.collaborations.approve-split', ['collaborationId' => $collaboration->id, 'splitId' => $split->id]) }}" style="display: inline; margin-top: 5px;">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm" style="background: #00f2fe; color: #0f0c29; border: none; padding: 5px 15px; border-radius: 5px; font-size: 0.85rem;">
                                                                        Approve
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 text-end">
                                            <!-- Revenue Summary -->
                                            @php
                                                $userRevenue = $collaboration->revenueDistributions->where('artist_id', auth()->id())->sum('artist_share_after_split');
                                                $userOwnership = $collaboration->ownershipSplits->where('artist_id', auth()->id())->first()->ownership_percentage ?? 0;
                                            @endphp
                                            <div style="background: rgba(0, 242, 254, 0.1); padding: 15px; border-radius: 8px; border: 1px solid rgba(0, 242, 254, 0.3);">
                                                <div style="color: #b8a8d0; font-size: 0.9rem; margin-bottom: 5px;">Your Ownership</div>
                                                <div style="color: #00f2fe; font-size: 1.5rem; font-weight: bold; margin-bottom: 10px;">
                                                    {{ number_format($userOwnership, 2) }}%
                                                </div>
                                                <div style="color: #b8a8d0; font-size: 0.9rem; margin-bottom: 5px;">Total Earnings</div>
                                                <div style="color: #fbfbfb; font-size: 1.3rem; font-weight: bold;">
                                                    ${{ number_format($userRevenue, 2) }}
                                                </div>
                                            </div>
                                            
                                            <a href="{{ route('artist.collaborations.show', $collaboration->id) }}" class="btn mt-3" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; border: 1px solid rgba(183, 148, 246, 0.5); padding: 8px 20px; border-radius: 6px; text-decoration: none; display: inline-block; width: 100%;">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5" style="background: rgba(45, 27, 78, 0.6); border: 1px solid rgba(183, 148, 246, 0.3); border-radius: 15px; padding: 40px;">
                                    <i class="fas fa-users" style="font-size: 3rem; color: #b794f6; margin-bottom: 20px; opacity: 0.5;"></i>
                                    <p style="color: #b8a8d0; font-size: 1.1rem;">No collaborations yet. Create your first collaboration above!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                console.log("DOM loaded, initializing file upload functionality...");

                // File upload preview functionality
                const musicInput = document.getElementById("musicInput");
                const musicPreview = document.getElementById("musicPreview");
                const closeMusicBtn = document.getElementById("closeMusicBtn");

                const videoInput = document.getElementById("videoInput");
                const videoPreview = document.getElementById("videoPreview");
                const closeBtn = document.getElementById("closeBtn");

                const thumbInput = document.getElementById("thumbInput");
                const thumbPreview = document.getElementById("thumbPreview");
                const closeThumbBtn = document.getElementById("closeThumbBtn");

                console.log("Elements found:", {
                    musicInput: !!musicInput,
                    videoInput: !!videoInput,
                    thumbInput: !!thumbInput
                });

                if (musicInput) {
                    console.log("Setting up music input handler");
                    musicInput.addEventListener("change", function(e) {
                        console.log("Music file selected");
                        const file = e.target.files[0];
                        if (file) {
                            console.log("Music file:", file.name, file.type);
                            const url = URL.createObjectURL(file);
                            if (musicPreview) {
                                musicPreview.src = url;
                                musicPreview.style.display = "block";
                            }
                            if (closeMusicBtn) {
                                closeMusicBtn.style.display = "flex";
                            }
                        }
                    });

                    if (closeMusicBtn) {
                        closeMusicBtn.addEventListener("click", function(e) {
                            e.preventDefault();
                            console.log("Closing music preview");
                            if (musicPreview) {
                                musicPreview.pause();
                                musicPreview.src = "";
                                musicPreview.style.display = "none";
                            }
                            closeMusicBtn.style.display = "none";
                            musicInput.value = "";
                        });
                    }
                }

                // Video file handling
                if (videoInput) {
                    console.log("Setting up video input handler");
                    videoInput.addEventListener("change", function(e) {
                        console.log("Video file selected");
                        const file = e.target.files[0];
                        if (file) {
                            console.log("Video file:", file.name, file.type);
                            const url = URL.createObjectURL(file);
                            if (videoPreview) {
                                videoPreview.src = url;
                                videoPreview.style.display = "block";
                            }
                            if (closeBtn) {
                                closeBtn.style.display = "flex";
                            }
                        }
                    });

                    if (closeBtn) {
                        closeBtn.addEventListener("click", function(e) {
                            e.preventDefault();
                            console.log("Closing video preview");
                            if (videoPreview) {
                                videoPreview.pause();
                                videoPreview.src = "";
                                videoPreview.style.display = "none";
                            }
                            closeBtn.style.display = "none";
                            videoInput.value = "";
                        });
                    }
                }

                // Thumbnail file handling
                if (thumbInput) {
                    console.log("Setting up thumbnail input handler");
                    thumbInput.addEventListener("change", function(e) {
                        console.log("Thumbnail file selected");
                        const file = e.target.files[0];
                        if (file) {
                            console.log("Thumbnail file:", file.name, file.type);
                            const url = URL.createObjectURL(file);
                            if (thumbPreview) {
                                thumbPreview.src = url;
                                thumbPreview.style.display = "block";
                            }
                            if (closeThumbBtn) {
                                closeThumbBtn.style.display = "flex";
                            }
                        }
                    });

                    if (closeThumbBtn) {
                        closeThumbBtn.addEventListener("click", function(e) {
                            e.preventDefault();
                            console.log("Closing thumbnail preview");
                            if (thumbPreview) {
                                thumbPreview.src = "";
                                thumbPreview.style.display = "none";
                            }
                            closeThumbBtn.style.display = "none";
                            thumbInput.value = "";
                        });
                    }
                }

                // Form submission with AJAX and SweetAlert
                const uploadForm = document.getElementById("uploadForm");
                if (uploadForm) {
                    console.log("Setting up form submission handler");
                    uploadForm.addEventListener("submit", function(e) {
                        e.preventDefault();
                        console.log("Form submitted");
                        
                        // Validate required fields
                        const musicName = document.getElementById("musicName").value.trim();
                        const musicFile = document.getElementById("musicInput").files.length;
                        const thumbnailFile = document.getElementById("thumbInput").files.length;
                        
                        if (!musicName) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Please enter a music name.',
                                confirmButtonColor: '#9f54f5',
                                background: '#1a1a1a',
                                color: 'white',
                                confirmButtonText: 'OK'
                            });
                            return false;
                        }
                        
                        if (musicFile === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Please select a music file.',
                                confirmButtonColor: '#9f54f5',
                                background: '#1a1a1a',
                                color: 'white',
                                confirmButtonText: 'OK'
                            });
                            return false;
                        }
                        
                        if (thumbnailFile === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Please select a thumbnail image.',
                                confirmButtonColor: '#9f54f5',
                                background: '#1a1a1a',
                                color: 'white',
                                confirmButtonText: 'OK'
                            });
                            return false;
                        }
                        
                        const submitBtn = this.querySelector('button[type="submit"]');
                        const originalText = submitBtn.innerHTML;
                        
                        // Show loading state
                        submitBtn.innerHTML = 'Uploading...';
                        submitBtn.disabled = true;
                        
                        // Create FormData
                        const formData = new FormData(this);
                        
                        // Submit via AJAX
                        fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Music uploaded successfully!',
                                    confirmButtonColor: '#9f54f5',
                                    background: '#1a1a1a',
                                    color: 'white',
                                    confirmButtonText: 'OK',
                                    timer: 3000,
                                    timerProgressBar: true
                                }).then(() => {
                                    // Reset form
                                    this.reset();
                                    // Hide previews
                                    document.getElementById('musicPreview').style.display = 'none';
                                    document.getElementById('videoPreview').style.display = 'none';
                                    document.getElementById('thumbPreview').style.display = 'none';
                                    document.getElementById('closeMusicBtn').style.display = 'none';
                                    document.getElementById('closeBtn').style.display = 'none';
                                    document.getElementById('closeThumbBtn').style.display = 'none';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upload Failed',
                                    text: data.message || 'An error occurred during upload.',
                                    confirmButtonColor: '#9f54f5',
                                    background: '#1a1a1a',
                                    color: 'white',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload Failed',
                                text: 'An error occurred during upload. Please try again.',
                                confirmButtonColor: '#9f54f5',
                                background: '#1a1a1a',
                                color: 'white',
                                confirmButtonText: 'OK'
                            });
                        })
                        .finally(() => {
                            // Reset button state
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                    });
                }

                const audio = document.getElementById("audio1");
                const playBtns = document.querySelectorAll(".play_btn, .music-controls-single-albums .play");
                const progressBar = document.getElementById("progress-bar");
                const currentTimeEl = document.querySelector(".music-current-time");
                const durationTimeEl = document.querySelector(".music-duration-time");
                const musicName = document.querySelector(".music-name");
                const musicArtist = document.querySelector(".music-artist");

                if (audio && playBtns.length > 0) {
                    console.log("Setting up music player");

                    // Get dynamic songs data from the database
                    const songs = {
                        @php
                            $topMusics = \App\Models\ArtistMusic::where('driver_id', auth()->id())
                                ->orderBy('listeners', 'desc')
                                ->take(3)
                                ->get();
                        @endphp
                        
                        @foreach($topMusics as $music)
                            {{ $music->id }}: {
                                name: "{{ $music->name }}",
                                artist: "{{ auth()->user()->name }}",
                                src: "{{ $music->music_file_url ?: asset('FrontendAssets/songs/default-music.mp3') }}"
                            },
                        @endforeach
                    };

                    let isPlaying = false;

                    function formatTime(seconds) {
                        const mins = Math.floor(seconds / 60);
                        const secs = Math.floor(seconds % 60);
                        return `${mins}:${secs < 10 ? "0" + secs : secs}`;
                    }

                    function loadSong(song) {
                        if (musicName) musicName.textContent = song.name;
                        if (musicArtist) musicArtist.textContent = song.artist;
                        audio.src = song.src;
                        audio.load();
                    }

                    function togglePlay(btn) {
                        if (!isPlaying) {
                            audio.play();
                            isPlaying = true;
                            btn.querySelector("i").classList.remove("fa-play");
                            btn.querySelector("i").classList.add("fa-pause");
                        } else {
                            audio.pause();
                            isPlaying = false;
                            btn.querySelector("i").classList.remove("fa-pause");
                            btn.querySelector("i").classList.add("fa-play");
                        }
                    }

                    audio.addEventListener("timeupdate", function () {
                        if (audio.duration && progressBar) {
                            let progress = (audio.currentTime / audio.duration) * 100;
                            progressBar.style.width = `${progress}%`;
                            if (currentTimeEl) currentTimeEl.textContent = formatTime(audio.currentTime);
                            if (durationTimeEl) durationTimeEl.textContent = formatTime(audio.duration);
                        }
                    });

                    const musicProgress = document.querySelector(".music-progress");
                    if (musicProgress) {
                        musicProgress.addEventListener("click", function (e) {
                            let width = this.clientWidth;
                            let clickX = e.offsetX;
                            let duration = audio.duration;
                            audio.currentTime = (clickX / width) * duration;
                        });
                    }

                    playBtns.forEach(btn => {
                        btn.addEventListener("click", function () {
                            const dataId = this.querySelector(".music-controls-item")?.dataset.id || this.dataset.id;
                            if (dataId && songs[dataId]) {
                                loadSong(songs[dataId]);
                            }
                            togglePlay(this);
                        });
                    });

                    audio.addEventListener("ended", function () {
                        isPlaying = false;
                        playBtns.forEach(btn => {
                            btn.querySelector("i").classList.remove("fa-pause");
                            btn.querySelector("i").classList.add("fa-play");
                        });
                    });
                }

                // Artwork upload functionality
                const fileInput = document.getElementById("fileInput");
                const previewGallery = document.getElementById("previewGallery");
                const uploadButtonContainer = document.getElementById("uploadButtonContainer");
                const uploadArea = document.getElementById("uploadArea");

                if (fileInput && previewGallery) {
                    console.log("Setting up artwork upload functionality");

                    // File input change handler
                    fileInput.addEventListener("change", function(e) {
                        console.log("Artwork files selected");
                        const files = Array.from(e.target.files);
                        
                        if (files.length > 0) {
                            console.log("Processing", files.length, "artwork files");
                            
                            // Clear previous previews
                            previewGallery.innerHTML = "";
                            
                            files.forEach((file, index) => {
                                if (file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const previewItem = document.createElement('div');
                                        previewItem.className = 'preview-item';
                                        previewItem.style.cssText = `
                                            position: relative;
                                            display: inline-block;
                                            margin: 10px;
                                            border-radius: 8px;
                                            overflow: hidden;
                                            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                                        `;
                                        
                                        previewItem.innerHTML = `
                                            <img src="${e.target.result}" style="width: 150px; height: 150px; object-fit: cover; display: block;">
                                            <button type="button" class="remove-preview" style="
                                                position: absolute;
                                                top: 5px;
                                                right: 5px;
                                                background: #dc3545;
                                                color: white;
                                                border: none;
                                                border-radius: 50%;
                                                width: 25px;
                                                height: 25px;
                                                cursor: pointer;
                                                font-size: 14px;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                            " onclick="removePreview(this, ${index})">×</button>
                                        `;
                                        
                                        previewGallery.appendChild(previewItem);
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });
                            
                            // Show upload button
                            uploadButtonContainer.style.display = 'block';
                        }
                    });

                    // Drag and drop functionality
                    uploadArea.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        uploadArea.style.backgroundColor = '#f8f9fa';
                    });

                    uploadArea.addEventListener('dragleave', function(e) {
                        e.preventDefault();
                        uploadArea.style.backgroundColor = '';
                    });

                    uploadArea.addEventListener('drop', function(e) {
                        e.preventDefault();
                        uploadArea.style.backgroundColor = '';
                        
                        const files = Array.from(e.dataTransfer.files);
                        const imageFiles = files.filter(file => file.type.startsWith('image/'));
                        
                        if (imageFiles.length > 0) {
                            // Create a new FileList-like object
                            const dt = new DataTransfer();
                            imageFiles.forEach(file => dt.items.add(file));
                            fileInput.files = dt.files;
                            
                            // Trigger change event
                            fileInput.dispatchEvent(new Event('change'));
                        }
                    });

                    // Form submission handler with AJAX and SweetAlert
                    const artworkForm = document.getElementById("artworkForm");
                    if (artworkForm) {
                        artworkForm.addEventListener("submit", function(e) {
                            e.preventDefault();
                            console.log("Artwork form submitted");
                            
                            const submitBtn = this.querySelector('button[type="submit"]');
                            const originalText = submitBtn.innerHTML;
                            
                            // Show loading state
                            submitBtn.innerHTML = 'Uploading...';
                            submitBtn.disabled = true;
                            
                            // Create FormData
                            const formData = new FormData(this);
                            
                            // Submit via AJAX
                            fetch(this.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Artwork uploaded successfully!',
                                        confirmButtonColor: '#9f54f5',
                                        background: '#1a1a1a',
                                        color: 'white',
                                        confirmButtonText: 'OK',
                                        timer: 3000,
                                        timerProgressBar: true
                                    }).then(() => {
                                        // Reset form and clear previews
                                        this.reset();
                                        previewGallery.innerHTML = '';
                                        uploadButtonContainer.style.display = 'none';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Upload Failed',
                                        text: data.message || 'An error occurred during upload.',
                                        confirmButtonColor: '#9f54f5',
                                        background: '#1a1a1a',
                                        color: 'white',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upload Failed',
                                    text: 'An error occurred during upload. Please try again.',
                                    confirmButtonColor: '#9f54f5',
                                    background: '#1a1a1a',
                                    color: 'white',
                                    confirmButtonText: 'OK'
                                });
                            })
                            .finally(() => {
                                // Reset button state
                                submitBtn.innerHTML = originalText;
                                submitBtn.disabled = false;
                            });
                        });
                    }
                }

                // Function to remove preview items
                window.removePreview = function(button, index) {
                    console.log("Removing preview item", index);
                    const previewItem = button.parentElement;
                    previewItem.remove();
                    
                    // Check if any previews remain
                    const remainingPreviews = previewGallery.querySelectorAll('.preview-item');
                    if (remainingPreviews.length === 0) {
                        uploadButtonContainer.style.display = 'none';
                        fileInput.value = '';
                    }
                };

                console.log("File upload functionality initialized");
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', () => {

                const artworkModal = document.getElementById('modal22');
                const artworkModalImage = document.getElementById('modalImage22');
                const artworkModalTitle = document.getElementById('modalTitle22');
                const artworkModalSubtitle = document.getElementById('modalSubtitle22');
                const artworkCloseBtn = document.getElementById('closeBtn22');
                const artworkPrevBtn = document.getElementById('prevBtn22');
                const artworkNextBtn = document.getElementById('nextBtn22');
                const artworkGalleryItems = document.querySelectorAll('.gallery-item22');

                if (!artworkModal || !artworkGalleryItems.length) return;

                let artworkCurrentIndex = 0;

                artworkGalleryItems.forEach((item, index) => {
                    item.addEventListener('click', () => openArtworkModal(index));
                });

                function openArtworkModal(index) {
                    artworkCurrentIndex = index;
                    updateArtworkModalContent();
                    artworkModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }

                function closeArtworkModal() {
                    artworkModal.classList.remove('active');
                    document.body.style.overflow = '';
                }

                function updateArtworkModalContent() {
                    const currentItem = artworkGalleryItems[artworkCurrentIndex];
                    const img = currentItem.querySelector('img');

                    if (img) artworkModalImage.src = img.src;
                    if (artworkModalTitle) artworkModalTitle.textContent = 'Artwork ' + (artworkCurrentIndex + 1);
                    if (artworkModalSubtitle) artworkModalSubtitle.textContent = '';
                }

                function showNextArtwork() {
                    artworkCurrentIndex = (artworkCurrentIndex + 1) % artworkGalleryItems.length;
                    updateArtworkModalContent();
                }

                function showPrevArtwork() {
                    artworkCurrentIndex = (artworkCurrentIndex - 1 + artworkGalleryItems.length) % artworkGalleryItems.length;
                    updateArtworkModalContent();
                }

                artworkCloseBtn?.addEventListener('click', closeArtworkModal);
                artworkPrevBtn?.addEventListener('click', showPrevArtwork);
                artworkNextBtn?.addEventListener('click', showNextArtwork);

                artworkModal.addEventListener('click', (e) => {
                    if (e.target === artworkModal) closeArtworkModal();
                });

                document.addEventListener('keydown', (e) => {
                    if (!artworkModal.classList.contains('active')) return;

                    if (e.key === 'Escape') closeArtworkModal();
                    if (e.key === 'ArrowLeft') showPrevArtwork();
                    if (e.key === 'ArrowRight') showNextArtwork();
                });

            });
        </script>

        <script>
            //withdrawal payment popup js

            const availableBalance = 1250.00;

            function openModall() {
                document.getElementById('withdrawModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeModall() {
                document.getElementById('withdrawModal').classList.remove('active');
                document.body.style.overflow = 'auto';
                resetForm();
            }

            function fillFullBalance() {
                document.getElementById('withdrawAmount').value = availableBalance.toFixed(2);
                calculateFees();
            }

            function updateAccountDetails() {
                const method = document.getElementById('payoutMethod').value;
                const accountInfo = document.getElementById('accountInfo');
                const accountDisplay = document.getElementById('accountDisplay');

                if (method) {
                    accountInfo.style.display = 'block';
                    
                    switch(method) {
                        case 'bank':
                            accountDisplay.textContent = 'UK Bank ••••1234';
                            break;
                        case 'paypal':
                            accountDisplay.textContent = 'luna••••@email.com';
                            break;
                        case 'wise':
                            accountDisplay.textContent = 'Wise ••••5678';
                            break;
                    }
                } else {
                    accountInfo.style.display = 'none';
                }
            }

            function calculateFees() {
                const amount = parseFloat(document.getElementById('withdrawAmount').value) || 0;
                const fee = amount * 0.02;
                const net = amount - fee;

                document.getElementById('platformFee').textContent = '£' + fee.toFixed(2);
                document.getElementById('netAmount').textContent = '£' + net.toFixed(2);
            }

            document.getElementById('withdrawAmount').addEventListener('input', calculateFees);

            function validateForm() {
                const amount = parseFloat(document.getElementById('withdrawAmount').value);
                const method = document.getElementById('payoutMethod').value;
                const confirmed = document.getElementById('confirmCheckbox').checked;
                const amountInput = document.getElementById('withdrawAmount');
                const amountError = document.getElementById('amountError');

                let isValid = true;

                // Validate amount
                if (!amount || amount < 10 || amount > availableBalance) {
                    amountInput.classList.add('error');
                    amountError.classList.add('show');
                    
                    if (amount > availableBalance) {
                        amountError.textContent = 'Amount exceeds available balance';
                    } else {
                        amountError.textContent = 'Please enter a valid amount (minimum £10.00)';
                    }
                    isValid = false;
                } else {
                    amountInput.classList.remove('error');
                    amountError.classList.remove('show');
                }

                // Validate method
                if (!method) {
                    alert('Please select a payout method');
                    isValid = false;
                }

                // Validate confirmation
                if (!confirmed) {
                    alert('Please confirm that the payout details are correct');
                    isValid = false;
                }

                return isValid;
            }

            function submitWithdrawal() {
                if (!validateForm()) {
                    return;
                }

                const submitBtn = document.getElementById('submitBtn');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    const amount = parseFloat(document.getElementById('withdrawAmount').value);
                    const net = amount - (amount * 0.02);
                    
                    document.getElementById('successAmount').textContent = '£' + net.toFixed(2);
                    document.getElementById('withdrawForm').style.display = 'none';
                    document.getElementById('successMessage').classList.add('show');
                    
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                }, 2000);
            }

            function resetForm() {
                document.getElementById('withdrawAmount').value = '';
                document.getElementById('payoutMethod').value = '';
                document.getElementById('confirmCheckbox').checked = false;
                document.getElementById('accountInfo').style.display = 'none';
                document.getElementById('platformFee').textContent = '£0.00';
                document.getElementById('netAmount').textContent = '£0.00';
                document.getElementById('withdrawForm').style.display = 'block';
                document.getElementById('successMessage').classList.remove('show');
                document.getElementById('withdrawAmount').classList.remove('error');
                document.getElementById('amountError').classList.remove('show');
            }

            // Close modal on overlay click
            document.getElementById('withdrawModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModall();
                }
            });

            // ============================================
            // TRACK COLLABORATION MANAGEMENT
            // ============================================
            
            let collaboratorCount = 0;
            const artistsList = @json(\App\Models\User::where('is_artist', true)->where('id', '!=', auth()->id())->get(['id', 'name', 'email']));

            // Add Collaborator Button
            document.getElementById('addCollaboratorBtn')?.addEventListener('click', function() {
                addCollaboratorRow();
            });

            // Update form action when music is selected
            document.getElementById('collaboration_music_id')?.addEventListener('change', function() {
                const musicId = this.value;
                const form = document.getElementById('collaborationForm');
                if (musicId && form) {
                    form.action = `/artist/music/${musicId}/collaboration`;
                }
                
                // Check if track already has collaboration
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.dataset.hasCollab === '1') {
                    alert('This track already has a collaboration. Please select another track.');
                    this.value = '';
                    form.action = '';
                }
            });

            function addCollaboratorRow() {
                collaboratorCount++;
                const container = document.getElementById('collaboratorsList');
                
                const row = document.createElement('div');
                row.className = 'collaborator-row mb-3';
                row.id = `collaborator_${collaboratorCount}`;
                row.style.cssText = 'background: rgba(183, 148, 246, 0.1); padding: 15px; border-radius: 8px; border: 1px solid rgba(183, 148, 246, 0.3);';
                
                row.innerHTML = `
                    <div class="row align-items-end">
                        <div class="col-md-5">
                            <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Artist *</label>
                            <select name="artists[${collaboratorCount}][artist_id]" class="form-control collaborator-artist-select" required style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 10px; border-radius: 6px;">
                                <option value="">-- Select Artist --</option>
                                ${artistsList.map(artist => `<option value="${artist.id}">${artist.name} (${artist.email})</option>`).join('')}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Ownership % *</label>
                            <input type="number" name="artists[${collaboratorCount}][ownership_percentage]" 
                                   class="form-control ownership-input" 
                                   step="0.01" min="0" max="100" 
                                   required 
                                   style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 10px; border-radius: 6px;"
                                   class="ownership-input-dynamic">
                        </div>
                        <div class="col-md-3">
                            <label style="color: #b8a8d0; margin-bottom: 8px; display: block;">Role</label>
                            <input type="text" name="artists[${collaboratorCount}][role]" 
                                   placeholder="e.g., Featured Artist"
                                   style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(183, 148, 246, 0.3); color: #fbfbfb; padding: 10px; border-radius: 6px; width: 100%;">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm remove-collaborator" 
                                    onclick="removeCollaborator(${collaboratorCount})"
                                    style="background: rgba(255, 75, 43, 0.3); color: #ff4b2b; border: 1px solid rgba(255, 75, 43, 0.5); padding: 10px; border-radius: 6px; cursor: pointer; width: 100%;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `;
                
                container.appendChild(row);
                
                // Add event listener to the new input
                const newInput = row.querySelector('.ownership-input-dynamic');
                if (newInput) {
                    newInput.addEventListener('input', updateOwnershipSummary);
                    newInput.addEventListener('change', updateOwnershipSummary);
                }
                
                updateOwnershipSummary();
            }


            // Make functions globally accessible
            window.updateOwnershipSummary = function() {
                const ownershipInputs = document.querySelectorAll('.ownership-input');
                let totalCollaboratorsShare = 0;
                
                ownershipInputs.forEach(input => {
                    const value = parseFloat(input.value) || 0;
                    totalCollaboratorsShare += value;
                });

                const primaryArtistOwnership = 100 - totalCollaboratorsShare;
                
                const totalShareEl = document.getElementById('totalCollaboratorsShare');
                const primaryOwnershipEl = document.getElementById('primaryArtistOwnership');
                const statusDiv = document.getElementById('ownershipStatus');
                const submitBtn = document.getElementById('submitCollaborationBtn');
                
                if (totalShareEl) totalShareEl.textContent = totalCollaboratorsShare.toFixed(2) + '%';
                if (primaryOwnershipEl) primaryOwnershipEl.textContent = primaryArtistOwnership.toFixed(2) + '%';
                
                if (statusDiv && submitBtn) {
                    if (Math.abs(totalCollaboratorsShare - 100) < 0.01) {
                        statusDiv.innerHTML = '<i class="fas fa-check-circle" style="color: #00f2fe;"></i> <span style="color: #00f2fe;">Perfect! Total ownership is 100%</span>';
                        submitBtn.disabled = false;
                        submitBtn.style.opacity = '1';
                    } else if (totalCollaboratorsShare > 100) {
                        statusDiv.innerHTML = '<i class="fas fa-exclamation-triangle" style="color: #ff4b2b;"></i> <span style="color: #ff4b2b;">Total ownership exceeds 100%! Please adjust percentages.</span>';
                        submitBtn.disabled = true;
                        submitBtn.style.opacity = '0.5';
                    } else {
                        statusDiv.innerHTML = '<i class="fas fa-info-circle" style="color: #f1c40f;"></i> <span style="color: #f1c40f;">Remaining: ' + primaryArtistOwnership.toFixed(2) + '% will be assigned to you (Primary Artist)</span>';
                        submitBtn.disabled = false;
                        submitBtn.style.opacity = '1';
                    }
                }
            };

            window.removeCollaborator = function(id) {
                const row = document.getElementById(`collaborator_${id}`);
                if (row) {
                    row.remove();
                    updateOwnershipSummary();
                }
            };

            // Form submission
            document.getElementById('collaborationForm')?.addEventListener('submit', function(e) {
                const musicId = document.getElementById('collaboration_music_id').value;
                if (!musicId) {
                    e.preventDefault();
                    alert('Please select a track first.');
                    return false;
                }

                const totalShare = parseFloat(document.getElementById('totalCollaboratorsShare').textContent);
                if (totalShare > 100) {
                    e.preventDefault();
                    alert('Total ownership percentage cannot exceed 100%.');
                    return false;
                }

                if (collaboratorCount === 0) {
                    e.preventDefault();
                    alert('Please add at least one collaborator.');
                    return false;
                }
            });

            // Add event listeners to all ownership inputs (event delegation)
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('ownership-input') || e.target.classList.contains('ownership-input-dynamic')) {
                    updateOwnershipSummary();
                }
            });

            // Initialize ownership summary
            setTimeout(() => {
                updateOwnershipSummary();
            }, 100);
            //withdrawal payment popup js
        </script>

        

    

        

    