@extends('layouts.master')

@section('title', 'Group Permission')

@section('onpagecss')
@endsection

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>@lang('dashboard.dashboard_title.group')
                    <small>@lang('dashboard.dashboard_title.permission')</small>
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
                <a href="{{ route('groups') }}">@lang('dashboard.dashboard_title.groups')</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">@lang('dashboard.dashboard_title.permission')</span>
            </li>
        </ul>

        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-people font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">@lang('dashboard.dashboard_title.permission')</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="ajax-form" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="{{route('group_permission_update')}}">
                    <input type="hidden" name="method" value="POST">
                    <input type="hidden" name="group_id" value="{{ $group->id }}">

                    <div class="form-actions">
                        <div class="row">
                            <div class="text-center">
                                <button type="submit" class="btn green">@lang('dashboard.dashboard_title.submit')</button>
                                <a href="{{ route('groups')}}" class="btn default">@lang('dashboard.dashboard_title.cancel')</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-8">
                                <h2 class="title">{{ ucfirst($group->name)}}'s Permissions</h2>
                                <div class="table-scrollable">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-green bg-font-green">
                                                <th class="text-right">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" class="select-toggle">
                                                        <span></span>
                                                    </label>
                                                </th>
                                                <th>@lang('dashboard.dashboard_title.permission_name')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $permission = json_decode($group->permissions, true); ?>
                                            @foreach($pItems as $item)
                                            <tr class="bg-grey-steel bg-font-grey-steel">
                                                <th colspan="2" class="text-center">
                                                    @lang('permissions.ItemName.'.$item['lang_tag'])
                                                </th>
                                            </tr>
                                            @if(isset($item['items']))
                                            @foreach($item['items'] as $subitem)
                                            <?php
                                            $checked = false;
                                            if(isset($permission[$item['tag']])) {
                                                $checked = in_array($subitem['tag'], $permission[$item['tag']]);
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-right">
                                                    <label class="mt-checkbox mt-checkbox-outline">
                                                        <input type="checkbox" name="permissions[{{ $item['tag'] }}][]" value="{{ $subitem['tag'] }}" {{ ($checked) ? 'checked="checked"' : '' }} >
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <!-- {{ ucfirst($subitem['lang_tag']) }} -->
                                                    @lang('permissions.ItemData.'.$subitem['lang_tag'])
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="text-center">
                                <button type="submit" class="btn green">@lang('dashboard.dashboard_title.submit')</button>
                                <a href="{{ route('groups')}}" class="btn default">@lang('dashboard.dashboard_title.cancel')</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
</div>
@endsection

@section('script')
<script src="{{ asset('/js/form.js') }}" type="text/javascript"></script>
@endsection
