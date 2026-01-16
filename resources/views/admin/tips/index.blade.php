@extends('layouts.app.master')

@section('title', 'Tip Management')

@section('css')
<style>
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-paid { background: #cfe2ff; color: #084298; }
    .status-sent_to_artist { background: #d1e7dd; color: #0f5132; }
    .status-failed { background: #f8d7da; color: #842029; }
    .status-cancelled { background: #e2e3e5; color: #383d41; }
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .stats-card h5 {
        color: white;
        margin-bottom: 10px;
    }
    .stats-card .stat-value {
        font-size: 2em;
        font-weight: 700;
    }
</style>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Tip Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Tip Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <h5>Total Tips</h5>
                    <div class="stat-value">{{ $stats['total_tips'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <h5>Total Amount</h5>
                    <div class="stat-value">£{{ number_format($stats['total_amount'], 2) }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <h5>Pending Payment</h5>
                    <div class="stat-value">{{ $stats['pending_count'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                    <h5>Completed</h5>
                    <div class="stat-value">{{ $stats['sent_count'] }}</div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tips</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.tips.index') }}" class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Payment</option>
                                    <option value="sent_to_artist" {{ request('status') == 'sent_to_artist' ? 'selected' : '' }}>Completed</option>
                                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Artist</label>
                                <select name="artist_id" class="form-select">
                                    <option value="">All Artists</option>
                                    @foreach($artists as $artist)
                                        <option value="{{ $artist->id }}" {{ request('artist_id') == $artist->id ? 'selected' : '' }}>
                                            {{ $artist->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">User</label>
                                <select name="user_id" class="form-select">
                                    <option value="">All Users</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">Filter</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Artist</th>
                                        <th>Amount</th>
                                        <th>Platform Fee</th>
                                        <th>Total Paid</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Paid Date</th>
                                        <th>Sent Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tips as $tip)
                                    <tr>
                                        <td>#{{ $tip->id }}</td>
                                        <td>{{ $tip->user->name }}</td>
                                        <td>{{ $tip->artist->name }}</td>
                                        <td><strong>£{{ number_format($tip->amount, 2) }}</strong></td>
                                        <td>£{{ number_format($tip->platform_fee, 2) }}</td>
                                        <td>£{{ number_format($tip->total_amount, 2) }}</td>
                                        <td>{{ ucfirst(str_replace('-', ' ', $tip->payment_method)) }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $tip->status }}">
                                                {{ ucfirst(str_replace('_', ' ', $tip->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $tip->paid_at ? $tip->paid_at->format('M d, Y H:i') : '-' }}</td>
                                        <td>{{ $tip->sent_to_artist_at ? $tip->sent_to_artist_at->format('M d, Y H:i') : '-' }}</td>
                                        <td>
                                            @if($tip->status === 'pending')
                                                <span class="badge bg-warning">Awaiting Payment</span>
                                            @elseif($tip->status === 'sent_to_artist')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif($tip->status === 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @elseif($tip->status === 'cancelled')
                                                <span class="badge bg-secondary">Cancelled</span>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $tip->id }}">
                                                Details
                                            </button>
                                        </td>
                                    </tr>


                                    <!-- Details Modal -->
                                    <div class="modal fade" id="detailsModal{{ $tip->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tip Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Tip ID</th>
                                                            <td>#{{ $tip->id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>User</th>
                                                            <td>{{ $tip->user->name }} ({{ $tip->user->email }})</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Artist</th>
                                                            <td>{{ $tip->artist->name }} ({{ $tip->artist->email }})</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tip Amount</th>
                                                            <td>£{{ number_format($tip->amount, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Platform Fee (5%)</th>
                                                            <td>£{{ number_format($tip->platform_fee, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total Paid</th>
                                                            <td>£{{ number_format($tip->total_amount, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Payment Method</th>
                                                            <td>{{ ucfirst(str_replace('-', ' ', $tip->payment_method)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Payment ID</th>
                                                            <td>{{ $tip->payment_method_id ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status</th>
                                                            <td><span class="status-badge status-{{ $tip->status }}">{{ ucfirst(str_replace('_', ' ', $tip->status)) }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Paid Date</th>
                                                            <td>{{ $tip->paid_at ? $tip->paid_at->format('M d, Y H:i') : '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sent to Artist Date</th>
                                                            <td>{{ $tip->sent_to_artist_at ? $tip->sent_to_artist_at->format('M d, Y H:i') : '-' }}</td>
                                                        </tr>
                                                        @if($tip->user_message)
                                                        <tr>
                                                            <th>User Message</th>
                                                            <td>{{ $tip->user_message }}</td>
                                                        </tr>
                                                        @endif
                                                        @if($tip->admin_notes)
                                                        <tr>
                                                            <th>Admin Notes</th>
                                                            <td>{{ $tip->admin_notes }}</td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <th>Created At</th>
                                                            <td>{{ $tip->created_at->format('M d, Y H:i') }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @empty
                                    <tr>
                                        <td colspan="11" class="text-center">No tips found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $tips->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
