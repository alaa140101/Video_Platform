@extends('theme.default')

@section('heading')
<link rel="stylesheet" href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('heading')
   القنوات المحظورة
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
            <th>تاريخ الانشاء</th>
            <th>فك الحظر</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($channels as $channel)
            <tr>
              <td>{{ $channel->name }}</td>
              <td>{{ $channel->email }}</td>
              <td>{{ $channel->created_at->diffForHumans() }}</td>                            
              <td>
              <form action="{{ route('channels.block', $channel)}}" style="display: inline-block" method="post">
                @method('PATCH')
                @csrf
                {{-- ليس مدير عام ولا صاحب القناة --}}
                @if (auth()->user()->isSuperAdmin() || auth()->user() == $channel)
                  @if($channel->block)
                    <button class="btn btn-warning btn-sm disabled"> <i class="fas fa-lock"></i> محظورة</button>
                  @else
                    <button class="btn btn-warning btn-sm" type="submit" onclick="return confirm('هل أنت متأكد أنك تريد فك حظر القناة')"> <i class="fas fa-lock"></i>حظر  </button>
                  @endif                
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