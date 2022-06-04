<?php
  $title = "Master Data";
?>

@extends('layouts.admin-layout.admin')

@section('content')

<div class="content-body">
      <div class="container-fluid">
        <div class="page-titles">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Peserta</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Detail Peserta Training</a></li>
          </ol>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success mt-2">
                {{ session()->get('success') }}
            </div>
        @endif
        <!-- row -->
        <div class="row">
          <!-- Baris pertama -->
          <div class="col-xl-12 col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Detail Data Peserta Training</h4>
              </div>
              <div class="card-body">
                <div class="basic-form">
                  <form>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Id Peserta</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$peserta->id}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Peserta</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$peserta->user->name}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Email Peserta</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$peserta->user->email}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Kegiatan Training</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$peserta->activity->name}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Status</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$peserta->activity->status}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Waktu Mulai Training</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$peserta->activity->start}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Waktu Akhir Training</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$peserta->activity->end}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Message</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" rows="5" id="description" name="description" disabled style="background: #ebe8e8;">{{$peserta->activity->desc}}</textarea>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Baris keempat -->
          <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title">List Certificate Peserta Training {{$peserta->activity->name}}</h4>
                  <a data-toggle="modal" data-target="#addImageProductModal"><div class="btn btn-primary">+ Add Certificate Peserta</div></a>
              </div>
              <div class="card-body">
                <div class="table-responsive recentOrderTable">
                  <table class="table verticle-middle table-responsive-md">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Document</th>
                            <th scope="col">Tingkatan</th>
                            <th scope="col">Sending</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($peserta->certificates->count()==0)
                        <tr class="text-center">
                          <td colspan="10">Theres no certificate on  database</td>
                        </tr>     
                      @else
                      @foreach($peserta->certificates as $dd)
                      <tr>
                        <td scope="row">{{$loop->index+1}}</td>
                        <td colspan="1">{{$dd->document}}</td>
                        <td colspan="1">{{$dd->tingkatan}}</td>
                        <td>{{$dd->sending}}</td>
                        <td>
                          @if($dd['status'] == "not yet")
                          <span class="badge light badge-danger">unfinish</span>
                          @else
                          <span class="badge light badge-success">finish</span>
                          @endif
                        </td>
                        <td>
                          <form action="{{ route('admin.certificate.sending',$dd->id) }}" method="POST">
                          @csrf
                            <button type="submit" onclick="return confirm('Yakin mengirim document?')" class="btn btn--small btn--radius  btn-success btn--uppercase font--bold" style="width:100%;color:#00;">Send</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="addImageProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Certificate Peserta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="{{Route('admin.certificate.add', $peserta->id)}}" method="POST"  enctype="multipart/form-data">
          @csrf
            <div class="modal-body">     
              <section>
                <div class="row">
                  <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="text-label">Tingkatan*</label>
                        <div class="dropdown bootstrap-select form-control dropup">
                          <select name="tingkatan" id="tingkatan" class="form-control" tabindex="-98" required>
                            <option selected value="" disabled>Pilih Tingkatan Certificate</option>
                            <option value="peserta">Peserta</option>
                            <option value="juara 1">Juara I</option>
                            <option value="juara 2">Peserta</option>
                            <option value="juara 3">Peserta</option>
                          </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-12 mb-3">
                        <label for="document">Document</label>
                        <input type="file" class="form-control-file" id="filedoc" name="filedoc" required>
                    </div>
                </div>  
              </section>      
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>


@endsection