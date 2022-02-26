@php 
$pageTitle = "Notification Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">All Notification</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="right-box ml-0 ml-sm-4 ml-sm-0">
                                    <div role="toolbar" class="toolbar ml-1 ml-sm-0">
                                        <div class="btn-group mb-1">
											<h3>All Notification ({{ count($posts) }})</h3>
										</div>
                                    </div>
                                    <div class="email-list mt-3">
                                        @if (count($posts) > 0)

                                            @foreach ($posts as $each_post)
                                            <div class="message">
                                                <div>
                                                    <div class="d-flex message-single">
                                                        <div class="ml-2">
                                                            <button class="border-0 bg-transparent align-middle p-0">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('single-notification', $each_post->unique_id) }}" class="col-mail col-mail-2">
                                                        <div class="subject">{{ $each_post->message_title }} - {{ $each_post->message_body }}</div>
                                                        <div class="date">{{ $each_post->created_at->diffForHumans() }}</div>
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach

                                        @else
                                        <div class="message">
                                            <div>
                                                <a href="javascript:void()" class="col-mail col-mail-2">
                                                    <div class="subject alert alert-success text-center">No news post is available at this moment</div>
                                                </a>
                                            </div>
                                        </div>                                            
                                        @endif
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