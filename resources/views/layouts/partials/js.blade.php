<script>
close=document.getElementById("close");close.addEventListener('click',function(){close.style.opacity="0"; setTimeout(function(){ close.style.display="none"; }, 600); },false);
   var _portal = {
       currencySymbol: '{{Config::get("customer_portal.currency_symbol")}}',
       thousandsSeparator: '{{Config::get("customer_portal.thousands_separator")}}',
       decimalSeparator: '{{Config::get("customer_portal.decimal_separator")}}'
   };
</script>
<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/assets/lang.dist.js"></script>
<script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/chart.js/dist/Chart.min.js"></script>
<script src="/assets/libs/chart.js/Chart.extension.min.js"></script>
<script src="/assets/libs/highlight/highlight.pack.min.js"></script>
<script src="/assets/libs/flatpickr/dist/flatpickr.min.js"></script>
<script src="/assets/libs/list.js/dist/list.min.js"></script>
<script src="/assets/libs/select2/select2.min.js"></script>
<script src="/assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
<script src="/assets/libs/jquery-payment-plugin/jquery.payment.min.js"></script>
<script src="/assets/libs/moment/moment.min.js"></script>

<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>


   moment.locale('{{Config::get("app.locale")}}');
   $(document).ready(function(){


     $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});$(".languageSelector").change(function(){var language = $(this).val();$.ajax("/language",{data: {language: language},dataType: 'json',type: 'POST'}).then(function() {setTimeout(function(){location.reload();}, 100);});});


 });

  $(function(){
    $("#stard_date").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#end_date").datepicker({ dateFormat: 'yy-mm-dd' });
  });


   Number.prototype.formatCurrency = function(c){
       var n = this,
           c = isNaN(c = Math.abs(c)) ? 2 : c,
           d = _portal.decimalSeparator,
           t = _portal.thousandsSeparator,
           s = n < 0 ? "-" : "",
           i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
           j = (j = i.length) > 3 ? j % 3 : 0;
       return _portal.currencySymbol + s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
   };


$("#end_date").change(function () {
    var startDate = document.getElementById("stard_date").value;
    var endDate = document.getElementById("end_date").value;

    if ((Date.parse(startDate) >= Date.parse(endDate))) {
        $("#datevalidation").html('The end date should be greater than start date');
        document.getElementById("end_date").value = "";
    }else{
      $("#datevalidation").html('&nbsp;');
    }
});




  function load_graph() {

var options = {
   exportEnabled: true,
   animationEnabled: true,
   title:{
      text: ""
   },
   subtitles: [{
      text: ""
   }],
   axisX: {
      
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
      name: "Donwload",
      showInLegend: true,
      xValueFormatString: "MMM YYYY",
      yValueFormatString: "#,##0 MB",
      dataPoints: []
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
      yValueFormatString: "#,##0 MB",
      dataPoints: []
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
      yValueFormatString: "#,##0 MB",
      dataPoints: []
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
  load_graph();


    
 // function change_plus_mins(){
 //      if ($("#iconof").hasClass( "fa-plus" ) ) {
 //        $('#iconof').removeClass('fa-plus').addClass('fa-minus');
 //      }else{
 //        $('#iconof').removeClass('fa-minus').addClass('fa-plus');
 //      }
 // }




</script>


@yield('additionalJS')
