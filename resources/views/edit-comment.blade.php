@extends('layouts.main')

@section('content')
<div class="container">
  <div class="row justify-content-center mt-3">
    <div class="card mb-2 col-md-8">
      <div class="card-header text-center">
         التعليق
      </div>
      <div class="card-body">
        <form action="{{ route('comment.update', $comment->id) }}" method="post">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="comment">نص التعليق</label>
            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" aria-describedby="comment" name="comment" rows="4" autocomplete="comment">{{$comment->body}}</textarea>
            @error('comment')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form-group row">
            <div class="col-md-4">
                <button type="submit" class="btn btn-secondary">تعديل التعليق</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>    
@endsection
