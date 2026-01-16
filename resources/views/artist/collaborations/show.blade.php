@extends('layouts.frontend.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success" style="background: rgba(0, 242, 254, 0.2); border: 1px solid rgba(0, 242, 254, 0.5); color: #00f2fe; padding: 15px; border-radius: 10px; margin: 20px 0;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="background: rgba(255, 51, 68, 0.2); border: 1px solid rgba(255, 51, 68, 0.5); color: #ff3344; padding: 15px; border-radius: 10px; margin: 20px 0;">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" style="background: rgba(255, 51, 68, 0.2); border: 1px solid rgba(255, 51, 68, 0.5); color: #ff3344; padding: 15px; border-radius: 10px; margin: 20px 0;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
    .collaboration-detail-section {
        background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
        min-height: 100vh;
        padding: 40px 0;
    }
    
    .collaboration-header-card {
        background: rgba(45, 27, 78, 0.6);
        border: 1px solid rgba(183, 148, 246, 0.3);
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .collaboration-card {
        background: rgba(45, 27, 78, 0.6);
        border: 1px solid rgba(183, 148, 246, 0.3);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
    }
    
    .ownership-badge {
        background: rgba(183, 148, 246, 0.2);
        color: #b794f6;
        padding: 8px 16px;
        border-radius: 20px;
        display: inline-block;
        margin: 5px;
        border: 1px solid rgba(183, 148, 246, 0.3);
    }
    
    .revenue-table {
        width: 100%;
        color: #fbfbfb;
        background: rgba(183, 148, 246, 0.05);
        border-radius: 10px;
        overflow: hidden;
    }
    
    .revenue-table thead {
        background: rgba(183, 148, 246, 0.2);
    }
    
    .revenue-table th {
        padding: 15px;
        color: #b794f6;
        font-weight: 600;
        text-align: left;
    }
    
    .revenue-table td {
        padding: 15px;
        border-top: 1px solid rgba(183, 148, 246, 0.1);
    }
    
    .revenue-table tbody tr:hover {
        background: rgba(183, 148, 246, 0.1);
    }
</style>

<section class="collaboration-detail-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Back Button -->
                <a href="{{ route('artist.portal') }}" class="btn mb-4" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; border: 1px solid rgba(183, 148, 246, 0.5); padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block;">
                    <i class="fas fa-arrow-left"></i> Back to Portal
                </a>

                @if(!isset($collaboration) || !$collaboration)
                    <div class="alert alert-danger" style="background: rgba(255, 51, 68, 0.2); border: 1px solid rgba(255, 51, 68, 0.5); color: #ff3344; padding: 20px; border-radius: 10px; margin: 20px 0;">
                        <h4 style="color: #ff3344; margin-bottom: 10px;">No Collaboration Data Found</h4>
                        <p>Unable to load collaboration details. Please check if the collaboration exists and you have access to it.</p>
                        <a href="{{ route('artist.portal') }}" class="btn" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; border: 1px solid rgba(183, 148, 246, 0.5); padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block; margin-top: 10px;">
                            Return to Portal
                        </a>
                    </div>
                @else

                <!-- Collaboration Header -->
                <div class="collaboration-header-card">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 style="color: #fbfbfb; font-size: 2.5rem; margin-bottom: 15px;">
                                <i class="fas fa-music" style="color: #b794f6; margin-right: 15px;"></i>
                                {{ $collaboration->music->name ?? 'Unknown Track' }}
                            </h1>
                            <div style="margin-bottom: 20px;">
                                <span class="badge" style="background: rgba(183, 148, 246, 0.3); color: #b794f6; padding: 8px 16px; border-radius: 20px; margin-right: 10px; font-size: 1rem;">
                                    {{ ucfirst($collaboration->collaboration_type ?? 'collaboration') }}
                                </span>
                                <span class="badge" style="background: {{ ($collaboration->status ?? 'pending') === 'active' ? 'rgba(0, 242, 254, 0.3)' : 'rgba(241, 196, 15, 0.3)' }}; color: {{ ($collaboration->status ?? 'pending') === 'active' ? '#00f2fe' : '#f1c40f' }}; padding: 8px 16px; border-radius: 20px; font-size: 1rem;">
                                    {{ ucfirst($collaboration->status ?? 'pending') }}
                                </span>
                            </div>
                            <p style="color: #b8a8d0; font-size: 1.1rem; margin-bottom: 0;">
                                Primary Artist: <strong style="color: #fbfbfb;">{{ $collaboration->primaryArtist->name ?? 'Unknown Artist' }}</strong>
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            @php
                                $userOwnership = $collaboration->ownershipSplits->where('artist_id', auth()->id())->first()->ownership_percentage ?? 0;
                                $totalEarnings = $collaboration->revenueDistributions->where('artist_id', auth()->id())->sum('artist_share_after_split') ?? 0;
                            @endphp
                            <div style="background: rgba(0, 242, 254, 0.1); padding: 20px; border-radius: 12px; border: 1px solid rgba(0, 242, 254, 0.3);">
                                <div style="color: #b8a8d0; font-size: 0.9rem; margin-bottom: 8px;">Your Ownership</div>
                                <div style="color: #00f2fe; font-size: 2rem; font-weight: bold; margin-bottom: 15px;">
                                    {{ number_format($userOwnership, 2) }}%
                                </div>
                                <div style="color: #b8a8d0; font-size: 0.9rem; margin-bottom: 8px;">Total Earnings</div>
                                <div style="color: #fbfbfb; font-size: 1.8rem; font-weight: bold;">
                                    ${{ number_format($totalEarnings, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ownership Distribution -->
                <div class="collaboration-card">
                    <h2 style="color: #fbfbfb; font-size: 1.8rem; margin-bottom: 20px;">
                        <i class="fas fa-users" style="color: #b794f6; margin-right: 10px;"></i>
                        Ownership Distribution
                    </h2>
                    @if($collaboration->ownershipSplits && $collaboration->ownershipSplits->count() > 0)
                        <div class="row">
                            @foreach($collaboration->ownershipSplits as $split)
                                <div class="col-md-6 mb-3">
                                    <div style="background: rgba(183, 148, 246, 0.1); padding: 15px; border-radius: 10px; border: 1px solid rgba(183, 148, 246, 0.3);">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                            <div>
                                                <h4 style="color: #fbfbfb; margin: 0; font-size: 1.2rem;">
                                                    {{ $split->artist->name ?? 'Unknown Artist' }}
                                                    @if($split->is_primary)
                                                        <span style="color: #b794f6; font-size: 0.9rem;">(Primary Artist)</span>
                                                    @endif
                                                </h4>
                                                @if($split->role)
                                                    <p style="color: #b8a8d0; margin: 5px 0 0 0; font-size: 0.9rem;">
                                                        Role: {{ $split->role }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div style="text-align: right;">
                                                <div style="color: #b794f6; font-size: 1.8rem; font-weight: bold;">
                                                    {{ number_format($split->ownership_percentage ?? 0, 2) }}%
                                                </div>
                                                @if($split->approved_by_artist)
                                                    <span style="color: #00f2fe; font-size: 0.85rem;">
                                                        <i class="fas fa-check-circle"></i> Approved
                                                    </span>
                                                @elseif(!$split->is_primary)
                                                    <span style="color: #f1c40f; font-size: 0.85rem;">
                                                        <i class="fas fa-clock"></i> Pending
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5" style="background: rgba(183, 148, 246, 0.1); border-radius: 10px; border: 1px solid rgba(183, 148, 246, 0.3);">
                            <i class="fas fa-users" style="font-size: 3rem; color: #b794f6; margin-bottom: 20px; opacity: 0.5;"></i>
                            <p style="color: #b8a8d0; font-size: 1.1rem;">No ownership splits found for this collaboration.</p>
                        </div>
                    @endif
                </div>

                <!-- Revenue Distribution History -->
                <div class="collaboration-card">
                    <h2 style="color: #fbfbfb; font-size: 1.8rem; margin-bottom: 20px;">
                        <i class="fas fa-chart-line" style="color: #b794f6; margin-right: 10px;"></i>
                        Your Revenue Distribution History
                    </h2>
                    
                    @if($userRevenue && $userRevenue->count() > 0)
                        <div style="overflow-x: auto;">
                            <table class="revenue-table">
                                <thead>
                                    <tr>
                                        <th>Period Date</th>
                                        <th>Streams</th>
                                        <th>Total Revenue</th>
                                        <th>Platform Fee</th>
                                        <th>Your Share ({{ number_format($userOwnership, 2) }}%)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userRevenue as $revenue)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($revenue->period_date)->format('M d, Y') }}</td>
                                            <td>{{ number_format($revenue->stream_count) }}</td>
                                            <td>${{ number_format($revenue->total_revenue, 2) }}</td>
                                            <td>${{ number_format($revenue->platform_fee, 2) }}</td>
                                            <td style="color: #00f2fe; font-weight: bold;">
                                                ${{ number_format($revenue->artist_share_after_split, 2) }}
                                            </td>
                                            <td>
                                                @if($revenue->status === 'paid')
                                                    <span style="color: #00f2fe;">
                                                        <i class="fas fa-check-circle"></i> Paid
                                                    </span>
                                                @elseif($revenue->status === 'calculated')
                                                    <span style="color: #f1c40f;">
                                                        <i class="fas fa-clock"></i> Calculated
                                                    </span>
                                                @else
                                                    <span style="color: #b8a8d0;">
                                                        <i class="fas fa-hourglass-half"></i> Pending
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $userRevenue->links() }}
                        </div>
                    @else
                        <div class="text-center py-5" style="background: rgba(183, 148, 246, 0.1); border-radius: 10px; border: 1px solid rgba(183, 148, 246, 0.3);">
                            <i class="fas fa-chart-line" style="font-size: 3rem; color: #b794f6; margin-bottom: 20px; opacity: 0.5;"></i>
                            <p style="color: #b8a8d0; font-size: 1.1rem;">No revenue distributions yet. Revenue will be calculated and distributed based on streaming data.</p>
                        </div>
                    @endif
                </div>

                <!-- Revenue Calculation Info -->
                <div class="collaboration-card" style="background: rgba(0, 242, 254, 0.05); border-color: rgba(0, 242, 254, 0.3);">
                    <h3 style="color: #00f2fe; font-size: 1.4rem; margin-bottom: 15px;">
                        <i class="fas fa-info-circle" style="margin-right: 10px;"></i>
                        How Revenue is Calculated
                    </h3>
                    <div style="color: #b8a8d0; line-height: 1.8;">
                        <p>Revenue for collaborative tracks is calculated based on:</p>
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li>Total streams for the track during the period</li>
                            <li>Platform fee (typically 20% of total revenue)</li>
                            <li>Your ownership percentage ({{ number_format($userOwnership, 2) }}%)</li>
                            <li>Revenue is distributed to all collaborators based on their ownership splits</li>
                        </ul>
                        <p style="margin-top: 15px; color: #fbfbfb;">
                            <strong>Example:</strong> If the track earns $20 in a period, the platform takes $4 (20% fee), leaving $16 for artists. With your {{ number_format($userOwnership, 2) }}% ownership, you receive ${{ number_format(16 * ($userOwnership / 100), 2) }}.
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
