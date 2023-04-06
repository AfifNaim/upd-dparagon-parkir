@extends('layouts.app')

@section('title', 'Jenis Kendaraan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Kendaraan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Kendaraan</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kapasitas</label>
                                    <input type="number" class="form-control  @error('capacity') is-invalid @enderror" name="capacity" value="{{ old('capacity') }}">
                                    @error('capacity')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tarif Normal</label>
                                    <input type="number" class="form-control  @error('normal_bill') is-invalid @enderror" name="normal_bill" value="{{ old('normal_bill') }}">
                                    @error('normal_bill')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tarif Inap</label>
                                    <input type="number" class="form-control  @error('extra_bill') is-invalid @enderror" name="extra_bill" value="{{ old('extra_bill') }}">
                                    @error('extra_bill')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Waktu Inap</label>
                                    <input type="number" class="form-control  @error('extra_time') is-invalid @enderror" name="extra_time" value="{{ old('extra_time') }}">
                                    @error('extra_time')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route('parking.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection