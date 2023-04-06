@extends('layouts.app')

@section('title', 'Laporan')

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
                        </div>
                        <div class="card-body">
                            <form action="{{ route('parking.report') }}" method="get">
                                <div class="input-group mb-3 col-md-4 float-right">
                                    <input type="text" id="created_at" name="date" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Filter</button>
                                    </div>
                                    <a target="_blank" class="btn btn-primary" id="exportpdf">Export Excel</a>
                                </div>
                            </form>
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
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('javascript')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <script>
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            $('#exportpdf').attr('href', '/parking/'+ start.format('DD-MM-YYYY') + '+' + end.format('DD-MM-YYYY')+'/excel')

            //INISIASI DATERANGEPICKER
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
                $('#exportpdf').attr('href', '/parking/'+ start.format('DD-MM-YYYY') + '+' + end.format('DD-MM-YYYY')+'/excel')
            })
        })
    </script>
@endpush