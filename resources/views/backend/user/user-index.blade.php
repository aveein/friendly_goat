@extends('backend.master')
@push('css')
  <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
@endpush
@section('content')


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->

 
          <div class="col-md-6">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          @if (Session::has('success'))

          <div class="alert alert-success">
                <p>{{Session::get('success')}}</p>
            </div>
          @endif
            <!-- general form elements -->

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" value="{{!is_null($user) ? $user->name : ''}}" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" value="{{!is_null($user) ? $user->email : ''}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>

                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <br>
                    @if (!is_null($user) && $user->image_path)
                      <img src="{{asset($user->image_path)}}" alt="" height="300px">
                    @endif
                  </div>
                  <div class="form-group">
                    <label for=""> Status</label>
                    <input type="checkbox" name="active_status" value="1" @if (!is_null($user) && $user->active_status)
                    checked
                    @endif  data-bootstrap-switch>

                  </div>
                  
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- general form elements -->
  
            <!-- /.card -->

            <!-- Input addon -->
       
            <!-- /.card -->
  
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
      
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@push('js')
<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script>
    $('.duallistbox').bootstrapDualListbox()
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    </script>
@endpush