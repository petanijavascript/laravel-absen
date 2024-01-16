@extends('layout.template')

@section('title')
Absensi
@endsection
@section('heading')
Register
@endsection
@section('content')
<div class="col-12">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List of User</h6>
    </div>
    <div class="card-body">
        <div class="div col-lg-12 text-right" style="height: 50px;">
            <button class="btn btn-primary" name="tambah" style="vertical-align: middle">Add User</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach($pengguna as $data)
                <tr>
                    <input type="hidden" name="email[]" value="{{ $data->email }}">
                    <input type="hidden" name="nama[]" value="{{ $data->nama }}">
                    <input type="hidden" name="password[]" value="{{ $data->realpassword }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->realpassword }}</td>
                    <td>
                        <button class="btn btn-warning" name="edit[]">Update</button> <button class="btn btn-danger" name="delete[]">Delete</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
  
  <!-- Modal -->
  <div class="modal fade" id="editRegisterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/register/update" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" id="emailedit" class="form-control" aria-describedby="emailHelp" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" name="nama" id="namaedit" class="form-control" aria-describedby="nameHelp" placeholder="Isikan nama">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="text" name="password" id="passwordedit" class="form-control" aria-describedby="passwordHelp" placeholder="Isikan password">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="tambahRegisterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/register/store" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" id="emailtambah" class="form-control" aria-describedby="emailHelp" placeholder="Isikan email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" name="nama" id="namatambah" class="form-control" aria-describedby="nameHelp" placeholder="Isikan nama">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="text" name="password" id="passwordtambah" class="form-control" aria-describedby="passwordHelp" placeholder="Isikan password">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('javascript')
<script type="text/javascript">
$(function () {

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $("button[name='edit[]']").click(function(){
        var id = $("button[name='edit[]']").index(this);

        var email = $("input[name='email[]']:eq("+id+")").map(function() {
          return this.value;
        }).get();
        var nama = $("input[name='nama[]']:eq("+id+")").map(function() {
          return this.value;
        }).get();
        var password = $("input[name='password[]']:eq("+id+")").map(function() {
          return this.value;
        }).get();
        
        $("#emailedit").val(email);
        $("#namaedit").val(nama);
        $("#passwordedit").val(password);

        $('#editRegisterModal').modal('show');
    });

    $("button[name='delete[]']").click(function(){
        var id = $("button[name='delete[]']").index(this);
        var _url = "{{ url('/')}}/register/delete";

        var email = $("input[name='email[]']:eq("+id+")").map(function() {
          return this.value;
        }).get();

        $.ajax({
        type: 'post',
        dataType: 'json',
        url: _url,
        data: {
            email : email,
        },
        success: function (data) {
            console.log('Success:', data);
            window.location.reload();
        },
        error: function (data) {
            console.log('Error:', data);
        }
        });
    });

    $("button[name='tambah']").click(function(){
        $('#tambahRegisterModal').modal('show');
    });
});
</script>
@endsection