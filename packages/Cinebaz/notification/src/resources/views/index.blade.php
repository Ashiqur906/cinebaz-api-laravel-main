@extends('layouts.app')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-12">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Notification Lists</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <a href="{{ route('admin.notification.add') }}" class="btn btn-primary">Send Notification</a>
                   </div>
                </div>
                <div class="iq-card-body">
                   <div class="table-view">
                      <table class="data-tables table movie_table " style="width:100%">
                         <thead>
                            <tr>
                               <th style="width:10%;">No</th>
                               <th style="width:20%;">NotifyTO</th>
                               <th style="width:20%;">Title</th>
                               <th style="width:20%;">Link</th>
                               <th style="width:20%;">Message</th>
                               <th style="width:20%;"> Status </th>
                              
                               <!-- <th style="width:20%;">Action</th> -->
                            </tr>
                         </thead>
                         <tbody>
                           @foreach($getNotifications as $notify)
                           @php 
                              $js_title = json_decode($notify->data,true);
                           @endphp
                           
                           <tr>
                               <th style="width:10%;">{{$loop->index+1}}</th>
                               <th style="width:20%;">{{$notify->GetMember->name}}</th>
                               <th style="width:20%;">{{isset( $js_title['title'])? $js_title['title']: null}}</th>
                               <th style="width:20%;">{{isset( $js_title['link'])? $js_title['link']: null}}</th>
                               <th style="width:20%;">{{isset( $js_title['data'])? $js_title['data']: null}}</th>
                               @if($notify->read_at)
                               <th style="width:20%;color:green"><i class="fa fa-envelope-open"></i> Viewed </th>
                               @else
                               <th style="width:20%;color:red"><i class="fa fa-envelope"></i> Pending </th>
                               @endif
                               <!-- <th style="width:20%;">Action</th> -->
                            </tr>
                           @endforeach
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
</div>
 

@endsection
