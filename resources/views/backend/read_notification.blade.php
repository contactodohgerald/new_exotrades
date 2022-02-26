@php 
$pageTitle = "Single Notification Page";
@endphp

@include('includes.head')

<body>

     <!--*******************
        Preloader start
    ********************-->
   @include('includes.header')
   <!--**********************************
       Header end ti-comment-alt
   ***********************************-->

   <!--**********************************
       Sidebar start
   ***********************************-->
  @include('includes.sidebar')
   <!--**********************************
       Sidebar end
   ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">All Notification</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Single Notification</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                               
                                <div class="right-box ml-0 ml-sm-4 ml-sm-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="right-box-padding">
                                                <div class="read-content">
                                                    <div class="media pt-3">
														<h1>{{ $posts->message_title }}</h1>
													</div>
                                                    <hr>
                                                    <div class="read-content-body">
                                                        <p class="mb-2">{{ $posts->message_body }}</p>   
                                                        <div class="date">{{ $posts->created_at->diffForHumans() }}</div>             
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('includes.footer')
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    @include('includes.e_script')

</body>

</html>