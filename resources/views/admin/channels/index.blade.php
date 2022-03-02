@extends('theme.default')

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
              <td>{{ $channel->isSuperAmin() ? 'مدير عام' : ($channel->isAdmin() ? 'مستخدم' : 'مدير') }}</td>
               <td>
                <form action="#" method="POST" class="ml-4 form-inline" style="display: inline-block">
                  
                </form>
               </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
    
@endsection