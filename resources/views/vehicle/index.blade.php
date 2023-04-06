@extends('layouts.app')

@section('title', 'Jenis Kendaraan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Jenis Kendaraan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('vehicle.create') }}" class="btn note-btn btn-success">Tambah Kendaraan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-md" id="data_table">
                                    <thead class="table-light">
                                        <td>No</td>
                                        <td>Nama Kendaraan</td>
                                        <td style="text-align: right">Action</td>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        ?>
                                        @foreach ($vehicle as $vehicles)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $vehicles->name }}</td>
                                            <td style="text-align: right">
                                            <form action="{{ route('vehicle.destroy',$vehicles->id) }}" method="POST">
                                                <a href="{{ route('vehicle.edit', $vehicles->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class ="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex">
                                    {!! $vehicle->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection