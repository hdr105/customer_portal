<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark bg-dark" id="sidebar">
   <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="{{action("BillingController@index")}}">
      <img src="/assets/img/logo.png" class="navbar-brand-img mx-auto" alt="Back to dashboard..." style="max-height: 3.8rem !important;">
      </a>
      <div class="navbar-user d-md-none">
         <div class="dropdown">
            <a href="#!" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <div class="avatar avatar-sm avatar-online">
                  <img src="/assets/img/alec.png" class="avatar-img rounded-circle" alt="...">
               </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarIcon">
               <a href="/portal/profile" class="dropdown-item">Settings</a>
               <hr class="dropdown-divider">
               <a href="/logout" class="dropdown-item">Logout</a>
            </div>
         </div>
      </div>
      <div class="collapse navbar-collapse " id="sidebarCollapse">
         <!-- Customer Portal Sidebar-->
         <!-- Heading -->
         <h6 class="navbar-heading text-muted mt-4">
            My Service
         </h6>
         <ul class="navbar-nav">
            <li class="nav-item">
               <a @if(str_contains(Route::getCurrentRoute()->uri(),"billing")) class="nav-link selected" @else class="nav-link" @endif href="{{action("BillingController@index")}}">
               <i class="fe fe-dollar-sign"></i> {{utrans("nav.billing")}}</a>
            </li>
            @if(Config::get("customer_portal.ticketing_enabled") === true)
            <li class="nav-item">
               <a @if(str_contains(Route::getCurrentRoute()->uri(),"tickets")) class="nav-link selected" @else class="nav-link" @endif href="{{action("TicketController@index")}}">
               <i class="fe fe-message-circle"></i> {{utrans("nav.tickets")}}</a>
            </li>
            @endif
            @if(Config::get("customer_portal.data_usage_enabled") === true)
            <li class="nav-item">
               <a @if(str_contains(Route::getCurrentRoute()->uri(),"data_usage")) class="nav-link selected" @else class="nav-link" @endif href="{{action("DataUsageController@index")}}">
               <i class="fe fe-activity"></i> {{utrans("nav.dataUsage")}}</a>
            </li>
            @endif
            @if(Config::get("customer_portal.contracts_enabled") === true)
            <li class="nav-item">
               <a @if(str_contains(Route::getCurrentRoute()->uri(),"contracts")) class="nav-link selected" @else class="nav-link" @endif href="{{action("ContractController@index")}}">
               <i class="fe fe-package"></i> {{utrans("nav.contracts")}}</a>
            </li>
            @endif
            @if(Config::get("customer_portal.devices_enabled") === true)
            <li class="nav-item ">
                     <a  @if(str_contains(Route::getCurrentRoute()->uri(),"devices")) class="nav-link selected" @else class="nav-link" @endif href="{{action("DeviceController@index")}}">
                        <i class="fe fe-package"></i> {{utrans("nav.devices")}}
                     </a>
            </li>
            
            <li class="nav-item ">
               <a href="/portal/devices/report/0/0" @if(str_contains(Route::getCurrentRoute()->uri(),"devices/report/0/0")) class="nav-link selected" @else class="nav-link" @endif href="{{action("DeviceController@index")}}">
                          <i class="fe fe-printer "></i> 
               Usage Reports</a>
            </li>
             <!--  <li class="nav-item ">
                     <a style="display: inline"  @if(str_contains(Route::getCurrentRoute()->uri(),"devices")) class="nav-link selected" @else class="nav-link" @endif href="{{action("DeviceController@index")}}">
                        <i class="fe fe-package"></i> {{utrans("nav.devices")}}
                        <a class="collapsed" onclick="change_plus_mins()" data-toggle="collapse" data-target="#collapseTwo" >
                           <i style="color:white; padding-left: 75px;" id="iconof" class="fa fa-plus"></i></a>
                     </a>

                     <div style="margin-left: 16px;"  id="collapseTwo" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                       
                              <a href="/portal/devices/report/0/0" @if(str_contains(Route::getCurrentRoute()->uri(),"devices/report/0/0")) class="nav-link selected" @else class="nav-link" @endif href="{{action("DeviceController@index")}}">
                                  <i class="fe fe-printer "></i> 
                              Reports</a>
                       
                     </div>

                    
               </li> -->
             

                           
             @endif
         </ul>
         <h6 class="navbar-heading text-muted mt-4">
            My Account
         </h6>
         <ul class="navbar-nav">
            <li class="nav-item">
               <a @if(str_contains(Route::getCurrentRoute()->uri(),"profile")) class="nav-link selected" @else class="nav-link" @endif href="{{action("ProfileController@show")}}">
               <i class="fe fe-users"></i> {{utrans("nav.profile")}}</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="/logout">
               <i class="fe fe-log-out"></i> Logout</a>
            </li>
@if(str_contains(Route::getCurrentRoute()->uri(),"settings"))
            <li class="nav-item">
               <a class="nav-link selected" href="{{action("AppConfigController@show")}}">
               <i class="fe fe-codepen"></i> App Configuration</a>
            </li>
@endif

         </ul>
         <div class="navbar-user mt-auto d-none d-md-flex">
            <div class="dropup">
               <a href="#!" id="sidebarIconCopy" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="avatar avatar-sm avatar-online">
                     <img src="/assets/img/alec.png" class="avatar-img rounded-circle" alt="...">
                  </div>
               </a>
               <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">
                  <a href="/portal/profile" class="dropdown-item">Settings</a>
                  <hr class="dropdown-divider">
                  <a href="/logout" class="dropdown-item">Logout</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</nav>
