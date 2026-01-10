
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
        // Sample notifications data
        const notificationsData = [
            {
                id: 1,
                type: 'tip',
                title: 'New Vocal Mixing Technique',
                message: 'Learn how to create professional vocal chains with compression, EQ, and reverb. This comprehensive guide covers everything from recording to final mix.',
                time: '2 min ago',
                date: 'December 22, 2025 at 3:45 PM',
                unread: true
            },
            {
                id: 2,
                type: 'subscription',
                title: 'Premium Membership Activated',
                message: 'Your premium subscription is now active! Enjoy unlimited access to all features, exclusive content, and priority support.',
                time: '1 hour ago',
                date: 'December 22, 2025 at 2:15 PM',
                unread: true
            },
            {
                id: 3,
                type: 'system',
                title: 'New Release Available',
                message: 'Check out "Midnight Echoes" by Luna Starr - now streaming on all platforms. This album features 12 tracks of pure sonic magic.',
                time: '3 hours ago',
                date: 'December 22, 2025 at 12:30 PM',
                unread: true
            },
            {
                id: 4,
                type: 'tip',
                title: 'Master Your Bass Lines',
                message: 'Discover techniques for creating punchy, professional bass sounds that sit perfectly in your mix. Includes EQ, compression, and saturation tips.',
                time: '1 day ago',
                date: 'December 21, 2025 at 5:20 PM',
                unread: false
            },
            {
                id: 5,
                type: 'subscription',
                title: 'Payment Successful',
                message: 'Your payment of $9.99 has been processed successfully. Thank you for being a valued member of SingWithMe Records!',
                time: '2 days ago',
                date: 'December 20, 2025 at 11:00 AM',
                unread: false
            },
            {
                id: 6,
                type: 'system',
                title: 'Platform Update',
                message: 'We\'ve added new features including enhanced audio quality, collaborative playlists, and improved search functionality.',
                time: '3 days ago',
                date: 'December 19, 2025 at 9:15 AM',
                unread: false
            },
            {
                id: 7,
                type: 'tip',
                title: 'Recording Studio Hacks',
                message: 'Professional tips for setting up your home studio on a budget. Learn about room treatment, microphone placement, and essential gear.',
                time: '4 days ago',
                date: 'December 18, 2025 at 4:30 PM',
                unread: false
            },
            {
                id: 8,
                type: 'system',
                title: 'Community Spotlight',
                message: 'Your track "Summer Nights" has been featured in this week\'s community spotlight. Check it out and see the feedback from other artists!',
                time: '5 days ago',
                date: 'December 17, 2025 at 2:00 PM',
                unread: false
            }
        ];

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
            if (notification) {
                notification.unread = false;
                renderQuickNotifications();
                renderFullNotifications();
            }
        }

        // Mark all as read
        function markAllAsRead() {
            notificationsData.forEach(n => n.unread = false);
            renderQuickNotifications();
            renderFullNotifications();
        }

        // Clear all notifications
        function clearAllNotifications() {
            if (confirm('Are you sure you want to clear all notifications?')) {
                notificationsData.length = 0;
                renderQuickNotifications();
                renderFullNotifications();
                closeFullNotifications();
            }
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
        renderQuickNotifications();
    </script>

@yield('script')
@yield('js')

