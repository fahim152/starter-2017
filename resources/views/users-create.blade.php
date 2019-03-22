@extends('layouts.master')

@section('title', 'Create User')

@section('style')
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1> @lang('dashboard.dashboard_title.user') {{ ($user['id'] != "") ? __('dashboard.dashboard_title.edit') : __('dashboard.dashboard_title.create') }}
                    <small></small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">@lang('dashboard.dashboard_title.dashboard')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ route('users') }}">  @lang('dashboard.dashboard_title.users')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">{{ ($user['id'] != "") ? __('dashboard.dashboard_title.edit') : __('dashboard.dashboard_title.create') }}</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->

        <div class="page-content-col">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-user"></i>
                        <span class="caption-subject bold uppercase"> {{ ($user['id'] != "") ? __('dashboard.dashboard_title.edit_form') : __('dashboard.dashboard_title.create_form')  }} </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="ajax-form" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="action" value="{{ route('user_update') }}">
                                <input type="hidden" name="method" value="POST">
                                <input type="hidden" name="user" value="{{$user['id']}}">
                                <div class="form-body">

                                    @if(isset($districts))
                                    <!-- District -->
                                    <div class="form-group has-error-district">
                                        <label class="col-md-3 control-label"> @lang('dashboard.dashboard_title.district') <span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-4">
                                            <select class="form-control select_dropdown" name="district" id="select_district" data-action="{{ route('district_offices_load') }}" data-target="#office" required="">
                                                <option value="">-- @lang('dashboard.dashboard_title.select_district') --</option>
                                                @foreach ($districts as $district)
                                                <option value="{{$district->id}}" {{( isset($user->district) and $district->id == $user->district->id)?" selected=''" : ""}}>{{$district->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    <!--User Office-->
                                    <div class="form-group has-error-office">
                                        <label class="col-md-3 control-label"> @lang('dashboard.dashboard_title.office') <span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="office" name="office" required="">
                                                <option value="">-- @lang('dashboard.dashboard_title.select_office') --</option>
                                                @if(isset($offices))
                                                @foreach ($offices as $office)
                                                <option value="{{$office->id}}" {{( isset($user->office) and $office->id == $user->office->id)?" selected=''" : ""}}>{{$office->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <!--User Group-->
                                    <div class="form-group has-error-group">
                                        <label class="col-md-3 control-label"> @lang('dashboard.dashboard_title.group') <span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="group"name="group" required="">
                                                <option value="">-- @lang('dashboard.dashboard_title.select_group') --</option>
                                                @foreach ($groups as $group)
                                                <option value="{{$group->id}}" {{( isset($user['group_id']) and $group->id == $user['group_id'])?" selected=''" : ""}}>{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!--User Name-->
                                    <div class="form-group has-error-name">
                                        <label class="col-md-3 control-label">User Name <span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-4">
                                            <input type="text" name="name" value="{{ isset($user['name']) ? $user['name'] : old('name')}}" placeholder="User Name" class="form-control" required="">
                                        </div>
                                    </div>

                                    <!--User Name-->
                                    <div class="form-group has-error-name_bangla">
                                        <label class="col-md-3 control-label">ব্যবহারকারীর নাম<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-4">
                                            <input type="text" name="name_bangla" value="{{ isset($user['name_bangla']) ? $user['name_bangla'] : old('name_bangla')}}" placeholder="ইউজারের নাম বাংলায়" class="form-control" required="">
                                        </div>
                                    </div>

                                    @if($user['id'] == "")
                                    <!--User Email-->
                                    <div class="form-group has-error-email">
                                        <label class="col-md-3 control-label"> Email <span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-4">
                                            <input type="email" name="email" placeholder="Email" class="form-control" value="{{ isset($user['email']) ? $user['email'] : old('email')}}">
                                        </div>
                                    </div>

                                    <!--User Mobile-->
                                    <div class="form-group has-error-mobile">
                                        <label class="col-md-3 control-label"> Mobile <span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-4">
                                            <input type="text" name="mobile" placeholder="Mobile" class="form-control" value="{{ isset($user['mobile']) ? $user['mobile'] : old('mobile')}}" maxlength="11">
                                        </div>
                                    </div>

                                    <!--User password-->
                                    <div class="form-group has-error-password">
                                        <label class="col-md-3 control-label"> Password <span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-4">
                                            <input type="password" name="password" placeholder="Password" class="form-control" value="">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <div class="col-md-4 col-md-offset-3">
                                            <button type="submit" class="btn green">{{ ($user['id'] != "") ? __('dashboard.dashboard_title.update') : __('dashboard.dashboard_title.create') }}</button>
                                            <a href="{{ route('users') }}" class="btn btn-default"> @lang('dashboard.dashboard_title.cancel')</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- END PAGE BASE CONTENT -->
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('/js/form.js') }}" type="text/javascript"></script>
@endsection
