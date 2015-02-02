@extends('admin')


@section('content')

<div class="row">
    <div class="col-lg-6" style="margin-top:30px">
        <div class="panel panel-default">
            <div class="panel-heading">
                User Profile
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                        </div>
                        @endif
                        @if(Session::get("success") == '1')
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Profile has been updated successfully.
                        </div>
                        @endif
                        <form style="display:none" id="upload" enctype="multipart/form-data" method="post" action="{{ url('upload/image/$user->username') }}" autocomplete="off">
                        </form>
                        {{ Form::open(array('files' => true)) }}

                            <div class="form-group">
                                <label>Profile picture</label>
                                <?php
                                    $profile_picture = "";
                                    if($user->profile_picture != '') {
                                        $profile_picture = (strpos($user->profile_picture, "facebook.com") >=0 || strpos($user->profile_picture, "twitter.com") >=0) ? $user->profile_picture : $user->profile_picture . "?" . time();
                                    }
                                    else {
                                        $profile_picture = "/uploads/default.jpg";
                                    }
                                    //echo $profile_picture;
                                ?>
                                <img id='profile_pic_preview' src="{{ $profile_picture }}" style="max-width:100px;max-height:100px;vertical-align: top;" />
                                <div style="float:right">
                                    <input value="file_up" type="radio" id='file_upload' name="profile_picture_url" />
                                    <span id="profile_picture_container">{{ Form::file('profile_picture', array('class' => 'form-control','id' => 'profile_picture', 'style' => 'width: 120px;display:inline')) }}</span>
                                    <input type="hidden" name="profile_pic_fl_url" id="profile_pic_fl_url" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                {{ Form::text('username', $user->username, array('placeholder' => 'Choose your username', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label>First name</label>
                                {{ Form::text('first_name', $user->first_name, array('placeholder' => 'Choose your first name', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label>Last name</label>
                                {{ Form::text('last_name', $user->last_name, array('placeholder' => 'Choose your last name', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                {{ Form::text('email', $user->email, array('class' => 'form-control', 'disabled' => 'disabled')) }}
                            </div>
                            <div class="form-group">
                                <label>Email confirmation: Yes</label>
                            </div>
                            <div class="form-group">
                                <label>Admin {{ Form::checkbox('role', ($user->role == 1), ($user->role == 1), array('style' => 'vertical-align:top;margin-left:7px')) }}</label>
                            </div>

                            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                            {{ Form::reset('Reset', array('class' => 'btn btn-default')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="margin-top:30px">
        <div class="panel panel-default">
            <div class="panel-heading">
                Change password
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if(count(Session::get("perror"))>0)
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ Session::get("perror")['password'][0] }}
                        </div>
                        @endif
                        @if(Session::get("cpsuccess") == "1")
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            User password has been changed successfully.
                        </div>
                        @endif
                        {{ Form::open(array('route' => array('admin.changeuserpass', 1))) }}
                            <div class="form-group">
                                {{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::password('password_confirmation', array('placeholder' => 'Re-enter Password', 'class' => 'form-control')) }}
                            </div>
                            {{ Form::submit('Change password', array('class' => 'btn btn-primary')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop