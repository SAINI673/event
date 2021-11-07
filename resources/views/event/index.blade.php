<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script>

    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


    <title>Event Management!</title>
    <style>
        .main-section {
            width: 80%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="col-md-12 main-section">
            <div class="row">
                    <div class="mb-3">
                        <label for="enventName" class="form-label">Event Name</label>
                        <input type="text" class="form-control" name="eventName" id="eventName" placeholder="Please enter event">
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Event Description</label>
                        <textarea class="form-control" name="eventDescription" id="eventDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="text" class="form-control startDate" id="txtStartDate" name="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="eventEndDate" class="form-label">End Date</label>
                        <input class="form-control endDate" type="text" id="txtEndDate" name="endDate">
                    </div>
                    <div class="mb-3">
                        <label for="organizer" class="form-label">Organizer</label>
                        <input type="text" class="form-control" name="organizer" id="organizer" placeholder="Please enter organizer">
                    </div>
            </div>
        </div>

        <div class="col-md-12 main-section">
            <h2>Tickets</h2>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="ticketid" class="form-label">ID</label>
                    <input type="text" class="form-control" name="ticket_id" id="ticket_id" />
                </div>
                <div class="col-md-3 mb-3">
                    <label for="ticketnumber" class="form-label">Ticket Number</label>
                    <input type="text" class="form-control" id="ticket_number" name="ticket_number">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="ticketprice" class="form-label">Ticket Price</label>
                    <input type="text" class="form-control" id="ticket_price" name="ticket_price">
                </div>
                <div class="col-md-3 mt-3">
                    <a class="btn btn-danger mt-3 add_ticket" href="javascript:void(0)"> Save</a>
                </div>
            </div>
            <div class="row">
                <table class="table table-striped table-hover" id="ticket_list">

                    <tbody>
                       <tr></tr>
                       @if($ticket_count > 0)
                        @foreach($tickets as $key=>$ticket)
                        <tr>
                            <td scope="row">{{ $ticket->id }}</td>
                            <td>{{ $ticket->ticket_number }}</td>
                            <td>{{ $ticket->price }}</td>
                            <td><a class="btn btn-primary me-2">Edit</a><a class="btn btn-danger me-2">Delete</a></td>
                        </tr>
                        @endforeach
                       @endif
                    </tbody>

                </table>
            </div>
            <input type="hidden" id="last_event_id" value="{{ $event_id }}">
        </div>
        <div class="text-center mb-3 mt-3"><a class="btn btn-primary add_event" href="javascript:void(0)">Save Event</a></div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $(function() {

            var ticket_price, ticket_id, ticket_number, event_id;
            $(document).on('click', '.add_ticket', function() {
                ticket_id = $("#ticket_id").val();
                ticket_number = $("#ticket_number").val();
                ticket_price = $("#ticket_price").val();
                event_id = $("#last_event_id").val();
                $.ajax({
                    type: 'POST',
                    url: "{{route('ticket.add') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "ticket_id": ticket_id,
                        "ticket_number": ticket_number,
                        "ticket_price": ticket_price,
                        "event_id": event_id
                    },
                    success: function(result) {
                        $('#ticket_list tr:last').after('<tr><td scope="row">'+result.ticket_id+'</td><td>'+result.ticket_number+'</td><td>'+result.ticket_price+'</td><td><a class="btn btn-primary me-2">Edit</a><a class="btn btn-danger me-2">Delete</a></td></tr>');

                    }
                });
            });

            var event_name,event_description,event_start_date,event_end_date,event_organizer;
            $(document).on('click', '.add_event', function() {
                event_name = $("#eventName").val();
                event_description = $("#eventDescription").val();
                event_start_date = $("#txtStartDate").val();
                event_end_date = $("#txtEndDate").val();
                event_organizer = $("#organizer").val();
                $.ajax({
                    type: 'POST',
                    url: "{{route('event.add') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "event_name": event_name,
                        "event_description": event_description,
                        "event_start_date": event_start_date,
                        "event_end_date": event_end_date,
                        "event_organizer": event_organizer
                    },
                    success: function(result) {
                        location.reload();
                    }
                });
            });



            $(".startDate").datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                startDate: new Date()
            }).on('changeDate', function(selected) {
                var minDate = new Date(selected.date);
                minDate.setDate(minDate.getDate() + 1);
                $('.endDate').datepicker('setStartDate', minDate);
            });

            $(".endDate").datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                startDate: new Date()
            }).on('changeDate', function(selected) {
                var minDate = new Date(selected.date);
                minDate.setDate(minDate.getDate() - 1);
                $('.startDate').datepicker('setEndDate', minDate);
            });
        });
    </script>
</body>

</html>