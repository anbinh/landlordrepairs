@extends('admin')


@section('content')

<div class="row">
    <div class="col-lg-12" style="margin-top:30px">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add user
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                        </div>
                        @endif
                        @if(Session::get("cpsuccess") == '1')
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            A new user has been added.
                        </div>
                        @endif
                        <form style="display:none" id="upload" enctype="multipart/form-data" method="post" action="{{ url('upload/image') }}" autocomplete="off">
                        </form>
                        {{ Form::open(array('files' => true)) }}
                            <div class="form-group">
                                <label>Profile picture</label>
                                <img id="profile_pic_preview" src="/uploads/default.jpg" style="max-width:100px;max-height:100px;vertical-align: top;" />
                                <div style="float:right">
                                    <input value="file_up" type="radio" id='file_upload' name="profile_picture_url" />
                                    <span id="profile_picture_container">{{ Form::file('profile_picture', array('class' => 'form-control','id' => 'profile_picture', 'style' => 'width: 120px;display:inline')) }}</span>
                                    <input type="hidden" name="profile_pic_fl_url" id="profile_pic_fl_url" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                {{ Form::text('username', '', array('placeholder' => 'Choose username', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label>First name</label>
                                {{ Form::text('first_name', '', array('placeholder' => 'Choose first name', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label>Last name</label>
                                {{ Form::text('last_name', '', array('placeholder' => 'Choose last name', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                {{ Form::text('email', '', array('placeholder' => 'Choose email', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label>Re-enter password</label>
                                {{ Form::password('password_confirmation', array('placeholder' => 'Re-enter Password', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label>Admin {{ Form::checkbox('role', '1', false, array('style' => 'vertical-align:top;margin-left:7px')) }}</label>
                            </div>

                            {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
                            {{ Form::reset('Reset', array('class' => 'btn btn-default')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@stop