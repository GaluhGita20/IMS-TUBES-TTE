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
            <li class="breadcrumb-item"><a href="{{Route('admin.document.index')}}">Document</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Detail Document</a></li>
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
                <h4 class="card-title">Detail Data Document</h4>
              </div>
              <div class="card-body">
                <div class="basic-form">
                  <form>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Id Document</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$document->id}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Document</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$document->document}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Activity</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$document->activity->name}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Document Hash</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$document->document_hash}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Status</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$document->status}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Title</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$document->title}}" disabled style="background: #ebe8e8;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Message</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" rows="5" id="description" name="description" disabled style="background: #ebe8e8;">{{$document->message}}</textarea>
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
                  <h4 class="card-title">List Signer Document</h4>
                  <a data-toggle="modal" data-target="#addImageProductModal"><div class="btn btn-primary">+ Add Signer Document</div></a>
              </div>
              <div class="card-body">
                <div class="table-responsive recentOrderTable">
                  <table class="table verticle-middle table-responsive-md">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Signer</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($document->signers->count()==0)
                        <tr class="text-center">
                          <td colspan="10">Theres no signer document on  database</td>
                        </tr>     
                      @else
                      @foreach($document->signers as $dd)
                      <tr>
                        <td scope="row">{{$loop->index+1}}</td>
                        <td colspan="1">{{$dd->name}}</td>
                        <td colspan="1">{{$dd->email}}</td>
                        <td>{{$dd->created_at}}</td>
                        <td>
                          <div class="d-flex">
                            <a href="" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-file"></i></a>
                            <div class="sweetalert" style="line-height:0px;">
                              <form action="{{ route('admin.signer.delete',$dd->id) }}" method="POST">
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
          <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12" style="">
                    <div class="sweetalert">
                      @if($document->status == "pending")
                        <form action="{{ route('admin.document.sending',$document->id) }}" method="POST">
                        @csrf
                          <button type="submit" onclick="return confirm('Yakin mengirim document?')" class="btn btn--small btn--radius  btn-success btn--uppercase font--bold" style="width:100%;color:#00;">Document Dikirim?</button>
                        </form>
                      @elseif($document->status == "sending")
                        <form action="{{ route('admin.document.integrasi',$document->id) }}" method="POST">
                        @csrf
                          <button type="submit" onclick="return confirm('Yakin sinkronisasi document?')" class="btn btn--small btn--radius  btn-success btn--uppercase font--bold" style="width:100%;color:#00;">Sinkronisasi Document dengan Server?</button>
                        </form>
                      @else
                          <a href="{{route('admin.document.download_final', $document->id)}}" type="submit" class="btn btn--small btn--radius  btn-success btn--uppercase font--bold" style="width:100%;color:#00;">Download Document Final</a>
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
            <h5 class="modal-title" id="exampleModalLabel">Add Signer Document</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="{{Route('admin.signer.add', $document->id)}}" method="POST"  enctype="multipart/form-data">
          @csrf
            <div class="modal-body">     
              <section>
                <div class="row">
                  <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="text-label">Nama Document*</label>
                        <input type="text" name="doc" id="doc" class="form-control" value="{{$document->document}}" disabled>
                    </div>
                  </div>
                  <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="text-label">Nama Signer*</label>
                        <input type="text" name="name_signer" id="name_signer" class="form-control" value="">
                    </div>
                  </div>
                  <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="text-label">Email Signer*</label>
                        <input type="text" name="email_signer" id="email_signer" class="form-control" value="">
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