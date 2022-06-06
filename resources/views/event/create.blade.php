@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tambah Event </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('event.store') }}" method="post">
                        @csrf
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
                        </div>
                        {{-- <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="10"
                                style="height: 100px;"></textarea>
                        </div> --}}
                        <div class="form-group">
                            <label for="day">Day Reminder</label>
                            <select name="days[]" id="" class="select2 form-control" multiple>
                                <option value="monday">Senin</option>
                                <option value="tuesday">Selasa</option>
                                <option value="wednesday">Rabu</option>
                                <option value="thursday">Kamis</option>
                                <option value="friday">Jumat</option>
                                <option value="saturday">Sabtu</option>
                                <option value="sunday">Minggu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success">Tambah Event Serupa</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection