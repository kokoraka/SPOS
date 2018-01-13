@extends('layouts.single')

@section('title', 'SPOS - 404 Error')

@section('content')
  <div class="container">
    <div class="">
      <div class="col-md-offset-3 col-md-6">
        <h2 class="text-center" style="font-size: 20pt;">
          Content not found
          <br />
          <small>Oops, the content you're looking for is not found.</small>
        </h2>
        <br />
        <p class="text-center">
          <i class="material-icons font-30">filter_vintage</i>
          <br />
          <a class="fg-red" href="{{ url()->previous() }}"><b>Return to the previous page</b></a>
        </p>
      </div>
    </div>
  </div>

@endsection
