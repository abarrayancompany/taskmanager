@if (Session::has('success_message'))
<div class="col-md-12 mb-4">
    <div class="alert alert-success">
     {{Session::get('success_message')}}
    </div>
</div>
<br>
@endif
@if (Session::has('error_message'))
<div class="col-md-12 mb-4">
    <div class="alert alert-danger m-2" role="alert">
        {{Session::get('error_message')}}
    </div>
</div>
<br>
@endif
@if ($errors->any())
<div class="alert alert-danger m-2" role="alert">
    @foreach ($errors->all() as $error)
   <li>{{$error}}</li>
</div>
<br>
  @endforeach
@endif
