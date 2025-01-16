@extends('layout.app')

@section('content')
<style>
    .fc-event-title {
    font-size: 10px;
    padding: 2px;
    text-align: center;
    display: block;
    white-space: normal;
}
#calendar {
    width: 100%;
    height: 600px; /* Adjust height as needed */
}

</style>
<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" rel="stylesheet">

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>

<div class="card p-3">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h2>Simulasi Penjadwalan</h2>
            </div>
            <div class="col text-right">
                @if (Auth::check()) <!-- Periksa apakah user sudah login -->
                    <!-- Tombol Tambah Jadwal -->
                    <button class="btn btn-success" data-toggle="modal" data-target="#addScheduleModal">
                        Tambah Jadwal
                    </button>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <script>
            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 3000); // Hide after 3 seconds
        </script>

        <div class="row mt-2">
            <div class="col-md-6">
                <!-- Kalender -->
                <div id="calendar"></div>
            </div>
            <div class="col-md-6">
                <!-- Konten Jadwal -->
                @include('jawaban.NomorTiga.index')
            </div>
        </div>
    </div>
</div>

@endsection

@section('addon-style')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('addon-script')
@include('home.script')
@include('jawaban.NomorTiga.script')
@include('jawaban.NomorEmpat.script')
@endsection
