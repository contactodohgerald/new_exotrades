@php 
$pageTitle = "My Referral Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">My Referral</a></li>
					</ol>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">My Referrals <small>(Total - {{ count($downline) }})</small></h4>
                            </div>
                            <div class="card-body">
                                <table cellpadding="0" cellspacing="0" border="0" class="table ">
                                    <tbody>
                                        <tr align="center">
                                            <td>
                                                <div class="s-box">
                                                    <img src="{{ asset('backend/images/used/ac-7.png') }}">
                                                    <h4>Total Referrals</h4>
                                                    <h3>{{ count($downline)}}</h3>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="s-box">
                                                    <img src="{{ asset('backend/images/used/box-1.png') }}">
                                                    <h4>Bonus</h4>
                                                    <h3>$ {{ number_format($user->ref_bonus_balance) }}</h3>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="form-group">
                                    <div class="text-center">
                                        <p class="m-0">Referral Link</p>
                                        <h4 class="text-primary m-0">{{ $setting->site_domain}}?ref={{ $user->referral_id}}</h4>
                                        <input style="display: none" type="text" value="{{ $setting->site_domain }}?ref={{ $user->referral_id }}" class="form-control" id="copyWallet">
                                        <button class="btn btn-dark" onclick="processWalletCopy()">Copy & Paste Link</button>
                                    </div>
                                </div>
                                <hr>
                                <h3 class="text-center">==Direct Refferals==</h3>
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">Referral Name</th>
                                                <th class="text-center">Referral Email</th>
                                                <th class="text-center">Date Joined</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($downline) > 0)
                                            @php $counter = 1; @endphp
                                                @foreach ($downline as $each_downline)
                                                <tr>
                                                    <td class="text-center">{{ $counter }}</td>
                                                    <td class="text-center">{{ $each_downline->name }}</td>
                                                    <td class="text-center">{{ $each_downline->email }}</td>		
                                                    <td class="text-center">{{ $each_downline->created_at->diffForHumans() }}</td>
                                                </tr> 
                                                @php $counter++ @endphp    
                                                @endforeach
                                            @else
                                                <tr><td colspan="11" class="text-center">No Data Available at this Moment</td></tr>
                                            @endif
                                                                                 
                                        </tbody>                                       
                                    </table>
                                    <div class="card-footer text-right">  
                                        {{ $downline->render("pagination::bootstrap-4") }}                        
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

    <script>
        function processWalletCopy() {
            /* Get the text field */
            var copyText = document.getElementById("copyWallet");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            
            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            alert("Link Copied! " + copyText.value);
        }
    </script>

</body>

</html>