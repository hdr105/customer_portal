@extends('layouts.full')
@section('content')
<style>
   #signal-strength {
  height: 25px;
  list-style: none;
  overflow: hidden;
}
#signal-strength li {
  display: inline-block;
  width: 5px;
  float: left;
  height: 100%;
  margin-right: 1px;
  border-bottom: 2px solid blue;
  border-spacing: 2px !important;
}
#signal-strength li.pretty-strong {
  padding-top: 0px;
}
#signal-strength li.strong {
  padding-top: 5px;
}
#signal-strength li.weak {
  padding-top: 10px;
}
#signal-strength li.very-weak {
  padding-top: 15px;
}

#signal-strength li.weak-weak {
  padding-top: 18px;
}
#signal-strength li div {
  height: 100%;
  background: blue;
}


</style>
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
   <div class="col-6">
      <?php //echo "<pre>"; print_r($devices) ?>
   <div class="card mt-4">
      <div class="card-header">
         <h4 class="card-title text-muted mt-3">
            {{utrans("headers.devices")}} Detail
         </h4>
      </div>

      <div class="table-responsive">
         <table class="table card-table">
            <thead>
               
            </thead>
           
            <tbody>
               <tr>
                  <th scope="row">{{utrans("devices.name")}}</th>
                  <td>@if(isset($devices->name)) {{ $devices->name }}  @endif</td>
               </tr>
                <tr>
                  <th scope="row">{{utrans("devices.status")}}</th>
                  <td style="text-transform: uppercase;"> 

                        @php (@$is_uptime_online = 'false') 

                        @if(isset($devices->status))
                        @if($devices->status == 'offline') @php (@$is_uptime_online = 'true')  <img src="/assets/offline.png" width="20"> @else <img src="/assets/online.png" width="20"> @endif
                           {{ $devices->status }}
                        @endif
                  </td>
               </tr>
                <tr>
                  <th scope="row">{{utrans("devices.serial")}} Number</th>
                  <td>@if(isset($devices->sn)) {{ $devices->sn }}  @endif</td>
               </tr>
                <tr>
                  <th scope="row">Model</th>
                  <td>@if(isset($devices->model)) {{ $devices->model }}  @endif</td>
               </tr>
                <tr>
                  <th scope="row">Remote Access</th>
                  <td>@if(isset($devices->ddns_name)) {{ $devices->ddns_name }}.mypep.link  @endif</td>
               </tr>
                <tr>
                  <th scope="row">Uptime</th>
                  <td>
                        @if(isset($devices->uptime) && $is_uptime_online = 'true')   
                           @php (@$ss = $devices->uptime)
                           @php (@$m = floor(($ss % 3600)/60))
                           @php ($h = floor(($ss % 86400)/3600))
                           @php ($d = floor(($ss % 2592000)/86400))

                           @if($d != 0) {{  $d.' Days,'}} @endif 
                           @if($h != 0) {{  $h.' Hours,'}} @endif 
                           @if($m != 0) {{  $m.' Minutes'}} @endif 

                        @endif
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
  </div>

  <div class="card mt-4">
      <div class="card-header">
         <h4 class="card-title text-muted mt-3">
            Interface Status
         </h4>
      </div>

      <div class="table-responsive">
         <table class="table card-table">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>{{utrans("devices.status")}}</th>
                  <th>IP</th>
                  <th>Signal</th> 
                  <th>Signal Strength</th> 
                  <th>Signal Quality</th> 
                  <th>Monthly | Usage</th> 
 
               </tr>
            </thead>
           
            <tbody>
               @foreach($devices->interfaces as $contract)
                @if(strpos( $contract->name, '(p)' ) !== false)
               <tr>    
                  <TD>@if(isset($contract->name))
                    @php (@$name = str_replace("(p)","",$contract->name))    
                   {{ $name }}  

                  @endif</TD>
                  <TD style="text-transform: uppercase;">
                     <!-- && $contract->status != 'Disabled (Activation Required)' -->
                     @if(isset($contract->status))

                        @php (@$is_online = 'false')

                        

                        @if(isset($contract->is_overall_up)) 

                              @if($contract->is_overall_up == '1')  
                                    @php (@$is_online = 'true')  
                                    <img src="/assets/online.png" width="20"> 
                              @else 
                                    <img src="/assets/offline.png" width="20"> 
                              @endif

                        @else 
                            <img src="/assets/offline.png" width="20"> 
                        @endif
                           {{ $contract->status }}
                     @endif
                  </TD>
                  <TD>@if(isset($contract->ip)  && $is_online == 'true') {{ $contract->ip }}  @endif</TD>
                  <TD>@if(isset($contract->signal_bar) && $is_online == 'true') 

                      <ul id="signal-strength">
                         @if($contract->signal_bar == '0')  
                          <li class="weak-weak"></li>  
                          <li class="very-weak"></li>
                          <li class="weak"></li>
                          <li class="strong"></li>
                          <li class="pretty-strong"></li>
                         @endif 
                       @if($contract->signal_bar == '1')  
                          <li class="weak-weak"><div id="weak-weak"></div></li>  
                          <li class="very-weak"></li>
                          <li class="weak"></li>
                          <li class="strong"></li>
                          <li class="pretty-strong"></li>
                         @endif 
                        @if($contract->signal_bar == '2')  
                            <li class="weak-weak"><div id="weak-weak"></div></li>  
                            <li class="very-weak"><div id="very-weak"></div></li>
                            <li class="weak"></li>
                            <li class="strong"></li>
                            <li class="pretty-strong"></li>
                        @endif 
                        @if($contract->signal_bar == '3')  
                            <li class="weak-weak"><div id="weak-weak"></div></li>  
                            <li class="very-weak"><div id="very-weak"></div></li>
                            <li class="weak"><div id="weak"></div></li>
                            <li class="strong"></li>
                            <li class="pretty-strong"></li>
                        @endif 
                        @if($contract->signal_bar == '4')  
                               <li class="weak-weak"><div id="weak-weak"></div></li>  
                               <li class="very-weak"><div id="very-weak"></div></li>
                               <li class="weak"><div id="weak"></div></li>
                               <li class="strong"><div id="strong"></div></li>
                               <li class="pretty-strong"></li>
                        @endif 
                        @if($contract->signal_bar == '5')  
                               <li class="weak-weak"><div id="weak-weak"></div></li>  
                               <li class="very-weak"><div id="very-weak"></div></li>
                               <li class="weak"><div id="weak"></div></li>
                               <li class="strong"><div id="strong"></div></li>
                               <li class="pretty-strong"><div id="pretty-strong"></div></li>
                        @endif 
                     </ul>
                  @endif
                  </TD>
                  <TD>@if(isset($contract->signal) && $is_online == 'true' ) {{ $contract->signal }} dBm  @endif</TD>
                  <TD>@if(isset($contract->signal_quality) && $is_online == 'true') {{ $contract->signal_quality }} dB @endif</TD>
                  <TD></TD>
               </tr>
                @endif
               @endforeach
            </tbody>
         </table>
      </div>
   </div>


</div>
@endsection
