@extends('layouts.master')


@section('content')
    @include('tweets.new')
    @include('tweets.all')
@endsection

@section('script')
    {{-- <script>
      let newTweetChannel = pusher.subscribe("make-tweet");
      newTweetChannel.bind("new-tweet", function(data) {
        alert(data);
      });

    </script> --}}
@endsection
