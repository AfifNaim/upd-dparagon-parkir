@extends('layouts.app')

@section('title', 'Parkir')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Parkir</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('parking.update', $parking->id) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Plat Nomor</label>
                                    <input type="text" class="form-control  @error('vehicle_number') is-invalid @enderror" name="vehicle_number" value="{{ $parking->vehicle_number }}">
                                    @error('vehicle_number')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-capitalize">Jenis Kendaraan</label>
                                    <select class="form-control select2" name="vehicle_id" id="vehicle_id">
                                        <option value="" disabled>----PILIH----</option>
                                        @foreach ($vehicle as $vehicles)
                                            <option value="{{ $vehicles->id }}" {{$vehicles->name == $parking->id  ? 'selected' : ''}}>{{ $vehicles->name }}</option>
                                        @endforeach
                                    </select>
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

