
<script src="{{asset('FrontendAssets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/popper.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/font-awesome.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/wow.min.js')}}"></script>
{{-- <script src="{{asset('FrontendAssets/js/music-controls.js')}}"></script> --}}
<script src="{{asset('FrontendAssets/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('FrontendAssets/js/custom.js')}}"></script>
<script src="{{asset('FrontendAssets/js/artwork.js')}}"></script>
<script src="{{asset('FrontendAssets/js/bottommusicPlayer.js')}}"></script>

<script src="https://cdn.lordicon.com/lordicon.js"></script>



    {{--garph js--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <script>
        const data6Months = {
            labels: ['July', 'August', 'September', 'October', 'November', 'December'],
            values: [6200, 6800, 7100, 7900, 8400, 9800]
        };

        const data3Months = {
            labels: ['October', 'November', 'December'],
            values: [7900, 8400, 9800]
        };

        const data12Months = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            values: [4200, 4800, 5100, 5500, 5900, 6000, 6200, 6800, 7100, 7900, 8400, 9800]
        };

        const dataAll = {
            labels: ['Q1 2024', 'Q2 2024', 'Q3 2024', 'Q4 2024'],
            values: [14200, 17400, 20100, 26100]
        };

        const ctx = document.getElementById('earningsChart').getContext('2d');
        
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(139, 92, 246, 0.4)');
        gradient.addColorStop(1, 'rgba(139, 92, 246, 0.01)');

        let chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data6Months.labels,
                datasets: [{
                    label: 'Earnings ($)',
                    data: data6Months.values,
                    borderColor: '#8b5cf6',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#8b5cf6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#8b5cf6',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1a1830',
                        titleColor: '#a0a0c0',
                        bodyColor: '#ffffff',
                        borderColor: '#8b5cf6',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return '$' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: 'rgba(139, 92, 246, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#a0a0c0',
                            callback: function(value) {
                                return '$' + (value / 1000) + 'K';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#a0a0c0'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Filter buttons
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const period = this.dataset.period;
                let newData;
                
                switch(period) {
                    case '3':
                        newData = data3Months;
                        break;
                    case '6':
                        newData = data6Months;
                        break;
                    case '12':
                        newData = data12Months;
                        break;
                    case 'all':
                        newData = dataAll;
                        break;
                }
                
                chart.data.labels = newData.labels;
                chart.data.datasets[0].data = newData.values;
                chart.update('active');
            });
        });
    </script>

    {{--garph js--}}

  <script>
        const CSRF_TOKEN = '{{ csrf_token() }}';
        let notificationsData = [];

        async function loadNotifications() {
            try {
                const response = await fetch('/api/notifications', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) return;
                const data = await response.json();
                if (!data.success || !Array.isArray(data.notifications)) return;

                notificationsData = data.notifications.map(n => {
                    const createdAt = n.created_at ? new Date(n.created_at) : new Date();
                    const time = createdAt.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    const date = createdAt.toLocaleString();
                    return {
                        id: n.id,
                        type: n.notification_type || n.type || 'system',
                        title: n.title || 'Notification',
                        message: n.message || '',
                        time,
                        date,
                        unread: !n.read_at && !n.is_read,
                    };
                });

                renderQuickNotifications();
                renderFullNotifications();
            } catch (e) {
                // fail silently
            }
        }

        // (Old static sample notifications removed; data now comes from /api/notifications)

        let currentFilter = 'all';

        // Get icon HTML based on type
        function getNotificationIcon(type) {
            const icons = {
                tip: '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>',
                subscription: '<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>',
                system: '<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>'
            };
            return icons[type] || icons.system;
        }

        // Render quick notifications (first 5)
        function renderQuickNotifications() {
            const quickList = document.getElementById('quickNotificationsList');
            const quickNotifications = notificationsData.slice(0, 5);
            
            quickList.innerHTML = quickNotifications.map(notif => `
                <div class="notification-item ${notif.unread ? 'unread' : ''}" onclick="markAsRead(${notif.id})" tabindex="0">
                    <div class="notification-content">
                        <div class="notification-icon ${notif.type}">
                            ${getNotificationIcon(notif.type)}
                        </div>
                        <div class="notification-body">
                            <div class="notification-title">${notif.title}</div>
                            <div class="notification-time">
                                ${notif.unread ? '<span class="unread-dot"></span>' : ''}
                                ${notif.time}
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');

            updateBadges();
        }

        // Render full notifications list
        function renderFullNotifications() {
            const fullList = document.getElementById('fullNotificationsList');
            let filteredNotifications = notificationsData;

            if (currentFilter === 'unread') {
                filteredNotifications = notificationsData.filter(n => n.unread);
            }

            if (filteredNotifications.length === 0) {
                fullList.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">🔔</div>
                        <div class="empty-state-text">No notifications to display</div>
                    </div>
                `;
                return;
            }

            fullList.innerHTML = filteredNotifications.map(notif => `
                <div class="full-notification-item ${notif.unread ? 'unread' : ''}" onclick="markAsRead(${notif.id})" tabindex="0">
                    <div class="full-notification-content">
                        <div class="notification-icon ${notif.type}">
                            ${getNotificationIcon(notif.type)}
                        </div>
                        <div class="full-notification-body">
                            <div class="full-notification-header">
                                <div class="full-notification-title">${notif.title}</div>
                                ${notif.unread ? '<span class="unread-dot"></span>' : ''}
                            </div>
                            <div class="full-notification-message">${notif.message}</div>
                            <div class="full-notification-date">${notif.date}</div>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Update badge counts
        function updateBadges() {
            const unreadCount = notificationsData.filter(n => n.unread).length;
            const badge = document.getElementById('notificationBadge');
            const headerBadge = document.getElementById('headerBadge');
            
            badge.textContent = unreadCount;
            badge.style.display = unreadCount > 0 ? 'flex' : 'none';
            
            headerBadge.textContent = unreadCount > 0 ? `${unreadCount} New` : '0 New';
        }

        // Toggle quick notifications popup
        function toggleQuickNotifications() {
            const popup = document.getElementById('quickNotifications');
            const bell = document.querySelector('.notification-bell');
            const isActive = popup.classList.contains('active');
            
            popup.classList.toggle('active');
            bell.classList.toggle('active');
            bell.setAttribute('aria-expanded', !isActive);
        }

        // Open full notifications modal
        function openFullNotifications() {
            document.getElementById('quickNotifications').classList.remove('active');
            document.querySelector('.notification-bell').classList.remove('active');
            document.getElementById('fullNotificationsModal').classList.add('active');
            renderFullNotifications();
            document.body.style.overflow = 'hidden';
        }

        // Close full notifications modal
        function closeFullNotifications() {
            document.getElementById('fullNotificationsModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        // Filter notifications
        function filterNotifications(filter) {
            currentFilter = filter;
            
            // Update active tab
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.filter === filter) {
                    btn.classList.add('active');
                }
            });
            
            renderFullNotifications();
        }

        // Mark single notification as read
        function markAsRead(id) {
            const notification = notificationsData.find(n => n.id === id);
            if (!notification) return;

            if (notification.unread) {
                notification.unread = false;
                fetch(`/api/notifications/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json',
                    },
                }).catch(() => {});
            }

            renderQuickNotifications();
            renderFullNotifications();
        }

        // Mark all as read
        function markAllAsRead() {
            if (!notificationsData.length) return;

            notificationsData.forEach(n => n.unread = false);
            fetch('/api/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json',
                },
            }).catch(() => {});

            renderQuickNotifications();
            renderFullNotifications();
        }

        // Clear all notifications
        function clearAllNotifications() {
            if (!notificationsData.length) return;
            if (!confirm('Are you sure you want to clear all notifications?')) return;

            const ids = notificationsData.map(n => n.id);
            notificationsData = [];

            Promise.all(ids.map(id =>
                fetch(`/api/notifications/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'Accept': 'application/json',
                    },
                }).catch(() => {})
            )).finally(() => {
                renderQuickNotifications();
                renderFullNotifications();
                closeFullNotifications();
            });
        }

        // Handle keyboard navigation
        function handleKeyPress(event, callback) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                callback();
            }
        }

        // Close popup when clicking outside
        document.addEventListener('click', function(e) {
            const popup = document.getElementById('quickNotifications');
            const bell = document.querySelector('.notification-bell');
            
            if (!popup.contains(e.target) && !bell.contains(e.target)) {
                popup.classList.remove('active');
                bell.classList.remove('active');
                bell.setAttribute('aria-expanded', 'false');
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('fullNotificationsModal');
                if (modal.classList.contains('active')) {
                    closeFullNotifications();
                }
                
                const popup = document.getElementById('quickNotifications');
                if (popup.classList.contains('active')) {
                    popup.classList.remove('active');
                    document.querySelector('.notification-bell').classList.remove('active');
                }
            }
        });

        // Initialize
        loadNotifications();
    </script>

@yield('script')
@yield('js')

