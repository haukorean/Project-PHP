@extends('DoctorLayout')
@section('contents_doctor')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
                 <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <form class="d-flex">
                                            <div class="input-group">
                                                <input type="date" class="form-control form-control-light">
                                            
                                            </div>
                                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                                <i class="mdi mdi-autorenew"></i>
                                            </a>
                                            <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                                <i class="mdi mdi-filter-variant"></i>
                                            </a>
                                        </form>
                                    </div>
                                    <h4 class="page-title">Thống kê</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-5 col-lg-6">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-1" title="Number of Customers">Bệnh nhân</h5>
                                                <h3 class="mt-3 mb-3">{{$count_patient}}</h3>
                                                <p class="mb-2 text-muted pt-3">
                                                    <span class="text-nowrap">Một năm gần đây</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-1" title="Number of Orders">Lịch hẹn</h5>
                                                <h3 class="mt-3 mb-3">{{$countshedule}}</h3>
                                               <p class="mb-2 text-muted pt-3">
                                                    <span class="text-nowrap">Một năm gần đây</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-1" title="Average Revenue">Tổng thu nhập</h5>
                                                <h3 class="mt-3 mb-3">{{$costs_totals}}</h3>
                                                <p class="mb-2 text-muted pt-3">
                                                    <span class="text-nowrap">Một năm gần đây</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-pulse widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-1" title="Growth">Lượt truy cập</h5>
                                                <h3 class="mt-3 mb-3">{{$access_time}}</h3>
                                                <p class="mb-2 text-muted pt-3">
                                                    <span class="text-nowrap">Một năm gần đây</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->


                                </div> <!-- end row -->

                            </div> <!-- end col -->

                            <div class="col-xl-7 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <h4 class="header-title mb-3">Biểu đồ hống kê lịch trình gần đây </h4>

                              
                                            <div id="chart" ></div>
                                    
                                    
                                            
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                     
                                        <h4 class="header-title mb-3">Doanh Thu</h4>

                                        <div class="chart-content-bg">
                                            <div class="row text-center">
                                                <div class="col-md-6">
                                                    <p class="text-muted mb-0 mt-3">Tuần Này</p>
                                                    <h2 class="fw-normal mb-3">
                                                        <small class="mdi mdi-checkbox-blank-circle text-primary align-middle me-1"></small>
                                                        <span>{{$costs_CurrentWeek}}.VND</span>
                                                    </h2>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-muted mb-0 mt-3">Tuần Trước</p>
                                                    <h2 class="fw-normal mb-3">
                                                        <small class="mdi mdi-checkbox-blank-circle text-success align-middle me-1"></small>
                                                        <span>{{$costs_LastWeek}}.VND</span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>

                                    
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                         
                        </div>
                        <!-- end row -->

 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){


 setTimeout(function() {
     var chart = new Morris.Line({
      element: 'chart',
      lineColors: ['#A4ADD3'],
        parseTime: false,
        hideHover: 'auto',
        xkey: 'perChedule',
        ykeys: ['Schedule'],
        labels: ['Schedule']
    
      });

       load_static_chart();

          function load_static_chart(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url:"{{url('/doctor/load_static_chart')}}",
                method:"POST",
                 headers:{
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                dataType:"JSON",
                data:{_token:_token},
                  success:function(data){
                    chart.setData(data);
                  }
              });
            }


      }, 1000);



  });
</script>




@endsection