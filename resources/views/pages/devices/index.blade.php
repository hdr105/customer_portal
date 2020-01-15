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
                  <th>{{utrans("devices.action")}}</th>  
               </tr>
            </thead>
            <tbody>
               @if(count($devices) == 0)
               <TR>
                  <TD colspan="3">{{utrans("devices.noDevices")}}</TD>
               </TR>
               @endif
              <!--  @foreach($devices as $device)
               <tr @if($contract->getAcceptanceDatetime() == null) class="warning" @else class="success" @endif>
               <TD>{{$contract->getContractName()}}</TD>
               <TD>@if($contract->getAcceptanceDatetime() == null) {{utrans("devices.pendingSignature")}} @else {{utrans("devices.signed")}} @endif</TD>
               <TD>@if($contract->getAcceptanceDatetime() == null) <a href="{{$contract->generateSignatureLink()}}" target="_blank"><button class="btn btn-primary btn-sm"><i class="fe fe-pencil mr-2"></i>{{utrans("devices.sign")}}</button></a> @else <a href="{{action("ContractController@downloadContractPdf",['id' => $contract->getId()])}}"><button class="btn btn-sm btn-light"><i class="fe fe-file mr-2"></i>{{utrans("devices.download")}}</button></a> @endif</TD>
               </tr>
               @endforeach -->
             
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection