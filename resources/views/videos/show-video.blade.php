@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col-10">
        <input type="hidden" id="videoId" value="{{$video->id}}">
        <div class="vidcontainer">
          @foreach ($video->convertedvideos as $video_converted)
            <video id="videoPlayer" controls style='{{$video->Longitudinal == "0" ? "widht: 90vw; height: 80vh;" : "width: 70vw; height: 80vh;"}}'>
              @if ($video->quality == 1080)
                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_1080) }}" type="video/webm">                  
                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_1080) }}" type="video/mp4">                  
              @elseif ($video->quality == 720)
                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_720) }}" type="video/webm">                  
                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_720) }}" type="video/mp4">                  
              @elseif ($video->quality == 480)
                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_480) }}" type="video/webm">                  
                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_480) }}" type="video/mp4">                  
              @elseif ($video->quality == 360)
                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_360) }}" type="video/webm">                  
                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_360) }}" type="video/mp4">                  
              @else
                <source id="webm_source" src="{{ Storage::url($video_converted->webm_Format_240) }}" type="video/webm">                  
                <source id="mp4_source" src="{{ Storage::url($video_converted->mp4_Format_240) }}" type="video/mp4">                  
              @endif
            </video>              
          @endforeach
          <select id="qualityPick">
            <option value="1080" {{$video->quality == 1080 ? 'selected' : ''}} {{$video->quality < 1080 ? 'hidden' : ''}}>1080</option>
            <option value="720" {{$video->quality == 720 ? 'selected' : ''}} {{$video->quality < 720 ? 'hidden' : ''}}>720</option>
            <option value="480" {{$video->quality == 480 ? 'selected' : ''}} {{$video->quality < 480 ? 'hidden' : ''}}>480</option>
            <option value="360" {{$video->quality == 360 ? 'selected' : ''}} {{$video->quality < 360 ? 'hidden' : ''}}>360</option>
            <option value="240" {{$video->quality == 240 ? 'selected' : ''}}>240</option>
          </select>
          <div class="title mt-3">
            <h5>
              {{$video->title}}
            </h5>
          </div>

          <div class="interaction text-center mt-5">
            <a href="#" class="like ml-3">
              @if ($userLike && $userLike->like == 1)
                <i class="far fa-thumbs-up fa-2x liked"></i><span id="likeNumber">{{$countLike}}</span>                  
              @else 
                <i class="far fa-thumbs-up fa-2x"></i><span id="likeNumber">{{$countLike}}</span>
              @endif 
            </a> |
            <a href="#" class="like mr-3">
              @if ($userLike && ($userLike->like == 0))
                <i id="like_down" class="far fa-thumbs-down fa-2x liked"></i><span id="dislikeNumber">{{$countDislike}}</span>
              @else 
                <i id="like_down" class="far fa-thumbs-down fa-2x"></i><span id="dislikeNumber">{{$countDislike}}</span>
              @endif 
            </a>

            @foreach ($video->views as $view)
                <span class="float-right">عدد المشاهدات <span class="viewsNumber">{{$view->views_number}}</span></span>
            @endforeach

            <div class="loginAlert mt-5">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>    
@endsection

@section('script')
<script>
  document.getElementById("qualityPick").onchange = function() {changeQulity()};

  function changeQulity() {
    var video = document.getElementById("videoPlayer");
    curTime = video.currentTime;
    var selected = document.getElementById("qualityPick").value;
    

    if(selected == '1080') {
      source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_1080) }}";
      source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_1080) }}";
    } else if(selected == '720') {
      source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_720) }}";
      source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_720) }}";
    } else if(selected == '480') {
      source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_480) }}";
      source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_480) }}";
    } else if(selected == '360') {
      source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_360) }}";
      source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_360) }}";
    } else if(selected == '240') {
      source = document.getElementById("webm_source").src = "{{ Storage::url($video_converted->webm_Format_240) }}";
      source = document.getElementById("mp4_source").src = "{{ Storage::url($video_converted->mp4_Format_240) }}";
    }

    video.load();
    video.play();
    video.currentTime = curTime;
  }
</script> 

<script>
  $('.like').on('click', function(event){
    var token = '{{ Session::token() }}';
    var urlLike = '{{ route('like') }}';

    var videoId = 0;

    var AuthUser = "{{{ (Auth::user()) ? 0 : 1 }}}";

    event.preventDefault();
    
    if(AuthUser == '1'){
      var loginMessage = '<div class="alert alert-danger">\
                    <ul>\
                      <li class="loginAlert"> يجب تسجيل الدخول لكي تستطيع الإعجاب بالفيديو</li>\
                    </ul>\
                  </div>';
      $('.loginAlert').html(loginMessage);
    }else{
      videoId = $("#videoId").val();
      var isLike = event.target.parentNode.previousElementSibling == null;
      $.ajax({
        method: 'POST',
        url: urlLike,
        data: {
          isLike: isLike,
          videoId: videoId,
          _token: token
        },
        success : function(data) {
          if($(event.target).hasClass('fa-thumbs-up')){
            if($(event.target).hasClass('liked')){
              $(event.target).removeClass("liked");
            }else{
              $(event.target).addClass("liked");
            }
            $('#likeNumber').html(data.countLike);
            $('#dislikeNumber').html(data.countDislike);
          }
          if($(event.target).hasClass('fa-thumbs-down')){
            if($(event.target).hasClass('liked')){
              $(event.target).removeClass("liked");
            }else{
              $(event.target).addClass("liked");
            }
            $('#likeNumber').html(data.countLike);
            $('#dislikeNumber').html(data.countDislike);
          }
          if(isLike){
            $(".fa-thumbs-down").removeClass("liked");
          }else{
            $(".fa-thumbs-up").removeClass("liked");
          }
        }
      })
    }
  });
</script> 

<script>
  $('#videoPlayer').on('ended', function(e){
      event.preventDefault();
      const token = '{{ Session::token() }}';
      const urlComment = '{{ route('view') }}';
      const videoId = $("#videoId").val();

      $.ajax({
          method: 'POST',
          url: urlComment, 
          data: {
              videoId: videoId,
              _token: token
          },
          success : function(data) {
            $(".viewsNumber").html(data.viewsNumbers);
          }
      })
  })
</script>
@endsection