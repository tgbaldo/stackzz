@extends('layouts.login')

@section('content')

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Stack</b>zz</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
<!--     <p class="login-box-msg">Faça seu login</p>
 -->    <a href="{{url('login/google')}}" class="btn btn-primary btn-block">Login com Google</a>
  </div>
  <!-- /.login-box-body -->
</div>
@endsection
