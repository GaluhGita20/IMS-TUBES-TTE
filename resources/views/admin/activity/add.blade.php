<?php
  $title = "Master Data";
?>

@extends('layouts.admin-layout.admin')

@section('content')

 <!--**********************************
        Content body start
    ***********************************-->
    <link rel="stylesheet" type="text/css" href="/css/admin/star.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="content-body">
      <div class="container-fluid">
        <div class="page-titles">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Training</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add</a></li>
          </ol>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success mt-2">
                {{ session()->get('success') }}
            </div>
        @endif
        <!-- row -->
        <form action="{{route('admin.training.store')}}" method="POST">
            @csrf
            <div class="mb-3 mt-2">
                <label for="product name" class="form-label">Nama Kegiatan Training</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3 mt-2">
                <label for="product name" class="form-label">Desc</label>
                <textarea type="text" class="form-control" id="desc" name="desc" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="product name" class="form-label">Jadwal Mulai Training</label>
                <input type="datetime-local" class="form-control" id="start" name="start">
            </div>
            <div class="mb-3">
                <label for="product name" class="form-label">Jadwal Akhir Training</label>
                <input type="datetime-local" class="form-control" id="end" name="end">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection