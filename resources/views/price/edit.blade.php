@extends('layouts.app')

@section('title', 'Tarif Parkir Kendaraan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Tarif Parkir Kendaraan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tarif Parkir Kendaraan {{ $price->Vehicle->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('price.update', $price->id) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Tarif Normal</label>
                                    <input type="number" class="form-control  @error('normal_bill') is-invalid @enderror" name="normal_bill" value="{{ $price->normal_bill }}">
                                    @error('normal_bill')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tarif Extra</label>
                                    <input type="number" class="form-control  @error('extra_bill') is-invalid @enderror" name="extra_bill" value="{{ $price->extra_bill }}">
                                    @error('extra_bill')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Waktu Extra</label>
                                    <input type="number" class="form-control  @error('extra_time') is-invalid @enderror" name="extra_time" value="{{ $price->extra_time }}">
                                    @error('extra_time')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route('price.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

