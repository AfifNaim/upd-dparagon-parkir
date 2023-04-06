@extends('layouts.app')

@section('title', 'Kapasitas Parkir Kendaraan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Kapasitas Parkir Kendaraan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kapasitas Parkir Kendaraan {{ $capacity->Vehicle->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('capacity.update', $capacity->id) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Kapasitas Parkir</label>
                                    <input type="number" class="form-control  @error('capacity') is-invalid @enderror" name="capacity" value="{{ $capacity->capacity }}">
                                    @error('capacity')
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

