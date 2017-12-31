<?php //$this->load->view('templates/header');?>
<!-- <div class="row" style="margin-bottom: 20px">
<div class="col-md-4">
<h2>Home</h2>
<p>
</p>
</div>
</div> -->
<?php //$this->load->view('templates/footer'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>DevExtreme Demo</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js'); ?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dx.spa.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dx.common.css'); ?>" />
  <link rel="dx-theme" data-theme="generic.light" href="<?php echo base_url('assets/css/dx.light.css'); ?>" />
  <script src="<?php echo base_url('assets/js/jszip.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/dx.all.js'); ?>"></script>

</head>
<body>
  <div class="demo-container">
    <div id="pivotGridContainer" style="height:380px; max-width:800px; margin:0 auto"></div>
    <div id="chartContainer" style="height:380px; max-width:800px; margin:0 auto"></div>
    <div id="sales-fieldchooser"></div>
  </div>
  <script>
  var sales =<?php echo $json; ?>;
  $(function(){
    var pivotGridInstance = $("#pivotGridContainer").dxPivotGrid({
      allowSortingBySummary: true,
      allowSorting: true,
      allowFiltering: true,
      showBorders: true,
      dataSource: {
        store: sales,
        // fields: [
        //   {
        //     caption: "Jumlah",
        //     dataField: "id_indikator",
        //     dataType: "number",
        //     summaryType: "count",
        //     area: "data"
        //   }, {
        //       caption:"Nama Standar",
        //       dataField: "nama_standar",
        //       area: "row",
        //     },{
        //         caption:"Jangka Waktu",
        //         dataField: "jangka_waktu",
        //         area: "row",
        //       }]
        // fields: [
        //   {
        //     caption:"Status",
        //     dataField: "status",
        //     area: "row",
        //   },{
        //     caption: "Jumlah",
        //     dataField: "id_user",
        //     dataType: "number",
        //     summaryType: "count",
        //     area: "data"
        //   }]
          // fields: [
          //   {
          //       caption: "Jumlah",
          //       dataField: "nama",
          //       dataType: "number",
          //       summaryType: "count",
          //       area: "data"
          //   },{
          //     caption:"Standar",
          //     dataField: "nama_standar",
          //     area: "row",
          // },{
          //     caption:"Jangka Waktu",
          //     dataField: "jangka_waktu",
          //     area: "row",
          // }]
          // fields: [{
          //     caption: "Region",
          //     width: 120,
          //     dataField: "region",
          //     area: "row"
          // }, {
          //     caption: "City",
          //     dataField: "city",
          //     width: 100,
          //     area: "row"
          // }, {
          //     dataField: "date",
          //     dataType: "date",
          //     area: "column",
          //     filterType: 'exclude',
          //     filterValues: [[2015]]
          // }, {
          //     caption: "Total",
          //     dataField: "amount",
          //     dataType: "number",
          //     summaryType: "sum",
          //     format: "currency",
          //     area: "data"
          // }, {
          //     caption: "Average",
          //     dataField: "amount",
          //     dataType: "number",
          //     summaryType: "avg",
          //     format: "currency",
          //     area: "data"
          // }]
        },
        fieldChooser: { enabled: true }
      }).dxPivotGrid('instance');
      // var dataSource = [{
      //   country: "Russia",
      //   area: 12
      // }, {
      //   country: "Canada",
      //   area: 7
      // }, {
      //   country: "USA",
      //   area: 7
      // }, {
      //   country: "China",
      //   area: 7
      // }, {
      //   country: "Brazil",
      //   area: 6
      // }, {
      //   country: "Australia",
      //   area: 5
      // }, {
      //   country: "India",
      //   area: 2
      // }, {
      //   country: "Others",
      //   area: 55
      // }];
      // $("#chartContainer").dxPieChart({
      //   size: {
      //     width: 500
      //   },
      //   palette: "bright",
      //   dataSource: {
      //     store: dataSource,
      //     fields: [
      //       {
      //         caption:"Status",
      //         dataField: "country",
      //       },{
      //         caption: "Jumlah",
      //         dataField: "area",
      //       }]},
      //        fieldChooser: { enabled: true },
      //   series: [
      //     {
      //       argumentField: "country",
      //       valueField: "area",
      //       label: {
      //         visible: true,
      //         connector: {
      //           visible: true,
      //           width: 1
      //         }
      //       }
      //     }
      //   ],
      //   title: "Area of Countries",
      //   "export": {
      //     enabled: true
      //   },
      //   onPointClick: function (e) {
      //     var point = e.target;
      //
      //     toggleVisibility(point);
      //   },
      //   onLegendClick: function (e) {
      //     var arg = e.target;
      //
      //     toggleVisibility(this.getAllSeries()[0].getPointsByArg(arg)[0]);
      //   }
      // });
      $("#chartContainer").dxChart({
             dataSource: [],
             commonSeriesSettings: {
                 type: 'bar'
             },
             onInitialized: function (e) {
                 pivotGridInstance.bindChart(e.component, {
                     alternateDataFields: false,
                     customizeChart: function (chartOptions) {
                         var colors = ['rgba(204, 230, 255, 0.3)', 'rgba(230, 255, 230, 0.5)'];

                         $.each(chartOptions.panes, function (i, pane) {

                             $.extend(pane, {
                                 backgroundColor: colors[i]
                             })
                         });
                     }
                 });
             }
         });
      var salesFieldChooser = $("#sales-fieldchooser").dxPivotGridFieldChooser({
             dataSource: pivotGridInstance.getDataSource(),
             texts: {
                 allFields: "All",
                 columnFields: "Columns",
                 dataFields: "Data",
                 rowFields: "Rows",
                 filterFields: "Filter"
             },
             width: 400,
             height: 400
         }).dxPivotGridFieldChooser("instance");
    });
    </script>
  </body>
  </html>
