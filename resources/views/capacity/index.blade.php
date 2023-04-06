@extends('layouts.app')

@section('title', 'Kapasitas Parkir Kendaraan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kapasitas Parkir Kendaraan</h1>
        </div>

        <div class="section-body">
            <div class="mt-2">
                @include('partials.message')
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-md" id="data_table">
                                    <thead class="table-light">
                                        <td>No</td>
                                        <td>Nama Kendaraan</td>
                                        <td>Kapasitas Parkir</td>
                                        <td>Update User Terakhir</td>
                                        <td style="text-align: right">Action</td>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        ?>
                                        @foreach ($capacity as $capacities)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $capacities->Vehicle->name }}</td>
                                            <td>{{ $capacities->capacity }}</td>
                                            <td>{{ $capacities->User->name }}</td>
                                            <td style="text-align: right">
                                                <a href="{{ route('capacity.edit', $capacities->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex">
                                    {!! $capacity->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection