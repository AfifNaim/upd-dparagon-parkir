@extends('layouts.app')

@section('title', 'Parkir')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Parkir</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('parking.create') }}" class="btn note-btn btn-success">Tambah Parkir</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-md" id="data_table">
                                    <thead class="table-light">
                                        <td>No</td>
                                        <td>Jenis Kendaraan</td>
                                        <td>Operator</td>
                                        <td>Plat Nomor</td>
                                        <td>Jam Masuk</td>
                                        <td>Jam Keluar</td>
                                        <td>Tagihan</td>
                                        <td>Status</td>
                                        <td style="text-align: right">Action</td>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        ?>
                                        @foreach ($parking as $parkings)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $parkings->Vehicle->name }}</td>
                                            <td>{{ $parkings->User->name }}</td>
                                            <td>{{ $parkings->vehicle_number }}</td>
                                            <td>{{ $parkings->time_in }}</td>
                                            <td>{{ $parkings->time_out }}</td>
                                            <td>{{ $parkings->bill }}</td>
                                            <td>                                              
                                                @if ($parkings->time_out == null)
                                                    <div class="badge badge-primary">Belum Keluar</div>
                                                @else
                                                    <div class="badge badge-success">Sudah Keluar</div>
                                                @endif
                                            </td>
                                            <td style="text-align: right">
                                                @if ($parkings->time_out == null)
                                                    <form action="{{ route('parking.destroy',$parkings->id) }}" method="POST">
                                                        <a href="{{ route('parking.edit', $parkings->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <a href="{{ route('parking.show', $parkings->id) }}" class="btn btn-success btn-sm">Show</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                                    </form>
                                                    <form action="{{ route('parking.out',$parkings->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                            onclick="return confirm('Apakah data kendaraan sudah sesuai?')">Keluar</button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('parking.show', $parkings->id) }}" class="btn btn-success btn-sm">Show</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex">
                                    {!! $parking->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection