@extends('admin')


@section('content')

            <div class="row">
                <div class="col-lg-12" style="margin-top:20px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User (Total: {{ $data['pagination']['total'] }}) 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">

                                    <a href="/admin/adduser" class="btn btn-info" style="float:right;margin-bottom:10px">Add new User</a>

                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                        <thead>
                                            <tr role="row">
                                                <th tabindex="0" rowspan="1" colspan="1">Id</th>
                                                <th tabindex="0" rowspan="1" colspan="1">User name</th>
                                                <th tabindex="0" rowspan="1" colspan="1">First Name</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Last Name</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Email</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Role</th>
                                                <th style="text-align:center" tabindex="0" rowspan="1" colspan="1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for($i=0; $i<count($data['users']); $i+=1)
                                            <tr class="gradeA {{ ($i%2==1) ? 'odd' : 'even' }}">
                                                <td>{{ $data['users'][$i]['id'] }}</td>
                                                <td><a href="/user/{{ $data['users'][$i]['id'] }}">{{ $data['users'][$i]['username'] }}</a></td>
                                                <td>{{ $data['users'][$i]['first_name'] }}</td>
                                                <td>{{ $data['users'][$i]['last_name'] }}</td>
                                                <td>{{ $data['users'][$i]['email'] }}</td>
                                                <td>{{ ($data['users'][$i]['role']==1) ? 'Admin' : 'User' }}</td>
                                                <td style="text-align:center">
                                                    <a href="/admin/edituser/{{ $data['users'][$i]['id'] }}" type="button" class="btn btn-info btn-xs">Edit</a>
                                                    <a href="/admin/deluser/{{ $data['users'][$i]['id'] }}" onclick="return confirm('Are you sure you want to delete this user?');" type="button" class="btn btn-danger btn-xs">Delete</a>
                                                </td>
                                            </tr>
                                            @endfor
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all">
                                                Showing page {{ $data['pagination']['page'] }} of {{ $data['pagination']['pageCount'] }}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                                <ul class="pagination">
                                                    <?php
                                                    $page_prev = ($data['pagination']['page'] != 1) ? '/admin/users/page/'.($data['pagination']['page']-1) : '#';
                                                    $page_next = ($data['pagination']['page'] != $data['pagination']['pageCount']) ? '/admin/users/page/'.($data['pagination']['page']+1) : '#';
                                                    ?>
                                                    <li class="paginate_button previous {{ ($data['pagination']['page'] == 1) ? 'disabled' : '' }}" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="{{ $page_prev }}">Previous</a></li>
                                                    @for($j=1; $j<=$data['pagination']['pageCount'];$j+=1)
                                                    <li class="paginate_button {{ ($j==$data['pagination']['page']) ? 'active' : '' }}" aria-controls="dataTables-example" tabindex="0"><a href="/admin/users/page/{{ $j }}">{{ $j }}</a></li>
                                                    @endfor
                                                    <li class="paginate_button next {{ ($data['pagination']['page'] == $data['pagination']['pageCount']) ? 'disabled' : '' }}" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="{{ $page_next }}">Next</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

@stop