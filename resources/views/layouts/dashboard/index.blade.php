@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
<h1 >welcome @auth

 {{Auth::user()->name}}
 @endauth </h1>
</section>

<section class="content">
  <h2>  hello my freind </h2>
</section>
</div>
@endsection
