@php 
$pageTitle = "Crypto Purchase";
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
            <!-- row -->
			<div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Market Cap</a></li>
					</ol>
                </div>
				<div class="row">
					<div class="col-xl-12">
						<div class="table-responsive table-hover fs-14">
							<table class="table mb-4 dataTablesCard ">
								<thead>
									<tr>
										<th class="text-center">Rank</th>
										<th class="text-center">Coin</th>
										<th class="text-center">Price</th>
										<th class="text-center">Change (24h)</th>
										<th class="text-center">Volume (24h)</th>
										<th class="text-center">Total Marketcap ($)</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
                                    @if (count($coinsToPurchase) > 0)
                                    @php $counter = 1; @endphp
                                        @foreach ($coinsToPurchase as $key => $each_coin)
                                            @if($key == $setting->return_coins_limit) @break @endif
                                            <tr>
                                                <td class="width text-center">
                                                    <span class="bgl-primary text-primary d-inline-block p-3 fs-20 font-w600">#{{$counter}}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="font-w600 d-flex align-items-center">
                                                        <img width="30" height="30" src="{{$each_coin->coin_logo}}" alt="{{$each_coin->coin_name}}"/>
                                                        {{$each_coin->coin_name}}
                                                    </div>
                                                </td>
                                                @php if($each_coin->currrent_price > 1000){$new_amount = $each_coin->currrent_price - 100; }else{ $new_amount = $each_coin->currrent_price; } @endphp
                                                <td class="text-center">
                                                    <span class="font-w600">${{number_format($new_amount, 2)}}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="font-w500 text-success">{{$each_coin->percent_change_24h}}%</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="font-w500">${{$each_coin->volume_change_24h}}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="peity-line" data-width="100%">{{number_format($each_coin->market_cap)}}</span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('process-purchase', $each_coin->unique_id)}}" class="btn btn-success rounded-0 mb-2">
                                                        BUY
                                                        <svg class="ml-4 scale3" width="16" height="16" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16.9638 11.5104L16.9721 14.9391L3.78954 1.7565C3.22815 1.19511 2.31799 1.19511 1.75661 1.7565C1.19522 2.31789 1.19522 3.22805 1.75661 3.78943L14.9392 16.972L11.5105 16.9637L11.5105 16.9637C10.7166 16.9619 10.0715 17.6039 10.0696 18.3978C10.0677 19.1919 10.7099 19.8369 11.5036 19.8388L11.5049 19.3388L11.5036 19.8388L18.3976 19.8554L18.4146 19.8555L18.4159 19.8555C18.418 19.8555 18.42 19.8555 18.422 19.8555C19.2131 19.8533 19.8528 19.2114 19.8555 18.4231C19.8556 18.4196 19.8556 18.4158 19.8556 18.4117L19.8389 11.5035L19.8389 11.5035C19.8369 10.7097 19.1919 10.0676 18.3979 10.0695C17.604 10.0713 16.9619 10.7164 16.9638 11.5103L16.9638 11.5104Z" fill="white" stroke="white"></path>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @php $counter++ @endphp    
                                        @endforeach
                                    @else
                                        <tr><td colspan="11" class="text-center">No Data Available at this Moment</td></tr>
                                    @endif 
								</tbody>
							</table>
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