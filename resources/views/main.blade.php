@extends('layouts.main')

@section('content')
  <div class="mx-4">
    <div class="row justify-content-center">
      <form action="{{ route('video.search') }}" method="GET" class="form-inline col-md-6 justify-content-center">
      @csrf
        <input type="text" class="form-control mx-sm-3 mb-2" name="term">
        <button type="submit" class="btn btn-secondary mb-2">ابحث</button>
      </form>
    </div>
    <hr>
    <br>
    <p class="my-4">{{$title}}</p>
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
                <a href="/videos/{{$video->id}}">
                  <img src="{{ Storage::url($video->image_path) }}" class="card-img-top" alt="...">
                  <time>{{($video->hours) > 0 ? $hours_add_zero.':' : ''}}{{$minutes_add_zero}}:{{$seconds_add_zero}}</time>
                  <i class="fas fa-play fa-2x"></i>
                </a>
              </div>
              <a href="/videos/{{$video->id}}">
                <div class="card-body p-0">
                  <p class="card-title">{{ Str::limit($video->title, 60)}}</p>
                </div>
              </a>
              <div class="card-footer">
                <small class="text-muted">
                  @foreach ($video->views as $view)
                    <span class="d-block"><i class="fas fa-eye"></i>مشاهدة {{$view->views_number}}</span>
                  @endforeach
                  <i class="fas fa-clock"></i> <span> {{$video->created_at->diffForHumans()}}</span>
                </small>
                </div>
                <a href="{{ route('main.channels.videos', $video->user) }}" class="channel-img">
                  <img src="{{ $video->user->profile_photo_url }}" alt="" class="rounded-full my-1 mr-3 d-inline" width="30">
                  <span class="card-text">{{ $video->user->name }}</span>
                </a>
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