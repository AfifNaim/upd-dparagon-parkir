@extends('layouts.app')

@section('title', 'Jenis Kendaraan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Jenis Kendaraan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('vehicle.update', $vehicle->id) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Nama Kendaraan</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $vehicle->name }}">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <input type="submit" value="Save" class="btn note-btn btn-info btn-lg">
                                <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

