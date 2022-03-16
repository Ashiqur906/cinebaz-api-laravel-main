@extends('layouts.app')

@section('content')


    <!-- Main content -->

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    
                    @if(Session::has('myexcep'))
                    @dump(Session::get('myexcep'))
                    @endif


                    {{ Form::open(['method' => 'POST', 'route' => 'admin.notification.store']) }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    Notification Information
                                </div>
                                <!-- @dump($fdata) -->
                                <!-- /.card-header -->
                                <!-- form start -->

                                {{ Form::hidden('id', !empty($fdata->id) ? $fdata->id : null) }}

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                {{ Form::label('user', 'User') }}
                                                {{ Form::select('member[]', getMemberArr(), null, ['class' => $errors->has('member') ? 'form-control myselect2  is-invalid' : 'form-control myselect2', 'multiple' => 'multiple']) }}
                                                @error('member')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @error('user')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: -50px;">    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('lbl_subject', 'Subject') }}
                                                {{ Form::text('subject', null, ['id' => 'subject', 'class' => $errors->has('subject') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Subject ']) }}
                                                @error('subject')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('lbl_link', 'Link') }}
                                                {{ Form::url('link', null, ['id' => 'link', 'class' => $errors->has('subject') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Link ']) }}
                                                @error('link')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                {{ Form::label('message', 'Message') }}
                                                {{ Form::textarea('message', null, ['id' => 'message', 'class' => $errors->has('message') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Message ']) }}
                                                @error('title_en')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <!-- /.row -->

                </div>
            </div>
            <br>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.myselect2').select2();
        });

    </script>
@endpush
