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
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Document</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Upload</a></li>
          </ol>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success mt-2">
                {{ session()->get('success') }}
            </div>
        @endif
        <!-- row -->
        <div class="row">
          <div class="col-xl-12 col-xxl-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Form Data Upload Document</h4>
              </div>
              <div class="card-body">
                <form action="{{route('admin.document.upload')}}" method="POST"  enctype="multipart/form-data" id="step-form-horizontal" >
                    @csrf
                    <div class="mb-3">
                        <label for="product name" class="form-label">Activity Id</label>
                        <div class="dropdown bootstrap-select form-control dropup">
                          <select name="activity_id" id="activity_id" class="form-control" tabindex="-98" required>
                            <option selected value="" disabled>Pilih Id Activity Document</option>
                            @foreach($activities as $dd)
                              <option value="{{$dd->id}}">{{$dd->id}} - {{$dd->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="product name" class="form-label">Message</label>
                        <textarea type="text" class="form-control" id="messsage" name="message" rows="5"></textarea>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label for="document">Document</label>
                        <input type="file" class="form-control-file" id="filedoc" name="filedoc" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection