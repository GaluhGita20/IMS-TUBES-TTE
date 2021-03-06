<div class="col-lg-12">
  <div class="card">
    <div class="card-search" style="padding-top:1.5rem; padding-right: 1.875rem; padding-bottom: 1.25 rem; padding-left:1.875rem; position: relative; align-items: center;">
      <div class="form-group">
        <input type="text" wire:model="searchProduct" class="form-control"  placeholder="Search data document">
      </div>
    </div>
    <div class="card-header">
        <h4 class="card-title">Table Document</h4>
        <a href="{{route('admin.document.create')}}"><div class="btn btn-primary">+ Add Data Document</div></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-responsive-sm">
          <thead>
            <tr>
              <th>No</th>
              <th>Document</th>
              <th>Nama Kegiatan Traning</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @if($documents->count()== 0)
            <tr class="text-center">
              <td colspan="10">Theres no document on  database</td>
            </tr>
          @endif
          @foreach($documents as $document)
          <tr>
            <td scope="row">{{$loop->index+1}}</td>
            <td colspan="1">{{$document->document}}</td>
            <td colspan="1">{{$document->activity->name}}</td>
            <td colspan="1">{{$document->status}}</td>
            <td colspan="1">{{$document->created_at}}</td>
            <td colspan="1">
              @if($document['status'] == "pending")
              <span class="badge light badge-danger">Pending</span>
              @elseif($document['status'] == "sending")
              <span class="badge light badge-success">Sending</span>
              @elseif($document['status'] == "finish")
              <span class="badge light badge-success">Finish</span>
              @endif
            </td>
            <td>
              <div class="d-flex">
                <a href="{{route('admin.document.detail', $document->id)}}" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-file"></i></a>
                <!-- <a href="{{route('admin.document.edit', $document->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a> -->
                <div class="sweetalert">
                  <form action="{{ route('admin.document.destroy', $document->id) }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('Yakin Ingin Mengapus Data?')" class="btn btn-danger shadow btn-xs sharp sweet-success-cancel"><i class="fa fa-trash"></i></button>                 
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>
        <style>
          nav .flex.justify-between.flex-1{
            display:none;
          }
          .w-5.h-5{
            width:50px;
          }
          </style>
        
      </div>
    </div>
  </div>
</div>