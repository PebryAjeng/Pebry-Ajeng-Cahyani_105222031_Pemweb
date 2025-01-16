@extends('layout.app')

@section('content')
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

<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addScheduleModalLabel">Tambah Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('event.submit') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="start">Start</label>
                        <input type="date" id="start" name="start" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end">End</label>
                        <input type="date" id="end" name="end" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Jadwal -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('event.update') }}" method="POST">
                @csrf
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editScheduleModalLabel">Edit Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@if (Auth::check())
    <button class="btn btn-success" data-toggle="modal" data-target="#addScheduleModal">
        Tambah Jadwal
    </button>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section('addon-style')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('addon-script')
@include('home.script')
@include('jawaban.NomorTiga.script')
@include('jawaban.NomorEmpat.script')
@endsection
