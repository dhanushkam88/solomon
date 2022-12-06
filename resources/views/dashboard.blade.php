@extends('layouts.main')
@section('title') My Dashboard @endsection
@section('custom_css')
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
            <h1 class="display-6">Hi ! {{ auth()->user()->name }} ....</h1>
            <p>Last login : {{ auth()->user()->created_at }} </p>
            <div class="col-sm-4">
                <button type="button" name="destroy" class="btn btn-primary position-relative alert-button text-uppercase" value="pending" id="pending">
                </button>
            </div>
            <div class="col-sm-4">
                <button type="button" name="destroy" class="btn btn-primary position-relative alert-button text-uppercase" value="reviewing" id="reviewing">
                </button>
            </div>
            <div class="col-sm-4">
                <button type="button" name="destroy" class="btn btn-primary position-relative alert-button text-uppercase" value="closed" id="closed">
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid main-table" hidden>
        <div class="row main-table">
            <h2 id="tabale-h1">My Tickets</h2>
            <div class="col-sm-12 table-responsive-sm">
                <table id="tickets" class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Reference Number</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Contact Number</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">View Ticket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="history.go(0);"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('updateTicket') }}" id="contactUSForm" class="form-floating">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-floating mb-3" id="reference_number">
                    </div>
                    <div class="form-floating mb-3" id="invoice_number">
                    </div>
                    <div class="form-floating mb-3" id="customer_name">
                    </div>
                    <div class="form-floating mb-3" id="email">
                    </div>
                    <div class="form-floating mb-3" id="contact_number">
                    </div>
                    <div class="form-floating mb-3">
                        <div class="card">
                            <div class="card-body chat-card">
                                <div class="card col-md-7 mb-3 float-start border-white">
                                    <div class="card-body text-bg-secondary ">
                                        This is some text within a card body.
                                    </div>
                                    <div class="card-footer bg-transparent text-end">
                                        <small>2022/10/12 12:22</small>
                                    </div>
                                </div>

                                <div class="card col-md-7 mb-3 float-end border-white">
                                    <div class="card-body text-bg-success">
                                        This is some text within a card body.
                                    </div>
                                    <div class="card-footer bg-transparent text-end border-white">
                                        <small>2022/10/12 12:25</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="reply"></textarea>
                        <label for="floatingTextarea">Add Your Reply</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                            <option id="status" selected hidden></option>
                            <option value="pending">Pending</option>
                            <option value="reviewing">Reviewing</option>
                            <option value="closed">Closed</option>
                        </select>
                        <label for="floatingSelect">Status</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-lg">Send</button>
                <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal" onClick="history.go(0);">Close</button>
            </form>
            </div>
            </div>
        </div>
        </div>
    <!-- end modal-->
@endsection
@section('custom_js')
    <script>
        $(document).ready(function() {
        // get Tickets informations
            $.ajax({
                    url: '{{ route("tickets") }}',
                success:function(response){
                    console.log(response);
                    $( '#pending' ).append('<span class="badge bg-danger badge-edited">'+response.newTickets+'</span> New Tickets');
                    $( '#reviewing' ).append('<span class="badge bg-danger badge-edited">'+response.openTickets+'</span> Open Tickets');
                    $( '#closed' ).append('<span class="badge bg-danger badge-edited">'+response.closeTickets+'</span> Close Tickets');

                },
                error: function(response) {
                    console.log(response);
                },
            });
        // end get Tickets information
        });
    </script>
    <script>
            $('button[name="destroy"]').on('click', function (e) {

            var btnValue = this.value;

            var table = $('#tickets').DataTable({
                ajax:{
                    url:'{{ route("openTickets") }}',
                    data: function(table) {
                        table.status = btnValue;
                    }
                },
                columns: [
                    {data: 'reference_number', name: 'Reference Number'},
                    {data: 'name', name: 'Customer Name',sorting:false},
                    {data: 'email', name: 'Customer Email',sorting:false},
                    {data: 'contact_number', name: 'Contact Number',sorting:false},
                    {data: 'created_at', name: 'Date',sorting:false},
                    {
                        "render": function(data, type, row) {
                        return '<button type="button" id="ticketModal" class="btn btn-outline-danger ticketModal" value="'+row.id+'"><i class="fa fa-eye" aria-hidden="true"></i></button>'}
                    },
                ],
                order: [[0, "desc"]],
                stateSave: true,
                "bDestroy": true
            });
            $('.main-table').removeAttr('hidden');
        });
    </script>
    <script>
    $(document).on('click', '.ticketModal', function(e) {
        e.preventDefault();

        var ticketModal = this.value;

        $.ajax({
            url: '{{ route("ticketInfo") }}',
            type:"GET",
            data:{
                id:ticketModal,
            },
            success:function(response){
                console.log(response);
                // let shops =''
                for (i=0;i<(response).length;i++) {
                    let id = response[i]['id'];
                    let reference_number = response[i]['reference_number'];
                    let invoice_number = response[i]['invoice_number'];
                    let name = response[i]['name'];
                    let email = response[i]['email'];
                    let contact_number = response[i]['contact_number'];
                    let status = response[i]['status'];
                    let data = response[i]['ticket_information'];
                    for (i=0;i<(data).length;i++) {
                        console.log(data[i]);
                    }
                    $('#reference_number').append('<input type="text" class="form-control" name="reference_number" id="reference_number" value="'+reference_number+'" disabled readonly> <label for="floatingInput">Reference Number</label>');
                    $('#invoice_number').append('<input type="text" class="form-control" name="invoice_number" id="invoice_number" value="'+invoice_number+'" disabled readonly> <label for="floatingInput">Invoice Number</label>');
                    $('#customer_name').append('<input type="text" class="form-control" name="customer_name" id="customer_name" value="'+name+'" disabled readonly> <label for="floatingInput">Customer Name</label>');
                    $('#email').append('<input type="text" class="form-control" name="customer_email" id="customer_email" value="'+email+'" disabled readonly> <label for="floatingInput">Customer Email</label>');
                    $('#contact_number').append('<input type="text" class="form-control" name="contact_number" id="contact_number" value="'+contact_number+'" disabled readonly> <label for="floatingInput">Contact Number</label>');
                    $('#status').append(status);
                    $(".modal-body #id").val( id );
                }
                $('#staticBackdrop').modal('show');

            }
        });
    });
    </script>
@endsection
