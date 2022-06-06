@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Event Bulan Ini
                    </button>
                </div>
                <div>
                    <div class="card-body collapse" id="collapseExample">
                        <ul>
                            @foreach ($events as $event)
                            @php
                            $date = new \Carbon\Carbon($event->reminder_date)

                            @endphp
                            <li>{{ $date->isoformat('dddd') }}, {{ $date->format('d') }} => {{ $event->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card mb-5">
                <div class="card-header">
                    <h5 class="card-title">Event Hari Ini</h5>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($events as $event)
                        @if ($event->reminder_date == date('Y-m-d'))
                        @php
                        $date = new \Carbon\Carbon($event->reminder_date)

                        @endphp
                        <li>{{ $date->isoformat('dddd') }}, {{ $event->title }}</li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card mb-5">
                <div class="card-header">
                    <h5 class="card-title">Event Minggu Ini</h5>
                </div>
                <div class="card-body">
                    <ul>
                        @php
                        $date = new \Carbon\Carbon();
                        $startWeek = $date->startOfWeek()->format('Y-m-d');
                        $endWeek = $date->endOfWeek()->format('Y-m-d');
                        @endphp
                        @foreach ($events->whereBetween('reminder_date', [$startWeek, $endWeek]) as $event)
                        @php
                        $date = new \Carbon\Carbon($event->reminder_date)

                        @endphp
                        <li>{{ $date->isoformat('dddd') }}, {{ $event->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@push('scripts')
<script>

</script>
@endpush