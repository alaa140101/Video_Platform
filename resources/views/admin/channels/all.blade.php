@extends('theme.default')

@section('heading')
<link rel="stylesheet" href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('heading')
  جميع القنوات
@endsection

@section('content')
  <hr>
  <div class="row">
    <div class="col-md-12">
      <table id="videos-table" class="table table-stribed text-right" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>اسم القناة</th>
            <th>عدد مقاطع الفيديو</th>
            <th>مجموع المشاهدات</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($channels as $channel)
            <tr>
              <td><a href="{{ route('main.channels.videos', $channel) }}">{{ $channel->name }}</a></td>
              <td>{{ $channel->videos->count() }}</td>
              <td>{{ $channel->views->sum('views_number') }}</td>
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