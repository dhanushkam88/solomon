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
        <h1 class="display-6 text-center">Create your Ticket ....</h1>
        <!-- form start-->
        <div class="card border-white col-md-6 d-flex justify-content-center">
            <div class="card-body">
                <form class="row g-3 m-5" id="trackingForm" method="POST" action="{{ route('createTicket') }}">
                    @csrf
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" placeholder="Jhone Manish" name="customer_name" id="customer_name">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Customer Email</label>
                        <input type="email" class="form-control" placeholder="jhone@mytrack.com" name="customer_email" id="customer_email">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" placeholder="+94755669912" name="phone_number" id="phone_number">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Invoice Number</label>
                        <input type="text" class="form-control" placeholder="FR00012485" name="invoice_number" id="invoice_number">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Vendor</label>
                        <select class="form-select" id="vendor" name="vendor" aria-label="Default select example">
                            <option hidden>Select your vendor</option>
                            <option value="1">vendor</option>
                            {{ $role }}
                            @foreach ($role as $data)
                                <option value="$data->id">$data->name</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Describe Your Issue</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="describe" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <!--- form end-->
    </div>
</div>
<div class="container mainTable" hidden>
    <div class="row">
        <div class="card p-5 col-5" id="chats">
        </div>
        <div class="card p-5 col-6" id="info">
            <table class="table">
                <thead class="table-dark">
                  <tr>
                    <td class="text-center" colspan="2">Hi Dhanushka muditha ....</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody id="tableData">
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
{{-- <script>
    $(function () {
        $('form').bind('submit', function (event) {
        event.preventDefault();
            $.ajax({
                type: 'GET',
                url: '{{ route("tracking") }}',
                data: $('form').serialize(),
                success: function (response) {
                    var referenceNumber = response['ticket']['reference_number'];
                    var invoice_number = response['ticket']['invoice_number'];
                    var vendor_id = response['ticket']['vendor_id'];
                    var name = response['ticket']['name'];
                    var email = response['ticket']['email'];
                    var contact_number = response['ticket']['refecontact_numberrence_number'];
                    var description = response['ticket']['description'];
                    var status = response['ticket']['status'];


                    for (i=0;i<(response['ticketInfo']).length;i++) {
                        var ticketInfo = response['ticketInfo'][i];
                        if(ticketInfo['sender'] == 'user'){
                            var display = "alert-primary pull-right";
                            var align = "pull-right";
                        }else{
                            var display = "alert-warning";
                            var align = "";
                        }
                        $('#chats').append('<div class="div"><div class="alert '+display+' col-sm-10 '+align+'" role="alert">'+ticketInfo['details']+'</div></div>');
                    }
                    $('#tableData').append('<tr><th>Reference Number</th><td>'+referenceNumber+'</td></tr><tr><th>Invoice Number</th><td>'+invoice_number+'</td></tr></tr><tr><th>Vendor Id</th><td>'+vendor_id+'</td></tr></tr><tr><th>Full Name</th><td>'+email+'</td></tr></tr><tr><th>Contact Number</th><td>'+contact_number+'</td></tr></tr><tr><th>Description</th><td>'+description+'</td></tr></tr><tr><th>Status</th><td class="Class="text-capitalize">'+status+'</td></tr></tr>');

                },
                error: function (error) {
                    console.log(error);
                }
            });
            $('.mainTable').removeAttr('hidden');
        });
    });
</script> --}}
@endsection
