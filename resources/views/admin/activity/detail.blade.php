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
            <li class="breadcrumb-item"><a href="{{Route('admin.training.index')}}">Training</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Detail Training</a></li>
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
                <h4 class="card-title">Detail Data Training</h4>
              </div>
              <div class="card-body">
                <div class="basic-form">
                  <form>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Id Training</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$training->id}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Kegiatan Training</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$training->name}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Waktu Mulai Berlangsung</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$training->start}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Waktu Akhir Berlangsung</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$training->end}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Status Training</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$training->status}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Deskripsi Training</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" rows="5" id="description" name="description" disabled style="background: #ebe8e8;">{{$training->desc}}</textarea>
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
                  <h4 class="card-title">List Peserta Training</h4>
                  <a data-toggle="modal" data-target="#addImageProductModal"><div class="btn btn-primary">+ Add Peserta Training</div></a>
              </div>
              <div class="card-body">
                <div class="table-responsive recentOrderTable">
                  <table class="table verticle-middle table-responsive-md">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Peserta</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($training->activity_detail_participants->count()==0)
                        <tr class="text-center">
                          <td colspan="10">Theres no peserta training on  database</td>
                        </tr>     
                      @else
                      @foreach($training->activity_detail_participants as $dd)
                      <tr>
                        <td scope="row">{{$loop->index+1}}</td>
                        <td colspan="1">{{$dd->user->name}}</td>
                        <td colspan="1">{{$dd->status}}</td>
                        <td>{{$dd->created_at}}</td>
                        <td>
                          <div class="d-flex">
                            <a href="{{route('admin.peserta.index', [$dd->id, $training->id])}}" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-file"></i></a>
                            <div class="sweetalert" style="line-height:0px;">
                              <form action="{{ route('admin.training.peserta_delete',$training->id) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Yakin Ingin Mengapus Data?')" class="btn btn-danger shadow btn-xs sharp sweet-success-cancel"><i class="fa fa-trash"></i></button>                 
                              </form>
                            </div>
                          </div>
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

          <!-- button for update status training -->
          <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12" style="">
                    <div class="sweetalert">
                      @if($training->status == "unfinish")
                        <form action="{{ route('admin.training.isFinish',$training->id) }}" method="POST">
                        @csrf
                          <button type="submit" onclick="return confirm('Yakin mengubah status training menjadi completed/finish?')" class="btn btn--small btn--radius  btn-success btn--uppercase font--bold" style="width:100%;color:#00;">Masa Kegiatan Training Selesai?</button>
                        </form>
                      @endif
                    </div>
                  </div>        
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
            <h5 class="modal-title" id="exampleModalLabel">Add Peserta Training</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="{{Route('admin.training.peserta_add', $training->id)}}" method="POST"  enctype="multipart/form-data">
          @csrf
            <div class="modal-body">     
              <section>
                <div class="row">
                  <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="text-label">Nama Kegiatan Training*</label>
                        <input type="text" name="id_product" id="id_product" class="form-control" value="{{$training->name}}" disabled>
                    </div>
                  </div>
                  <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="text-label">Id Peserta*</label>
                        <div class="dropdown bootstrap-select form-control dropup">
                          <select name="peserta_id" id="peserta_id" class="form-control" tabindex="-98" required>
                            <option selected value="" disabled>Pilih Id Peserta Training</option>
                            @foreach($users as $c)
                              <option value="{{$c->id}}">{{$c->id}} - {{$c->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
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