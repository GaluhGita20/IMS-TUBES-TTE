@extends('layouts.user-layout.dashboard')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pengajuan Keluhan</h1>


    <a href=""><div class="btn btn-primary py-3 " style="margin-bottom:20px;">+ Add Data List Keluhan</div></a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        @if(session()->has('success'))
        <div class="alert alert-success mt-2">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Record Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Keluhan User</th>
                            <th>Respond Admin</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Keluhan User</th>
                            <th>Respond Admin</th>
                            <th>Tanggal</th>
                            <th>Action</th>


                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection