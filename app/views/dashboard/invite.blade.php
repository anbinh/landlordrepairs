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

                        <form style="display:none" id="upload" enctype="multipart/form-data" method="post" action="{{ url('upload/image') }}" autocomplete="off">
                        </form>
                        {{ Form::open(array('files' => true)) }}

                            <div class="form-group">
                                <label>Profile picture</label>
                                <?php
                                    $profile_picture = "";
                                    if($user->profile_picture != '') {
                                        $profile_picture = (strpos($user->profile_picture, "?")) ? $user->profile_picture : $user->profile_picture . "?" . time();
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
                                    <div style="display:none">
                                    <br />
                                        <input value="facebook" type="radio" id='facebook' onclick="hello.login('facebook');" name="profile_picture_url" /> Facebook Profile
                                        <br />
                                        <input value="twitter" type="radio" id='twitter' onclick="hello.login('twitter');" name="profile_picture_url" /> Twitter Profile
                                    </div>
                                    <input type="hidden" name="profile_pic_fl_url" id="profile_pic_fl_url" />
                                    <input type="hidden" name="profile_pic_fb_url" id="profile_pic_fb_url" />
                                    <input type="hidden" name="profile_pic_tw_url" id="profile_pic_tw_url" />
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
                        @if(Session::get("changepassrequest") == '1')
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            An email with a link is sent to your email address. please click the link to change your pasword.
                        </div>
                        @endif
                        <a class="btn btn-primary" href="/dashboard/profile/passrequest">Change password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop