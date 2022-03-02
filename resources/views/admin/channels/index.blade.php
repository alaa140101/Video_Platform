@extends('theme.default')

@section('heading')
<link rel="stylesheet" href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('heading')
  صلاحيات القنوات
@endsection

@section('content')
  <hr>
  <div class="row">
    <div class="col-md-12">
      <table id="videos-table" class="table table-stribed text-right" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>اسم القناة</th>
            <th>البريد الالكتروني</th>
            <th>نوع القناة</th>
            <th>تعديل</th>
            <th>حذف</th>
            <th>حظر</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($channels as $channel)
            <tr>
              <td>{{ $channel->name }}</td>
              <td>{{ $channel->email }}</td>
              <td>{{ $channel->isSuperAdmin() ? 'مدير عام' : ($channel->isAdmin() ? 'مدير' : 'مستخدم' )}}</td>
               <td>
                <form action="{{ route('channels.update', $channel)}}" method="POST" class="ml-4 form-inline" style="display: inline-block">
                  @csrf
                  @method('PATCH')
                  <select name="administration_level" id="" class="form-control form-control-sm">
                    <option selected disabled>اختر نوعا</option>
                    <option value="0">مستخدم</option>
                    <option value="1">مدير</option>
                    <option value="2">مدير عام</option>
                  </select>
                  <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-edit"></i>تعديل </button>
                </form>
               </td>
               <td>
                <form action="{{ route('channels.destroy', $channel)}}" style="display: inline-block" method="post">
                  @method('DELETE')
                  @csrf
                  @if (auth()->user()->isSuperAdmin())
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('هل أنت متأكد أنك تريد حذف القناة')"> <i class="fa fa-trash"></i> حذف</button>
                  @elseif(auth()->user() == $channel)
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('هل أنت متأكد أنك تريد حذف القناة')"> <i class="fa fa-trash"></i> حذف</button>
                  @else
                    <button class="btn btn-danger btn-sm disabled" > <i class="fa fa-trash"></i> حذف</button>
                  @endif
                </form>
               </td>
               <td>
                <form action="#" style="display: inline-block" method="post">
                  @method('PATCH')
                  @csrf
                  {{-- ليس مدير عام ولا صاحب القناة --}}
                  @if (auth()->user()->isSuperAdmin() || auth()->user() == $channel)
                    @if($channel->block)
                      <button class="btn btn-warning btn-sm disabled" type="submit"> <i class="fas fa-lock"></i> محظورة</button>
                    @else
                      <button class="btn btn-warning btn-sm" type="submit" onclick="return confirm('هل أنت متأكد أنك تريد حظر القناة')"> <i class="fas fa-lock"></i>حظر  </button>
                      @endif
                  @else                      
                    <button class="btn btn-warning btn-sm disabled"> <i class="fas fa-lock"></i> حظر</button>
                  @endif
                </form>
               </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>    
@endsection

@section('script')
  <script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>     
  <script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  
  <script>
    $(document).ready(function() {
      $('#videos-table').DataTable({
          "language": {
            "url" : "//cdn.dataTables.net/plug-ins/1.10.19/i18n/Arabic.json"
          }
      });
    });
  </script>
@endsection