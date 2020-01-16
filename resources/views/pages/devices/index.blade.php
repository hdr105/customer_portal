@extends('layouts.full')
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-12">
   <!-- Header -->
   <div class="header mt-md-5">
      <div class="header-body">
         <div class="row align-items-center">
            <div class="col">
               <!-- Pretitle -->
               <h6 class="header-pretitle">
               {{utrans("headers.summary")}}
               </h6>
               <!-- Title -->
               <h1 class="header-title">
               {{utrans("headers.devices")}}
               </h1>
            </div>
            <div class="col-auto">
            </div>
         </div>
         <!-- / .row -->
      </div>
   </div>
   <div class="card mt-4">
      <div class="card-header">
         <h4 class="card-title text-muted mt-3">
            {{utrans("headers.devices")}}
         </h4>
      </div>

      <div class="table-responsive">
         <table class="table card-table">
            <thead>
               <tr>
                  <th>{{utrans("devices.name")}}</th>
                  <th>{{utrans("devices.status")}}</th>
 		            <th>{{utrans("devices.serial")}}</th>
		            <th>{{utrans("devices.uptime1")}}</th> 
                  <th>{{utrans("devices.address")}}</th> 
 
               </tr>
            </thead>
           
            <tbody>
               @if(count($devices) == 0)
                  <TR>
                     <TD colspan="3">{{utrans("devices.noDevices")}}</TD>
                  </TR>
               @endif
               <?php //echo "<pre>"; print_r($devices) ?>
               @foreach($devices as $contract)
               <tr >
                     <TD>{{ $contract->name }}</TD>
                     <TD style="text-transform: uppercase;">@if($contract->status == 'offline') <img src="/assets/offline.png" width="20"> @else <img src="/assets/online.png" width="20"> @endif
                        {{ $contract->status }}</TD>
                     <TD>{{ $contract->sn }}</TD>
                     <TD>@if(isset($contract->uptime)) {{ floor(($contract->uptime / 60) % 60) }} {{utrans("devices.minutes")}} @endif</TD>
                     <TD>{{ $contract->address }}</TD>
               </tr>
               @endforeach
             
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection
