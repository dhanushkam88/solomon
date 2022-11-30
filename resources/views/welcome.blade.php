@extends('layouts.main')
@section('title') My Dashboard @endsection
@section('custom_css')
    <!-- calander-->
@endsection
@section('content')
<div class="container main-col">
    <div class="row d-flex justify-content-center">
        <!-- error-->
        @if (session('success'))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="col-sm-12">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
    <!-- end error -->
        <h1 class="display-6 text-center">Welcome to My Tracker Page....</h1>
        <!-- form start-->
        <div class="card border-white col-md-6 d-flex justify-content-center">
            <div class="card-body">
                <div class="d-grid gap-2 mt-5">
                    <a href="{{ route('createTrackingPage') }}" class="btn btn-primary g-3 welcome-button" type="submit">Creat Ticket</a>
                    <a href="{{ route('trackingPage') }}" class="btn btn-primary welcome-button" type="submit">Find Ticket Info</a>
                </div>
            </div>
        </div>
        <!--- form end-->
    </div>
</div>
@endsection
@section('custom_js')

@endsection
