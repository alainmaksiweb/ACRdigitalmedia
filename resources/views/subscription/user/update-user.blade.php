<?php
$action_type = $xdata->user_type == 'Manager' ? 'team' : 'user';
$title_display = $action_type=='team' ? __('Update Team') : __('Update User');
$title_display_des = $action_type=='team' ? __('Update an existing team member') : __('Update an existing user');
?>
@extends('layouts.auth')
@section('title',$title_display)
@section('page-header-title',$title_display)
@section('page-header-details',__('Update existing user'))
@section('content')
<div class="content-wrapper">
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-lg-7 col-12">
                <div class="card card-rounded mb-4 p-lg-2">
                    <div class="card-body card-rounded">
                        <h4 class="card-title card-title-dash mb-4">{{__('Define User')}}</h4>
                        <form class="form form-vertical" enctype="multipart/form-data" method="POST" action="{{ route('update-user-action') }}">
                            @csrf
                            <input type="hidden" name="action_type" id="action_type" value="{{$action_type}}">
                            <input type="hidden" name="id" value="{{$xdata->id}}">
                            <input type="hidden" name="xemail" value="{{$xdata->email}}">
                            <div class="form-body">

                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="name"> {{ __("Full Name") }} *</label>
                                            <input name="name"  class="form-control form-control-lg" type="text" value="{{old('name',$xdata->name)}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger"> {{ $errors->first('name') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="name"> {{ __("Email") }} *</label>
                                            <input name="email"  class="form-control form-control-lg" type="email" value="{{old('email',$xdata->email)}}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger"> {{ $errors->first('email') }} </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="name"> {{ __("Mobile") }}</label>
                                            <input name="mobile"  class="form-control form-control-lg" type="text" value="{{old('mobile',$xdata->mobile)}}">
                                            @if ($errors->has('mobile'))
                                                <span class="text-danger"> {{ $errors->first('mobile') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name"> {{ __("Password") }}</label>
                                            <input name="password"  class="form-control form-control-lg" type="password">
                                            @if ($errors->has('password'))
                                                <span class="text-danger"> {{ $errors->first('password') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name"> {{ __("Confirm Password") }}</label>
                                            <input name="password_confirmation"  class="form-control form-control-lg" type="password">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger"> {{ $errors->first('password_confirmation') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>{{ __('Address') }}</label>
                                            <textarea id="address"  class="form-control form-control-lg" name="address">{{old('address',$xdata->address)}}</textarea>
                                            @if ($errors->has('address'))
                                                <span class="text-danger">
                                                    {{ $errors->first('address') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 d-none">
                                        <div class="form-group">
                                            <label>{{ __('User Type') }}*</label>
                                            <input type="text" class="form-control form-control-lg" name="user_type" id="user_type" value="{{$xdata->user_type}}">
                                            @if ($errors->has('user_type'))
                                                <span class="text-danger">
                                                {{ $errors->first('user_type') }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ $action_type=='team' ? __('Team Role') :  __('Subscription Package') }}*</label>
                                            <select name="package_id" class="form-control form-control-lg select2">
                                                <option value="">{{__('Select')}}</option>
                                                @foreach($packages as $value)
                                                    <?php $selected = $value->id == old('package_id',$xdata->package_id) ? 'selected' : '';?>
                                                    <option {{$selected}} value="{{$value->id}}">{{$value->package_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('package_id'))
                                                <span class="text-danger">
                                                    {{ $errors->first('package_id') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($action_type!='team')
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ __('Expiry date') }}*</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                                <input type="text" name="expired_date" class="form-control form-control-lg datepicker" value="{{old('expired_date',date("Y/m/d",strtotime($xdata->expired_date)))}}">
                                            </div>
                                            @if ($errors->has('expired_date'))
                                                <span class="text-danger">
                                                    {{ $errors->first('expired_date') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-3 mt-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" id="status" name="status" type="checkbox" value="1" <?php echo (old('status',$xdata->status)=='0') ? '' : 'checked'; ?>>
                                            <label class="form-check-label" for="status">{{__("Status")}}</label>
                                        </div>
                                        @if ($errors->has('status'))
                                            <span class="text-danger"> {{ $errors->first('status') }} </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="form-footer mt-4">
                                <button type="submit" class="btn btn-primary me-1"><i class="fas fa-edit"></i> {{__('Update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection