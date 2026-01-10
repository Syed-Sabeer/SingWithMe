@extends('layouts.app.master')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')

  <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Dashboard</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    {{-- <li class="breadcrumb-item">Dashboard</li> --}}
                    <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-09">
            <div class="row">
              <div class="col-xxl-12 box-col-12"> 
                <div class="row"> 
                  <div class="col-md-6 col-sm-6"> 
                    <div class="card compare-order">
                      <div class="card-header card-no-border">
                        <div class="header-top"> 
                          <div class="compare-icon shadow-primary">
                            <svg class="fill-primary">
                              <use href="{{asset('AdminAssets/svg/icon-sprite.svg#crm-user')}}"></use>
                            </svg>
                          </div>
                      
                        </div>
                      </div>
                      @php
    $contactCount = \App\Models\ContactSubmission::count();
    $visits = \App\Models\VisitStat::first()?->home_visits ?? 0;
@endphp
                      <div class="card-body pt-0"> <span class="f-w-500 c-o-light">Total Contacts Submitted</span>
                        <h4 class="mb-2">
                           <span class="counter" data-target="{{$contactCount}}"></span></h4>
                        {{-- <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                          <div class="progress-bar bg-primary" style="width: 58%"></div>
                        </div> --}}
                        {{-- <span class="user-growth f-12 f-w-500"><i class="icon-arrow-down txt-danger"></i><span class="txt-danger">-4.3%</span></span><span class="user-text">last month</span> --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6"> 
                    <div class="card compare-order">
                      <div class="card-header card-no-border">
                        <div class="header-top"> 
                          <div class="compare-icon shadow-success">
                            <svg class="fill-success">
                              <use href="{{asset('AdminAssets/svg/icon-sprite.svg#crm-lead')}}"></use>
                            </svg>
                          </div>
                         
                        </div>
                      </div>
                      <div class="card-body pt-0"> <span class="f-w-500 c-o-light">Total Visits</span>
                        <h4 class="mb-2"><span class="counter" data-target="{{ $visits }}"></span></h4>
                        {{-- <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                          <div class="progress-bar bg-success" style="width: 58%"></div>
                        </div><span class="user-growth f-12 f-w-500"><i class="icon-arrow-up txt-success"></i><span class="txt-success">+7.9%</span></span><span class="user-text">last month</span> --}}
                      </div>
                    </div>
                  </div>
                
               
                </div>
              </div>
     
         
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

        @endsection

@section('script')
@endsection