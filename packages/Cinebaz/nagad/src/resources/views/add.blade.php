@extends('layouts.app')

@section('content')

    <!-- Main content -->
    @if(Session::has('myexcep'))
        @dump(Session::get('myexcep'));
    @endif
    
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">


                    {{ Form::open(['method' => 'POST', 'route' => 'admin.page.store']) }}
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card card-primary">
                                <div class="card-header">
                                    Page Information
                                </div>
                                <!-- @dump($fdata) -->
                                <!-- /.card-header -->
                                <!-- form start -->

                                {{ Form::hidden('id', !empty($fdata->id) ? $fdata->id : null) }}

                                <div class="card-body">


                                    <div class="form-group">
                                        {{ Form::label('title_en', 'Title EN') }}
                                        {{ Form::text('title_en', !empty($fdata->title_en) ? $fdata->title_en : null, ['id' => 'title_en', 'class' => $errors->has('title_en') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Title EN']) }}
                                        @error('title_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('sub_title_en', 'Sub Title EN') }}
                                        {{ Form::text('sub_title_en', !empty($fdata->sub_title_en) ? $fdata->sub_title_en : null, ['class' => $errors->has('sub_title_en') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Sub Title EN']) }}
                                        @error('sub_title_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('slug', 'Slug') }}
                                        {{ Form::text('slug', !empty($fdata->slug) ? $fdata->slug : null, ['id' => 'slug', 'class' => $errors->has('slug') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Slug']) }}
                                        @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('description_en', 'Description EN') }}
                                        {{ Form::textarea('description_en', !empty($fdata->description_en) ? $fdata->description_en : null, ['rows' => 3, 'placeholder' => 'Description EN..', 'class' => 'htmltexteditor form-control ' . ($errors->has('description_en') ? ' is-invalid' : '')]) }}
                                        @error('description_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('remarks', 'Remarks') }}
                                        {{ Form::text('remarks', !empty($fdata->remarks) ? $fdata->remarks : null, ['class' => $errors->has('remarks') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Remarks']) }}
                                        @error('remarks')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            {{ Form::checkbox('is_active', 'Yes', false, ['class' => 'custom-control-input', 'id' => 'is_active', 'checked' => !empty($fdata->is_active) && $fdata->is_active == 'Yes' ? true : false]) }}
                                            <label class="custom-control-label" for="is_active"> Is Active ?</label>
                                        </div>


                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3">
                            @include('seo::wedget', ['sdata' => ($fdata && $fdata->seo)?$fdata->seo:null])
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
            $(document).on("change", '#title_en', function(e) {
                let slug = $(this).val();
                let route = "{{ route('getslug') }}";
                let table = 'pages';
                let column = 'slug';
                let id = "{{ !empty($fdata->id) ? $fdata->id : null }}";

                $.ajax({
                    type: 'GET',
                    url: route,
                    data: {
                        slug: slug,
                        id: id,
                        table: table,
                        column: column
                    },
                    success: function(data) {

                        $('#slug').val(data.slug);
                    }
                });


            });
        });

    </script>


@endpush
