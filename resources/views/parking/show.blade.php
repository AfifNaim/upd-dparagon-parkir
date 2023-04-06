@extends('layouts.app')

@section('title', 'Parkir')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Parkir</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Jenis Kendaraan</label>
                                <input type="text" class="form-control" value="{{ $parking->Vehicle->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Plat Nomor</label>
                                <input type="text" class="form-control" value="{{ $parking->vehicle_number }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Operator</label>
                                <input type="text" class="form-control" value="{{ $parking->User->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" value="{{ $parking->date }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Waktu Masuk</label>
                                <input class="form-control" value="{{ $parking->time_in }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Waktu Keluar</label>
                                <input class="form-control" value="{{ $parking->time_out }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Tagihan</label>
                                <input class="form-control" value="{{ $parking->bill }}" disabled>
                            </div>
                            <a href="{{ route('parking.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

