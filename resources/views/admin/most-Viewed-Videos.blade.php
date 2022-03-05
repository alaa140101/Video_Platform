@extends('theme.default')

@section('heading')
 الفيديوهات الاكثر مشاهدة
@endsection

@section('content')
  <hr>
  <div class="row">
    <div class="col-md-12">
      <table id="videos-table" class="table table-stribed text-right" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>اسم الفيديو</th>
            <th>اسم القناة</th>
            <th>عدد المشاهدات</th>
            <th>تاريخ النشر</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($mostViewedVideos as $view)
            <tr>
              <td><a href="/videos/{{$view->video->id}}">{{ $view->video->title }}</a></td>
              <td>{{ $view->user->name }}</td>
              <td>{{ $view->views_number }}</td>
              <td>
                <p>{{ $view->video->created_at }}</p>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>   
  <div>
    <canvas id="myChart" class="mt-4"></canvas>
  </div> 
@endsection


@section('script')
<script>
  const names = <?php echo $videoNames; ?>;
  const totalViews = <?php echo $videoViews; ?>;

  const data = {
    labels: names,
    datasets: [{
      label: 'الفيديوهات الاكثر مشاهدة',
      backgroundColor: 'rgb(0, 33, 47)',
      borderColor: 'rgb(255, 99, 132)',
      data: totalViews,
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
@endsection