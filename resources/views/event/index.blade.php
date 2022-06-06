@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEvent">Buat Jadwal Mendetail</button>
            <br />
            <h1 class="text-center text-primary"><u>My Schedule</u></h1>
            <br />

            {{-- <div id="calendar"></div> --}}
        </div>
    </div>

</div>
   
@endsection

@push('modals')
<div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('event.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventLabel">Tambah Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Nama Event</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="start">Start Time</label>
                        <input type="date" class="form-control" name="start" id="start">
                    </div>
                    <div class="form-group">
                        <label for="end">End Time</label>
                        <input type="date" class="form-control" name="end" id="end">
                    </div>
                    {{-- <div class="form-group">
                        <label for="type">Type Event</label>
                        <select name="type" id="type" class="form-control" disabled>
                            <option value="week" selected>Week</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Jumlah Pertype Event</label>
                        <input type="number" min="1" max="7" class="form-control">
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10" style="height: 100px;"></textarea>
                    </div> --}}
                    <div class="form-group">
                        <label for="day">Day Reminder</label>
                        <select name="day" class="form-control" id="day">
                            <option value="monday">Senin</option>
                            <option value="tuesday">Selasa</option>
                            <option value="wednesday">Rabu</option>
                            <option value="thursday">Kamis</option>
                            <option value="friday">jumat</option>
                            <option value="saturday">saturday</option>
                            <option value="sunday">sunday</option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="reminder">Reminder</label>
                        <select name="reminder" id="reminder" class="form-control">
                            <option value="">None</option>
                            <option value="">2 days</option>
                            <option value="">Every Day</option>
                            <option value="">Every Week</option>
                            <option value="">Every Month</option>
                        </select>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@push('scripts')
    <script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            eventColor: '#009961',
            eventTextColor: '#ffffff',
            displayEventTime : false,
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month'
            },
            events:'/event',
            selectable:true,
            selectHelper: true,
            select:function(start, end, allDay)
            {
                var title = prompt('Event Title:');

                console.log([start, end]);
                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                    $.ajax({
                        url:"/event/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Created Successfully");
                        }
                    })
                }
            },
            editable:true,
            eventResize: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/event/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated Successfully");
                    }
                })
            },
            eventDrop: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/event/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated Successfully");
                    }
                })
            },

            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    $.ajax({
                        url:"/event/action",
                        type:"POST",
                        data:{
                            id:id,
                            type:"delete"
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Deleted Successfully");
                        }
                    })
                }
            }
        });

    });
    
    </script> 
@endpush