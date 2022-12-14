@extends('backend.admin.dashboard')
@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Bordered Table</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">STT</th>
                <th>Avatar</th>
                <th>Tên</th>
                <th>Email</th>

                <th>Vai trò</th>
                <th>Kích hoạt</th>

              </tr>
              @foreach ($data as $key => $item )

              <tr class="item-{{ $item->id }}">
                <td>{{ $key + 1 }} </td>
                <td>
                    @if ( file_exists($item->avatar))
                     <img src="  {{ asset($item->avatar )}}" width="200" height="150" alt="">
                    @else
                    <img src="  {{ asset('upload/404.jpg' )}}" width="200" height="150" alt="">
                    @endif



                </td>

                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>

                <td>

                        @if ($item->role_id==1)
                        <span class="badge bg-blue">    Member</span>

                        </span>

                        @elseif ($item->role_id==2)
                        <span class="badge bg-yellow">  Administrator</span>


                        @else

                        None
                        @endif


                </td>
                <td>
                    <span class="badge bg-blue">
                        @if ($item->is_active==1)
                        Kích hoạt
                        @elseif ($item->is_active==0)
                        Banner
                        @else
                        None
                        @endif
                    </span>
                </td>
                <td>
                    <a href="{{ route('users.edit',['user' => $item->id])}}"  type="button" class="btn btn-info"><i class="fa fa-pencil-square-o" >  </i></a>

            </td>
              </tr>
              @endforeach




            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            {!! $data->links('vendor.pagination.admin-custom') !!}
          </div>
        </div>
      </div>
    </div>
</section>

@endsection


@section('js')
    <script type="text/javascript">
        $( document ).ready(function() {

            $('.deleteItem').click(function () {
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url : 'users/'+id,
                            type: 'DELETE',
                            data: {},
                            success: function (res) {
                                if(res.status) {
                                    $('.item-'+id).remove();
                                }
                            },
                            error: function (res) {
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
