
@extends('layouts.master')

@section('title', 'Profile')

@section('style')
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css">
<link href="/css/profile.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
@endsection

@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1> @lang('dashboard.user_profile.profile') | @lang('dashboard.user_profile.account') </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->


        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet bordered">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="{{ (isset($profile->picture) && file_exists('storage/images/' . $profile->picture)) ? (asset('storage/images/' . $profile->picture)) : ('/img/avatar.jpg') }}" class="img-responsive" alt="">
                        </div>

                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                {{ $profile->name }}
                            </div>
                            <div class="profile-usertitle-job">

                                {{ isset($profile->group) ? $profile->group->name : "" }}
                            </div>
                            <div class="profile-usertitle-job">

                                {{ isset($profile->office) ? $profile->office->name : "" }}
                            </div>
                            <div class="profile-usertitle-job">

                                {{ isset($profile->district) ? $profile->district->name : "" }}
                            </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                    </div>
                    <!-- END PORTLET MAIN -->

                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">@lang('dashboard.user_profile.profile_account')</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_profile" data-toggle="tab"> @lang('dashboard.user_profile.personal_info_tab')</a>
                                        </li>
                                        <li>
                                            <a href="#tab_avatar" data-toggle="tab"> @lang('dashboard.user_profile.change_pic_tab')</a>
                                        </li>
                                        <li>
                                            <a href="#tab_signature" data-toggle="tab"> @lang('dashboard.user_profile.change_sign_tab')</a>
                                        </li>
                                        <li>
                                            <a href="#tab_password" data-toggle="tab"> @lang('dashboard.user_profile.change_pass_tab')</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_profile">
                                            <form class="ajax-form" role="form">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="action" value="{{ route('profile_update') }}">
                                                <input type="hidden" name="method" value="POST">
                                                <div class="form-group has-error-name">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" name="name" placeholder="Your Name" class="form-control" value="{{ $profile->name }}" />
                                                </div>
                                                <div class="form-group has-error-name_bangla">
                                                    <label class="control-label">@lang('dashboard.dashboard_title.name')</label>
                                                    <input type="text" name="name_bangla" placeholder="Your Name In Bangla" class="form-control" value="{{ $profile->name_bangla }}" />
                                                </div>
                                                <div class="form-group has-error-email">
                                                    <label class="control-label">@lang('dashboard.dashboard_title.email')</label>
                                                    <input type="email" name="email" placeholder="Your Email" class="form-control" value="{{ $profile->email }}"/>
                                                </div>
                                                <div class="form-group has-error-mobile">
                                                    <label class="control-label">@lang('dashboard.dashboard_title.mobile')</label>
                                                    <input type="text" name="mobile" placeholder="Your Mobile" class="form-control" value="{{ $profile->mobile }}" maxlength="11"/>
                                                </div>
                                                <div class="margiv-top-10">
                                                    <button type="submit" class="btn green"> @lang('dashboard.user_profile.save_changes') </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PERSONAL INFO TAB -->
                                        <!-- CHANGE AVATAR TAB -->
                                        <div class="tab-pane" id="tab_avatar">
                                            <p> @lang('dashboard.user_profile.picture_cons') </p>
                                            <form class="ajax-form" role="form"  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="action" value="{{ route('picture_update') }}">
                                                <input type="hidden" name="method" value="POST">
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="min-width: 80px; min-height: 80px;">
                                                            <img src="{{ file_exists('storage/images/' . $profile->picture) ? asset('storage/images/' . $profile->picture) : '/img/avatar.png'}}" alt="" />
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"> </div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> @lang('dashboard.user_profile.select_pic') </span>
                                                                <span class="fileinput-exists"> @lang('dashboard.user_profile.change_pic') </span>
                                                                <input type="file" name="picture" required>
                                                            </span>
                                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> @lang('dashboard.user_profile.remove_pic') </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="margin-top-10">
                                                    <button type="submit" class="btn green "> @lang('dashboard.user_profile.save_pic') </button>

                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE AVATAR TAB -->
                                        <!-- CHANGE Signature TAB -->
                                        <div class="tab-pane" id="tab_signature">
                                            <p> @lang('dashboard.user_profile.signature_cons')   </p>
                                            <form class="ajax-form" role="form"  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="action" value="{{ route('signature_update') }}">
                                                <input type="hidden" name="method" value="POST">
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="min-width: 200px; min-height: 80px;">
                                                            <?php // dd($profile->signature ,file_exists('storage/signatures/' . $profile->signature)); ?>
                                                            <img src="{{ file_exists('storage/signatures/' . $profile->signature) ? asset('storage/signatures/' . $profile->signature) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+signature'}}" alt="" />
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 80px;"> </div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> @lang('dashboard.user_profile.select_sign')  </span>
                                                                <span class="fileinput-exists"> @lang('dashboard.user_profile.change_sign')  </span>
                                                                <input type="file" name="signature" required>
                                                            </span>
                                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> @lang('dashboard.user_profile.remove_sign')  </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="margin-top-10">
                                                    <button type="submit" class="btn green" > @lang('dashboard.user_profile.save_sign')  </button>

                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE AVATAR TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_password">
                                            <form class="ajax-form" role="form">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="action" value="{{ route('password_update') }}">
                                                <input type="hidden" name="method" value="POST">

                                                <div class="form-group has-error-current_password">
                                                    <label class="control-label">@lang('dashboard.user_profile.current_pass') </label>
                                                    <input type="password" name="current_password" class="form-control" />
                                                </div>
                                                <div class="form-group has-error-new_password">
                                                    <label class="control-label">@lang('dashboard.user_profile.new_pass') </label>
                                                    <input type="password" name="new_password" class="form-control" />
                                                </div>
                                                <div class="form-group has-error-confirm_password">
                                                    <label class="control-label">@lang('dashboard.user_profile.re_new_pass') </label>
                                                    <input type="password" name="confirm_password" class="form-control" />
                                                </div>
                                                <div class="margin-top-10">
                                                    <button type="submit" class="btn green"> @lang('dashboard.user_profile.change_pass')  </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
@endsection
@section('script')
<script src="/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="{{ asset('/js/form.js') }}" type="text/javascript"></script>
@endsection
