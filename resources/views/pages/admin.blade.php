@extends('layouts.app')

@section('title', 'Admin Dashboard - NulliCarbon')

@section('content')
<div class="admin-dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2 class="logo"><img src="images/daunjatuh.png" alt="" style="height: 45px;"> NulliCarbon</h2>
            <p class="role-badge">Admin Panel</p>
        </div>

        <nav class="sidebar-nav">
            <a href="#" class="nav-item active">
                <span class="nav-icon">📊</span>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">💳</span>
                <span class="nav-text">Payments</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">👥</span>
                <span class="nav-text">Users</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">🌱</span>
                <span class="nav-text">Programs</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">📈</span>
                <span class="nav-text">Analytics</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon">⚙️</span>
                <span class="nav-text">Settings</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="admin-profile">
                <div class="admin-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                <div class="admin-info">
                    <p class="admin-name">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="admin-email">{{ Auth::user()->email ?? 'admin@nullicarbon.com' }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="content-header">
            <div>
                <h1 class="page-title">Dashboard Overview</h1>
                <p class="page-subtitle">Welcome back, {{ Auth::user()->name ?? 'Admin' }}! Here's what's happening today.</p>
            </div>
            <div class="header-actions">
                <button class="btn-icon" title="Notifications">
                    <span class="notification-badge">5</span>
                    🔔
                </button>
                <button class="btn-icon" title="Messages">
                    <span class="notification-badge">2</span>
                    ✉️
                </button>
            </div>
        </header>

        <!-- Stats Cards -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-icon blue">💰</span>
                    <span class="stat-trend up">+12.5%</span>
                </div>
                <h3 class="stat-value">Rp {{ number_format(45750000, 0, ',', '.') }}</h3>
                <p class="stat-label">Total Revenue</p>
                <div class="stat-chart">
                    <div class="mini-bar" style="height: 40%"></div>
                    <div class="mini-bar" style="height: 65%"></div>
                    <div class="mini-bar" style="height: 45%"></div>
                    <div class="mini-bar" style="height: 80%"></div>
                    <div class="mini-bar" style="height: 95%"></div>
                    <div class="mini-bar" style="height: 70%"></div>
                    <div class="mini-bar" style="height: 100%"></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-icon green">🌍</span>
                    <span class="stat-trend up">+8.2%</span>
                </div>
                <h3 class="stat-value">3,050 kg</h3>
                <p class="stat-label">Carbon Offset This Month</p>
                <div class="stat-chart">
                    <div class="mini-bar" style="height: 60%"></div>
                    <div class="mini-bar" style="height: 75%"></div>
                    <div class="mini-bar" style="height: 55%"></div>
                    <div class="mini-bar" style="height: 90%"></div>
                    <div class="mini-bar" style="height: 85%"></div>
                    <div class="mini-bar" style="height: 95%"></div>
                    <div class="mini-bar" style="height: 100%"></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-icon purple">👥</span>
                    <span class="stat-trend up">+24</span>
                </div>
                <h3 class="stat-value">1,245</h3>
                <p class="stat-label">Total Users</p>
                <div class="stat-chart">
                    <div class="mini-bar" style="height: 50%"></div>
                    <div class="mini-bar" style="height: 70%"></div>
                    <div class="mini-bar" style="height: 60%"></div>
                    <div class="mini-bar" style="height: 85%"></div>
                    <div class="mini-bar" style="height: 75%"></div>
                    <div class="mini-bar" style="height: 90%"></div>
                    <div class="mini-bar" style="height: 100%"></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-icon orange">📝</span>
                    <span class="stat-trend down">-3.1%</span>
                </div>
                <h3 class="stat-value">89</h3>
                <p class="stat-label">Pending Payments</p>
                <div class="stat-chart">
                    <div class="mini-bar" style="height: 100%"></div>
                    <div class="mini-bar" style="height: 85%"></div>
                    <div class="mini-bar" style="height: 90%"></div>
                    <div class="mini-bar" style="height: 70%"></div>
                    <div class="mini-bar" style="height: 60%"></div>
                    <div class="mini-bar" style="height: 55%"></div>
                    <div class="mini-bar" style="height: 50%"></div>
                </div>
            </div>
        </section>

        <!-- Charts Section -->
        <section class="charts-section">
            <div class="chart-card large">
                <div class="card-header">
                    <h2 class="card-title">Revenue Overview</h2>
                    <div class="card-actions">
                        <button class="btn-filter active">Week</button>
                        <button class="btn-filter">Month</button>
                        <button class="btn-filter">Year</button>
                    </div>
                </div>
                <div class="chart-placeholder">
                    <svg viewBox="0 0 600 250" class="line-chart">
                        <polyline
                            points="0,200 85,180 170,120 255,140 340,80 425,100 510,40 595,60"
                            fill="none"
                            stroke="#556B2F"
                            stroke-width="3"
                        />
                        <polyline
                            points="0,200 85,180 170,120 255,140 340,80 425,100 510,40 595,60"
                            fill="url(#gradient)"
                            opacity="0.3"
                        />
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#556B2F;stop-opacity:0.8" />
                                <stop offset="100%" style="stop-color:#556B2F;stop-opacity:0" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>

            <div class="chart-card">
                <div class="card-header">
                    <h2 class="card-title">Program Distribution</h2>
                </div>
                <div class="program-stats">
                    <div class="program-item">
                        <div class="program-info">
                            <span class="program-icon">💧</span>
                            <span class="program-name">Water Turbine</span>
                        </div>
                        <span class="program-percentage">35%</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 35%; background: #4A90E2;"></div>
                        </div>
                    </div>
                    <div class="program-item">
                        <div class="program-info">
                            <span class="program-icon">🌿</span>
                            <span class="program-name">Mangrove</span>
                        </div>
                        <span class="program-percentage">28%</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 28%; background: #556B2F;"></div>
                        </div>
                    </div>
                    <div class="program-item">
                        <div class="program-info">
                            <span class="program-icon">♻️</span>
                            <span class="program-name">Waste Recycling</span>
                        </div>
                        <span class="program-percentage">22%</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 22%; background: #50C878;"></div>
                        </div>
                    </div>
                    <div class="program-item">
                        <div class="program-info">
                            <span class="program-icon">🪸</span>
                            <span class="program-name">Coral Reef</span>
                        </div>
                        <span class="program-percentage">15%</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 15%; background: #FF6B6B;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Payments Table -->
        <section class="table-section">
            <div class="table-card">
                <div class="card-header">
                    <h2 class="card-title">Recent Payments</h2>
                    <a href="#" class="btn-link">View All →</a>
                </div>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Program</th>
                                <th>Amount</th>
                                <th>Carbon Offset</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="order-id">NC-A7B2C</span></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">J</div>
                                        <div>
                                            <div class="user-name">John Doe</div>
                                            <div class="user-email">john@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-green">🌿 Mangrove</span></td>
                                <td class="amount">Rp 450,000</td>
                                <td>30 kg CO₂</td>
                                <td><span class="status-badge status-success">Paid</span></td>
                                <td>Jan 6, 2026</td>
                                <td>
                                    <button class="btn-action" title="View Details">👁️</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order-id">NC-X9Y8Z</span></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">S</div>
                                        <div>
                                            <div class="user-name">Sarah Smith</div>
                                            <div class="user-email">sarah@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-blue">💧 Water Turbine</span></td>
                                <td class="amount">Rp 675,000</td>
                                <td>45 kg CO₂</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>Jan 6, 2026</td>
                                <td>
                                    <button class="btn-action" title="View Details">👁️</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order-id">NC-M3N4P</span></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">M</div>
                                        <div>
                                            <div class="user-name">Mike Johnson</div>
                                            <div class="user-email">mike@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-purple">♻️ Recycling</span></td>
                                <td class="amount">Rp 300,000</td>
                                <td>20 kg CO₂</td>
                                <td><span class="status-badge status-success">Paid</span></td>
                                <td>Jan 5, 2026</td>
                                <td>
                                    <button class="btn-action" title="View Details">👁️</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order-id">NC-Q5R6S</span></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">E</div>
                                        <div>
                                            <div class="user-name">Emma Wilson</div>
                                            <div class="user-email">emma@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-coral">🪸 Coral Reef</span></td>
                                <td class="amount">Rp 525,000</td>
                                <td>35 kg CO₂</td>
                                <td><span class="status-badge status-failed">Failed</span></td>
                                <td>Jan 5, 2026</td>
                                <td>
                                    <button class="btn-action" title="View Details">👁️</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="order-id">NC-T7U8V</span></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">D</div>
                                        <div>
                                            <div class="user-name">David Brown</div>
                                            <div class="user-email">david@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-green">🌿 Mangrove</span></td>
                                <td class="amount">Rp 750,000</td>
                                <td>50 kg CO₂</td>
                                <td><span class="status-badge status-success">Paid</span></td>
                                <td>Jan 4, 2026</td>
                                <td>
                                    <button class="btn-action" title="View Details">👁️</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.admin-dashboard {
    display: flex;
    min-height: 100vh;
    background: #f5f7f6;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

/* Sidebar */
.sidebar {
    width: 280px;
    background: linear-gradient(180deg, #556B2F 0%, #3d4f22 100%);
    color: white;
    display: flex;
    flex-direction: column;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
}

.sidebar-header {
    padding: 30px 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.logo {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 8px;
}

.role-badge {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.7);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.sidebar-nav {
    flex: 1;
    padding: 20px 0;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.nav-item:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.nav-item.active {
    background: rgba(255, 255, 255, 0.15);
    border-left-color: white;
    color: white;
}

.nav-icon {
    font-size: 20px;
}

.sidebar-footer {
    padding: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.admin-profile {
    display: flex;
    gap: 12px;
    margin-bottom: 16px;
}

.admin-avatar {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 700;
}

.admin-info {
    flex: 1;
}

.admin-name {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
}

.admin-email {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.7);
}

.btn-logout {
    width: 100%;
    padding: 10px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    color: white;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-logout:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Main Content */
.main-content {
    margin-left: 280px;
    flex: 1;
    padding: 30px;
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 30px;
}

.page-title {
    font-size: 32px;
    font-weight: 700;
    color: #2d3e1f;
    margin-bottom: 8px;
}

.page-subtitle {
    color: #6b7c5a;
    font-size: 15px;
}

.header-actions {
    display: flex;
    gap: 12px;
}

.btn-icon {
    width: 45px;
    height: 45px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.btn-icon:hover {
    background: #f9fafb;
    border-color: #556B2F;
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ef4444;
    color: white;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 10px;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-icon.blue { background: #dbeafe; }
.stat-icon.green { background: #dcfce7; }
.stat-icon.purple { background: #f3e8ff; }
.stat-icon.orange { background: #fed7aa; }

.stat-trend {
    font-size: 13px;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 6px;
}

.stat-trend.up {
    color: #16a34a;
    background: #dcfce7;
}

.stat-trend.down {
    color: #dc2626;
    background: #fee2e2;
}

.stat-value {
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 16px;
}

.stat-chart {
    display: flex;
    align-items: flex-end;
    gap: 4px;
    height: 50px;
}

.mini-bar {
    flex: 1;
    background: linear-gradient(180deg, #556B2F 0%, #6b8e3d 100%);
    border-radius: 4px 4px 0 0;
    opacity: 0.7;
    transition: all 0.3s ease;
}

.stat-card:hover .mini-bar {
    opacity: 1;
}

/* Charts Section */
.charts-section {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
    margin-bottom: 30px;
}

.chart-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.chart-card.large {
    grid-column: span 1;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.card-title {
    font-size: 18px;
    font-weight: 700;
    color: #1f2937;
}

.card-actions {
    display: flex;
    gap: 8px;
}

.btn-filter {
    padding: 6px 14px;
    background: #f3f4f6;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-filter.active {
    background: #556B2F;
    color: white;
}

.chart-placeholder {
    height: 250px;
}

.line-chart {
    width: 100%;
    height: 100%;
}

/* Program Stats */
.program-stats {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.program-item {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 12px;
    align-items: center;
}

.program-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.program-icon {
    font-size: 20px;
}

.program-name {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
}

.program-percentage {
    font-size: 14px;
    font-weight: 700;
    color: #556B2F;
    grid-column: 2;
    grid-row: 1;
}

.progress-bar {
    grid-column: 1 / -1;
    height: 8px;
    background: #f3f4f6;
    border-radius: 10px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: 10px;
    transition: width 0.6s ease;
}

/* Table Section */
.table-section {
    margin-bottom: 30px;
}

.table-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.btn-link {
    color: #556B2F;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
}

.btn-link:hover {
    text-decoration: underline;
}

.table-responsive {
    overflow-x: auto;
    margin-top: 20px;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    text-align: left;
    padding: 12px;
    background: #f9fafb;
    color: #6b7280;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.data-table td {
    padding: 16px 12px;
    border-top: 1px solid #f3f4f6;
    font-size: 14px;
}

.order-id {
    font-family: 'Courier New', monospace;
    font-weight: 600;
    color: #556B2F;
}

.user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: #556B2F;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

.user-name {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 2px;
}

.user-email {
    font-size: 12px;
    color: #9ca3af;
}

.badge {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.badge-green { background: #dcfce7; color: #16a34a; }
.badge-blue { background: #dbeafe; color: #2563eb; }
.badge-purple { background: #f3e8ff; color: #9333ea; }
.badge-coral { background: #fee2e2; color: #dc2626; }

.amount {
    font-weight: 700;
    color: #1f2937;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-success {
    background: #dcfce7;
    color: #16a34a;
}

.status-pending {
    background: #fef3c7;
    color: #d97706;
}

.status-failed {
    background: #fee2e2;
    color: #dc2626;
}

.btn-action {
    width: 35px;
    height: 35px;
    background: #f3f4f6;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 16px;
}

.btn-action:hover {
    background: #556B2F;
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 1200px) {
    .charts-section {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 968px) {
    .sidebar {
        width: 70px;
    }

    .main-content {
        margin-left: 70px;
    }

    .nav-text,
    .logo,
    .role-badge,
    .admin-info,
    .btn-logout span {
        display: none;
    }

    .sidebar-header,
    .sidebar-footer {
        text-align: center;
    }

    .nav-item {
        justify-content: center;
        padding: 14px;
    }

    .admin-profile {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .main-content {
        margin-left: 0;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .content-header {
        flex-direction: column;
        gap: 16px;
    }
}

@endsection