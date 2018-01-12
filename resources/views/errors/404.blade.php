@extends('layouts.single')

@section('title', 'Status')

@section('content')
  <div class="mdl-grid">
    <div class="mdl-cell--12-col">
      <h2 class="text-center">
        Content not found
        <br />
        <small>Oops, the content you're looking for is not found.</small>
      </h2>
      <br />
      <p class="text-center">
        <i class="material-icons font-30">filter_vintage</i>
        <br />
        <a class="normalize-link fg-red" href="{{ url()->previous() }}"><b>Return to the previous page</b></a>
      </p>
    </div>
  </div>
@endsection
