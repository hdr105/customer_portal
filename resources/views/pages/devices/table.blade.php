


<table class="table card-table">
                     <thead>
                        <tr>
                           <th id="time_val">Hourly</th>
                           <th>Download</th>
                           <th>Upload</th>
                           <th>Total</th> 
                        </tr>
                     </thead>
                    
                     <tbody>
                       
                         @foreach($devices->data->usages as $key => $contract)
                           <tr>    
                              <TD>@php ($datetime = explode("T",$contract->from_date))
                                 @if($devices->data->type == 'hourly')
                                  {{ $datetime[0] }} {{ $datetime[1] }}
                                 @elseif($devices->data->type == 'daily')  
                                 {{ $datetime[0] }}
                                 @elseif($devices->data->type == 'monthly')

                                  @php ($dateonly = explode("-",$datetime[0]))
                                  {{ $dateonly[0] }}-{{ $dateonly[1] }}

                                 @endif
                              </TD>
                              <TD>{{ number_format($contract->down, 2) }} MB</TD>
                              <TD>{{ number_format($contract->up, 2) }} MB</TD>
                              <TD>
                                 @php ($totalmb = ($contract->down + $contract->up) )
                                 {{ number_format($totalmb, 2) }} MB
                                 
                              </TD>
                           </tr>
                         @endforeach
                       
                     </tbody>
</table>
<?php
   if($devices->data->type == 'hourly'){
      $valueoftime = "HH:mm";
      $intervaltype = "hour";
      $interval = '0';
   }elseif($devices->data->type == 'daily'){
       $valueoftime = "DD MMM";
       $intervaltype = "day";
       $interval = '';
   }elseif($devices->data->type == 'monthly'){
      $valueoftime = "MMM YYYY";
      $intervaltype = "month";
      $interval = '1';
   }

 ?>

<script>


      var nameofcolum = "";
      if($('input[name="filter_radio"]:checked').val() == 'hourly'){ 
         nameofcolum = "Hourly";
      }
      if($('input[name="filter_radio"]:checked').val() == 'daily'){
         nameofcolum = "Daily";
      }
      if($('input[name="filter_radio"]:checked').val() == 'monthly'){
         nameofcolum = "Monthly";
      }
      
function load_graph() {

var options = {
   exportEnabled: true,
   animationEnabled: true,
  
   title:{
      text: nameofcolum + " Usage",
      fontWeight: "bold",
      fontSize: 26,
      fontColor: "black",
   },
   subtitles: [{
      text: ""
   }],
   axisX: {
      interval: 1 ,
      intervalType: '<?php echo $intervaltype ?>',
      valueFormatString: '<?php echo $valueoftime; ?>'
   },
   axisY: {

      title: "Data Volume",
      titleFontColor: "black",
      lineColor: "black",
      labelFontColor: "black",
      tickColor: "black",
      includeZero: false,
      titleFontWeight: "bold"
   },
  
   toolTip: {
      shared: true
   },
   legend: {
      cursor: "pointer",
      itemclick: toggleDataSeries
   },
   data: [{
      type: "spline",
      name: "Download",
      showInLegend: true,
      xValueFormatString: "MMM YYYY",
      yValueFormatString: "#,###.##",
      dataPoints: [
      <?php $totalsum = array();
       foreach($devices->data->usages as $key => $contract): 
            $datetime = explode("T",$contract->from_date);
            $yyyy = explode("-",$datetime[0]);
            $time = explode(":",$datetime[1]);
            $totalsum[$key] = $contract->down + $contract->up;
            $datevalue= "";
            if($devices->data->type == 'hourly'){
               $datevalue = $yyyy[0].','.($yyyy[1]-1).','.$yyyy[2].','.$time[0].','.$time[1];
            }elseif($devices->data->type == 'monthly'){
              $datevalue = $yyyy[0].','.($yyyy[1]-1).','.$yyyy[2].','.$time[0].','.$time[1];
            }elseif($devices->data->type == 'daily')  {
               $datevalue = $yyyy[0].','.($yyyy[1]-1).','.$yyyy[2];
               
            }
         ?>

        {x: new Date(<?php echo $datevalue; ?>) , y: <?php echo $contract->down; ?>  },
      <?php endforeach; ?>
      ]
   },
   {  
      lineColor:"green",
      legendMarkerColor: "green",
      markerColor: "green",
       markerType: "square",
      type: "spline",
      showInLegend: true,
      name: "Upload",
      showInLegend: true,
      xValueFormatString: "MMM YYYY",
      yValueFormatString: "#,###.##",
      dataPoints: [
         <?php $totalsum = array();
             foreach($devices->data->usages as $key => $contract): 
            $datetime = explode("T",$contract->from_date);
            $yyyy = explode("-",$datetime[0]);
            $time = explode(":",$datetime[1]);
            $datevalue= "";
            if($devices->data->type == 'hourly'){
               $datevalue = $yyyy[0].','.($yyyy[1]-1).','.$yyyy[2].','.$time[0].','.$time[1];
            }elseif($devices->data->type == 'monthly'){
               $datevalue = $yyyy[0].','.($yyyy[1]-1).','.$yyyy[2].','.$time[0].','.$time[1];
            }elseif($devices->data->type == 'daily')  {
              $datevalue = $yyyy[0].','.($yyyy[1]-1).','.$yyyy[2];
            }
           $totalsum[$key] = $contract->down + $contract->up;

         ?>

        {x: new Date(<?php echo $datevalue; ?>) , y: <?php echo $contract->up; ?>  },
      <?php endforeach; ?>
      ]
   },
   {

      type: "spline",
      lineColor:"black",
      legendMarkerColor: "black",
      markerType: "square",
      markerSize: 10,
      markerColor: "black",
      name: "Total",
      lineDashType: "dash",
      showInLegend: true,
      xValueFormatString: "MMM YYYY",
      yValueFormatString: "#,###.##",
      dataPoints: [
         <?php $totalsum = array();
             foreach($devices->data->usages as $key => $contract): 
            $datetime = explode("T",$contract->from_date);
            $yyyy = explode("-",$datetime[0]);
            $time = explode(":",$datetime[1]);
            $datevalue= "";
            if($devices->data->type == 'hourly'){
               $datevalue = $yyyy[0].','.($yyyy[1]-1).','.$yyyy[2].','.$time[0].','.$time[1];
            }elseif($devices->data->type == 'monthly'){
               $datevalue = $yyyy[0].','.($yyyy[1]-1).','.$yyyy[2].','.$time[0].','.$time[1];
            }elseif($devices->data->type == 'daily')  {
               $datevalue = $yyyy[0].','.($yyyy[1]-1).','.$yyyy[2];
            }
           $totalsum[$key] = $contract->down + $contract->up;

         ?>

        {x: new Date(<?php echo $datevalue; ?>) , y: <?php echo $contract->down + $contract->up; ?>  },
      <?php endforeach; ?>
      ]
   }]
};
   $("#chartContainer").CanvasJSChart(options);

   function toggleDataSeries(e) {
      if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
         e.dataSeries.visible = false;
      } else {
         e.dataSeries.visible = true;
      }
      e.chart.render();
   }

}


</script>