<div class="col-lg-12">
  <div class="card">
    <div class="card-search" style="padding-top:1.5rem; padding-right: 1.875rem; padding-bottom: 1.25 rem; padding-left:1.875rem; position: relative; align-items: center;">
      <div class="form-group">
        <input type="text" wire:model="searchProduct" class="form-control"  placeholder="Search data training">
      </div>
    </div>
    <div class="card-header">
        <h4 class="card-title">Table Training</h4>
        <a href="{{route('admin.training.create')}}"><div class="btn btn-primary">+ Add Data Training</div></a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-responsive-sm">
          <thead>
            <tr>
              <th>No</th>
              <th>Training</th>
              <th>Desc</th>
              <th>Start</th>
              <th>End</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @if($activities->count()== 0)
            <tr class="text-center">
              <td colspan="10">Theres no training found on  database</td>
            </tr>
          @endif
          @foreach($activities as $activity)
          <tr>
            <td scope="row">{{$loop->index+1+($activities->currentPage()-1)*5}}</td>
            <td colspan="1">{{$activity->name}}</td>
            <td colspan="1">{{substr($activity->desc, 0, 50)}}...</td>
            <td colspan="1">{{$activity->start}}</td>
            <td colspan="1">{{$activity->id}}</td>
            <td colspan="1">
              @if($activity['status'] == "unfinish")
              <span class="badge light badge-success">unfinish</span>
              @else
              <span class="badge light badge-danger">End</span>
              @endif
            </td>
            <td>
              <div class="d-flex">
                <a href="{{route('admin.training.detail', $activity->id)}}" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-file"></i></a>
                <a href="{{route('admin.training.edit', $activity->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                <div class="sweetalert">
                  <form action="{{ route('admin.training.destroy', $activity->id) }}" method="POST">
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
        {{$activities->links()}}
      </div>
    </div>
  </div>
</div>