@extends('layouts.main')

@section('content')
  <div class="mx-4">
    <p class="my-4"></p>
    <div class="row">
      @forelse ($videos as $video)
        @if ($video->processed)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card">
              <div class="card-icons">
                @php
                  $hours_add_zero = sprintf("%02d", $video->hours);
                  $minutes_add_zero = sprintf("%02d", $video->minutes);
                  $seconds_add_zero = sprintf("%02d", $video->seconds);
                @endphp
                <a href="#">
                  <img src="{{ Storage::url($video->image_path) }}" class="card-img-top" alt="...">
                  <time>{{($video->hours) > 0 ? $hours_add_zero.':' : ''}}{{$minutes_add_zero}}:{{$seconds_add_zero}}</time>
                  <i class="fas fa-play fa-2x"></i>
                </a>
              </div>
              <a href="#">
                <div class="card-body p-0">
                  <p class="card-title">{{ Str::limit($video->title, 60)}}</p>
                </div>
              </a>
              <div class="card-footer">
                <small class="text-muted">
                  <span class="d-block"><i class="fas fa-eye"></i>مشاهدة 10</span>
                  <i class="fas fa-clock"></i> <span>منذ 5 ساعات</span>
                </small>
                </div>
            </div>
          </div>
        @endif
          
      @empty
        <div class="mx-auto col-8">
          <div class="alert alert-primary text-center" role="alert">
            لايوجد فيديوهات
          </div>
        </div>          
      @endforelse
    </div>
  </div>    
@endsection