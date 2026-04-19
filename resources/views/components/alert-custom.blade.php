<style>
    /* Alert Success Styling */
    .alert-success-custom {
        display: flex !important;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background-color: #ecfdf5;
        border: 2px solid #86efac;
        border-radius: 12px;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.08);
    }

    .alert-success-custom.alert-hidden {
        display: none !important;
    }

    .alert-success-custom .alert-icon {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        color: #10b981;
    }

    .alert-success-custom .alert-message {
        flex: 1;
        color: #065f46;
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.5;
    }

    .alert-success-custom .btn-close-custom {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background-color: transparent;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: #10b981;
        transition: all 0.2s ease;
        padding: 0;
    }

    .alert-success-custom .btn-close-custom:hover {
        background-color: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .alert-success-custom .btn-close-custom:active {
        background-color: rgba(16, 185, 129, 0.15);
    }

    .alert-success-custom .close-icon {
        width: 18px;
        height: 18px;
    }
</style>

<div class="alert-success-custom" data-alert-dismissible>

    <!-- Icon -->
    <svg class="alert-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
    </svg>

    <!-- Message -->
    <span class="alert-message">{{ $slot ?? '✅ Sesi berhasil diaktifkan!' }}</span>

    <!-- Close Button -->
    <button type="button" class="btn-close-custom" aria-label="Close alert">
        <svg class="close-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>

<script>
(function() {
    'use strict';

    function initializeAlerts() {
        const alerts = document.querySelectorAll('[data-alert-dismissible]');

        alerts.forEach(alert => {
            let timeoutId;

            // Function to hide alert
            const hideAlert = () => {
                alert.classList.add('alert-hidden');
            };

            // Set auto-hide after 3 seconds
            timeoutId = setTimeout(hideAlert, 3000);

            // Close button handler
            const closeBtn = alert.querySelector('.btn-close-custom');
            if (closeBtn) {
                closeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    clearTimeout(timeoutId);
                    hideAlert();
                });
            }
        });
    }

    // Run immediately and on DOMContentLoaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeAlerts);
    } else {
        initializeAlerts();
    }
})();
</script>
