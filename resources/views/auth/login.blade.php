@extends('home.base')

@section('content')
    <div class="container" style="margin-top: 20%">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <form class="form-horizontal" role="form" method="POST" action="/auth/login">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email : </label>
                        <div class="col-sm-5">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password : </label>
                        <div class="col-sm-5">
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember">Remember me</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection