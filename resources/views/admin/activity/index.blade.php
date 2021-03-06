<?php
  $title = "Master Data";
?>

@extends('layouts.admin-layout.admin')

@section('content')

<!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
      <div class="container-fluid">
        <div class="page-titles">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Training</a></li>
          </ol>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success mt-2">
                {{ session()->get('success') }}
            </div>
        @endif
        <!-- row -->
        @livewire('table-activity')
      </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection