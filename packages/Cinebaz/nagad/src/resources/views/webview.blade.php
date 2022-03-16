@extends('frontend.layouts.master')

@section('content')
<section class="container-fluid">
    <div class="container">
        <div class="row mainbody">
            <div class="col-md-9">

                @if($mdata)


                <div class="page-header">
                    <div class="page-header-inner">
                        @if($mdata->title)
                        <h2>{{$mdata->title}}</h2>
                        @endif
                        @if($mdata->sub_title)
                        <h3>{{$mdata->sub_title}}</h3>
                        @endif
                    </div>
                </div>
                <div class="page-content">
                    {!! $mdata->description !!}
                </div>
                @else
                <div class="page-not-found">
                    <h2>404</h2>
                    <h3>OPPS! PAGE NOT FOUND</h3>
                    <p>Sorry, the page you're looking for doesn't exist. If you think something is broken, report a
                        problem.</p>
                    <a href="{{url('/')}}" class="btn btn-primary">RETURN HOME</a>
                </div>
                @endif




            </div>
            <div class="col-md-3">
                @include('frontend.layouts.essential.side_bar')


            </div>

        </div>




    </div>
</section>
<!-- ./wrapper -->
@endsection

@push('scripts')




@endpush