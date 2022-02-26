@php 
$pageTitle = "Withdraw Bonus Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Withdraw Bonus</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Withdraw Bonus</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="card currency-bx overflow-hidden relative bg-info">
                                            <div class="card-body p-4">
                                                <div class="media align-items-center text-center">
                                                    <div class="media-body">
                                                        <h5 class="text-white fs-20">Referral Bonus Balance</h5>
                                                        <h1 class="text-white mb-0">$ {{ number_format($user->ref_bonus_balance) }}</h1>
                                                    </div>
                                                    <div class="currency-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45" height="45" fill="#319bd7" viewBox="0 0 512 512"><g><g><path d="M256,0C114.624,0,0,114.624,0,256s114.624,256,256,256s256-114.624,256-256S397.376,0,256,0z M272,208 c8.832,0,16,7.168,16,16c0,8.832-7.168,16-16,16h-78.656c-0.736,5.216-1.344,10.528-1.344,16s0.608,10.784,1.344,16H256
                                                        c8.832,0,16,7.168,16,16c0,8.832-7.168,16-16,16h-52.864c13.856,28.544,39.392,48,68.864,48c13.952,0,27.072-4.128,39.008-12.256
                                                        c7.264-4.928,17.248-3.104,22.208,4.192c4.96,7.296,3.104,17.248-4.224,22.24C311.904,377.824,292.192,384,272,384
                                                        c-46.88,0-87.008-33.184-103.68-80H144c-8.832,0-16-7.168-16-16c0-8.832,7.168-16,16-16h17.408
                                                        c-0.576-5.312-1.408-10.528-1.408-16s0.832-10.688,1.408-16H144c-8.832,0-16-7.168-16-16c0-8.832,7.168-16,16-16h24.32
                                                        c16.672-46.816,56.8-80,103.68-80c20.192,0,39.904,6.176,56.992,17.824c7.328,4.992,9.184,14.944,4.224,22.24
                                                        c-4.96,7.36-14.976,9.152-22.208,4.192C299.072,164.128,285.952,160,272,160c-29.472,0-55.008,19.456-68.864,48H272z"></path></g></g></svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="bg-img" src="images/money/euro.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#withdrawFunds"> 
                                                <svg width="27" height="27" viewBox="0 0 15 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.9375 20.768L5.9375 2.125C5.9375 1.33108 6.58107 0.6875 7.375 0.6875C8.16892 0.6875 8.8125 1.33108 8.8125 2.125L8.8125 20.768L11.2311 18.3377L11.2311 18.3377C11.7911 17.775 12.7013 17.7728 13.264 18.3328C13.8269 18.893 13.8288 19.8032 13.2689 20.3658L12.9145 20.0131L13.2689 20.3658L8.3939 25.2644L8.38872 25.2696L8.38704 25.2712C7.82626 25.8272 6.92186 25.8253 6.36301 25.2712L6.36136 25.2697L6.35609 25.2644L1.48109 20.3658L1.48108 20.3658C0.921124 19.8031 0.9232 18.8929 1.48597 18.3328C2.04868 17.7728 2.95884 17.7749 3.51889 18.3376L3.51891 18.3377L5.9375 20.768Z" fill="#6418C3" stroke="#6418C3"></path>
                                                </svg> 
                                                WITHDRAW FUNDS
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title mt-5">Withdraw Referral Bonus History</h4>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Amount($)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Wallet Type</th>
                                                <th class="text-center">Wallet Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($refComission) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($refComission as $each_withdraw)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ number_format($each_withdraw->amount) }}</td>
                                                    <td class="text-center">
                                                        <span class="badge light badge-{{ ($each_withdraw->status == 'confirmed')?'success':'danger' }} ">
                                                            <i class="fa fa-circle text-{{ ($each_withdraw->status == 'confirmed')?'success':'danger' }}  mr-1"></i>
                                                            {{ $each_withdraw->status }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">{{ $each_withdraw->user_wallet->system_wallet->wallet_name }}</td>	
                                                    <td class="text-center">{{ $each_withdraw->user_wallet->wallet_address }}</td>									
                                                </tr> 
                                                @php $counter++ @endphp    
                                                @endforeach
                                            @else
                                                <tr><td colspan="11" class="text-center">No Data Available at this Moment</td></tr>
                                            @endif                                    
                                        </tbody>                                       
                                    </table>
                                </div>
                                <div class="card-footer text-right">
                                    {{ $refComission->render("pagination::bootstrap-4") }}                
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

        <!-- Modal -->
        <div class="modal fade" id="withdrawFunds">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Withdraw Funds</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                     <form action="{{ route('create-comission-invoice') }}" method="POST">
                         @csrf
                        <div class="modal-body">
                            <div class="row"> 
                                <div class="col-lg-12 text-center">
                                    <p class="m-0">Available Referral Bonus Balance</p>
                                    <h1 class="m-0">${{ number_format($user->ref_bonus_balance) }}</h1>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="user_wallet_unique_id">Select Wallet Address</label>
                                        <select name="user_wallet_unique_id" id="user_wallet_unique_id" class="form-control" required>
                                            <option value="">Please Select</option>
                                            @if(count($userWallet) > 0)
                                                @foreach($userWallet as $each_wallet)
                                                    <option value="{{$each_wallet->unique_id}}">{{$each_wallet->system_wallet->wallet_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" name="amount" placeholder="Amount" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="alert alert-success text-center">
                                        <p>please naviagte to the <a href="{{ route('edit-profile') }}">settings page</a> to set up your wallet address correctly to avoid loss of funds</p>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <button class="btn btn-primary" type="submit">Place Withdraw Invoice</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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