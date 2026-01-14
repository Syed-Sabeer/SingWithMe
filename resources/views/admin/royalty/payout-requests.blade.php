@extends('layouts.app.master')

@section('title', 'Payout Requests')

@section('css')
<style>
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cfe2ff; color: #084298; }
    .status-completed { background: #d1e7dd; color: #0f5132; }
    .status-rejected { background: #f8d7da; color: #842029; }
</style>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Payout Requests</h3>
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
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.royalty.index') }}">Royalty</a>
                        </li>
                        <li class="breadcrumb-item active">Payout Requests</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
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

        <!-- Filters -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Payout Requests</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.royalty.payout-requests') }}" class="row g-3 mb-3">
                            <div class="col-md-4">
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
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
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
                                        <th>Artist</th>
                                        <th>Amount</th>
                                        <th>Available Balance</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Requested Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($requests as $request)
                                    <tr>
                                        <td>#{{ $request->id }}</td>
                                        <td>{{ $request->artist->name }}</td>
                                        <td><strong>${{ number_format($request->requested_amount, 2) }}</strong></td>
                                        <td>${{ number_format($request->available_balance, 2) }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $request->payout_method)) }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $request->status }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $request->requested_at->format('M d, Y') }}</td>
                                        <td>
                                            @if($request->status === 'pending')
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $request->id }}">
                                                    Approve
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $request->id }}">
                                                    Reject
                                                </button>
                                            @elseif($request->status === 'processing')
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#completeModal{{ $request->id }}">
                                                    Complete
                                                </button>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $request->id }}">
                                                Details
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Approve Modal -->
                                    <div class="modal fade" id="approveModal{{ $request->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.royalty.payout.approve', $request->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Approve Payout Request</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Artist:</strong> {{ $request->artist->name }}</p>
                                                        <p><strong>Amount:</strong> ${{ number_format($request->requested_amount, 2) }}</p>
                                                        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $request->payout_method)) }}</p>
                                                        <div class="mb-3">
                                                            <label class="form-label">Admin Notes</label>
                                                            <textarea name="admin_notes" class="form-control" rows="3"></textarea>
                                                        </div>
                                                        <div class="alert alert-warning">
                                                            This will deduct ${{ number_format($request->requested_amount, 2) }} from the artist's wallet.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Approve & Deduct</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal{{ $request->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.royalty.payout.reject', $request->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Reject Payout Request</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Artist:</strong> {{ $request->artist->name }}</p>
                                                        <p><strong>Amount:</strong> ${{ number_format($request->requested_amount, 2) }}</p>
                                                        <div class="mb-3">
                                                            <label class="form-label">Rejection Reason</label>
                                                            <textarea name="admin_notes" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Reject Request</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Complete Modal -->
                                    <div class="modal fade" id="completeModal{{ $request->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.royalty.payout.complete', $request->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Mark Payout as Completed</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Artist:</strong> {{ $request->artist->name }}</p>
                                                        <p><strong>Amount:</strong> ${{ number_format($request->requested_amount, 2) }}</p>
                                                        <div class="mb-3">
                                                            <label class="form-label">Transaction ID (Optional)</label>
                                                            <input type="text" name="transaction_id" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Mark as Completed</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Details Modal -->
                                    <div class="modal fade" id="detailsModal{{ $request->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Payout Request Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Request ID</th>
                                                            <td>#{{ $request->id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Artist</th>
                                                            <td>{{ $request->artist->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Requested Amount</th>
                                                            <td>${{ number_format($request->requested_amount, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Available Balance (at request)</th>
                                                            <td>${{ number_format($request->available_balance, 2) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Payment Method</th>
                                                            <td>{{ ucfirst(str_replace('_', ' ', $request->payout_method)) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Account Details</th>
                                                            <td>{{ $request->account_details }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status</th>
                                                            <td><span class="status-badge status-{{ $request->status }}">{{ ucfirst($request->status) }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Requested Date</th>
                                                            <td>{{ $request->requested_at->format('M d, Y H:i') }}</td>
                                                        </tr>
                                                        @if($request->processed_at)
                                                        <tr>
                                                            <th>Processed Date</th>
                                                            <td>{{ $request->processed_at->format('M d, Y H:i') }}</td>
                                                        </tr>
                                                        @endif
                                                        @if($request->artist_notes)
                                                        <tr>
                                                            <th>Artist Notes</th>
                                                            <td>{{ $request->artist_notes }}</td>
                                                        </tr>
                                                        @endif
                                                        @if($request->admin_notes)
                                                        <tr>
                                                            <th>Admin Notes</th>
                                                            <td>{{ $request->admin_notes }}</td>
                                                        </tr>
                                                        @endif
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
                                        <td colspan="8" class="text-center">No payout requests found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $requests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
