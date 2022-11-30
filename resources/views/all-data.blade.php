@extends('layouts.main')
@section('title') My Dashboard @endsection
@section('custom_css')
    <!-- calander-->
@endsection
@section('content')
    <div class="container main-col">
        <div class="row d-flex justify-content-center">
            <!-- error-->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- end error -->
            <h1 class="display-6">Hi ! {{ auth()->user()->name }} ....</h1>
            <p>Last login : {{ auth()->user()->created_at }} </p>
            <div class="col-sm-4">
                <form id="create-event">
                    <input type="hidden" value="pending" name="test" id="test">
                    <button type="submit" class="btn btn-primary position-relative alert-button text-uppercase">
                        <span class="badge bg-danger badge-edited">{{ $newTickets['newTickets'] }}</span> New Tickets
                    </button>
                </form>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-primary position-relative alert-button text-uppercase">
                    <span class="badge bg-danger badge-edited">4</span> Open Tickets
                </button>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-primary position-relative alert-button text-uppercase">
                    <span class="badge bg-danger badge-edited">4</span> Closed Tickets
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row main-table ">
            <h2>My Open Tickets</h2>
            <div class="col-sm-12 table-responsive-sm">
                <table id="openTickets" class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Reference Number</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Contact Number</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    {{-- <script>
        $(function () {
            var table = $('#openTickets').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.openTickets') }}",
                columns: [
                    {data: 'reference_number', name: 'Reference Number'},
                    {data: 'name', name: 'Customer Name',sorting:false},
                    {data: 'email', name: 'Customer Email',sorting:false},
                    {data: 'contact_number', name: 'Contact Number',sorting:false},
                    {data: 'created_at', name: 'Date',sorting:false},
                    {
                        "render": function(data, type, row) {
                            return '<a href="connect.html" id="'+row.id+'" type="button" class="btn btn-outline-danger" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>'}
                    },
                ],
                order: [[0, "desc"]],
            });
        });
    </script> --}}
@endsection
