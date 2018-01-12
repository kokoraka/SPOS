@extends('layouts.single')

@section('title', 'S-POS - Login')

@section('content')
    <div>

  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
          {{ csrf_field() }}
          <h1>S-POS Login</h1>
          <div class="form-group{{ $errors->has('kode_pegawai') ? ' has-error' : '' }}">
            <input id="username" type="text" class="form-control" name="kode_pegawai"  placeholder="Kode Pegawai" value="{{ old('kode_pegawai') }}">
            @if ($errors->has('kode_pegawai'))
                <span class="help-block">
                    <strong>{{ $errors->first('kode_pegawai') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password" placeholder="Kata Sandi Pegawai" >
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
          <div>
            <button class="btn btn-primary submit btn-block" type="submit">Masuk</button>
          </div>
          <div class="clearfix"></div>
          <div class="separator">
            <div class="clearfix"></div>
            <br />
            <div>
              <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
              <p>
                Thank you so much, Gentelella Alela.
              </p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>

@endsection
