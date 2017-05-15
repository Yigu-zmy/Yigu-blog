@extends('home.base')

@section('content')
    <div class="container" style="margin-top: 20%">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <form class="form-horizontal" role="form" method="POST" action="/auth/register">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Name : </label>
                        <div class="col-sm-5">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email : </label>
                        <div class="col-sm-5">
                            <input type="email" name="email" value="{{ old('name') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password : </label>
                        <div class="col-sm-5">
                            <input type="password" name="password" value="{{ old('name') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Confirm Password : </label>
                        <div class="col-sm-5">
                            <input type="password" name="password_confirmation"  class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection