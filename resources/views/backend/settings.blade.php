@php 
$pageTitle = "Settings Page";
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
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Settings</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link active show">Site Setting</a>
                                            </li>
                                            <li class="nav-item"><a href="#advance-settings" data-toggle="tab" class="nav-link">Advance Setting</a>
                                            </li>
                                            <li class="nav-item"><a href="#logo-settings" data-toggle="tab" class="nav-link">Site  Logo Setting</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="profile-settings" class="tab-pane fade active show">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <div class="row">
                                                            <div class="col-lg-10 offset-lg-1">
                                                                <h4 class="text-primary">Site Setting</h4>
                                                                <!-- Validation Errors -->
                                                                <x-auth-validation-errors class="mb-4 text-center text-danger" :errors="$errors" />
                                                                <form method="POST" action="{{ route('update-site-settings', $setting->unique_id) }}">
                                                                    @csrf
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label>Site Name</label>
                                                                            <input type="text" placeholder="Site Name" class="form-control" name="site_name" value="{{ $setting->site_name }}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Site Email</label>
                                                                            <input type="email" placeholder="Site Email" value="{{ $setting->site_email }}" name="site_email" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label>Return Coins Limit</label>
                                                                            <input type="number" placeholder="Return Coins Limit" value="{{ $setting->return_coins_limit }}" name="return_coins_limit" class="form-control">
                                                                        </div> 
                                                                        <div class="form-group col-md-6">
                                                                            <label>Referral Percentage <span>(%)</span></label>
                                                                            <input type="text" placeholder="Referral Percentage" class="form-control" name="ref_bonus" value="{{ $setting->ref_bonus }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label>Site Phone</label>
                                                                            <input type="text" placeholder="Site Phone" class="form-control" name="site_phone" value="{{ $setting->site_phone }}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Site Domain</label>
                                                                            <input readonly type="text" placeholder="Site Domain" value="{{ $setting->site_domain }}" name="site_domain" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label>Verification Token Length</label>
                                                                            <input type="number" placeholder="Verification Token Length" value="{{ $setting->verification_token_length }}" name="verification_token_length" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Penalty Withdrawal Fee <span>(%)</span></label>
                                                                            <input type="text" placeholder="Penalty Withdrawal Fee" class="form-control" name="withdrawal_penalty" value="{{ $setting->withdrawal_penalty }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label>Min Amount To Withdraw <span>($)</span></label>
                                                                            <input type="number" placeholder="Min Amount To Withdraw" class="form-control" name="min_wallet_withdrawal" value="{{ $setting->min_wallet_withdrawal }}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Max Amount To Withdraw <span>($)</span></label>
                                                                            <input type="number" placeholder="Max Amount To Withdraw" value="{{ $setting->max_amount_to_withdraw }}" name="max_amount_to_withdraw" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label>Min Amount To Transfer <span>($)</span></label>
                                                                            <input type="number" placeholder="Min Amount To Transfer" class="form-control" name="min_amount_to_transfer" value="{{ $setting->min_amount_to_transfer }}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Max Amount To Transfer <span>($)</span></label>
                                                                            <input type="number" placeholder="Max Amount To Transfer" value="{{ $setting->max_amount_to_transfer }}" name="max_amount_to_transfer" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label>Purchase Coin Percent<span>(%)</span></label>
                                                                            <input type="text" placeholder="Purchase Coin Percent" class="form-control" name="purchase_coin_percent" value="{{ $setting->purchase_coin_percent }}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>Purchase Coin Duration <span>(Days)</span></label>
                                                                            <input type="number" placeholder="Purchase Coin Duration" value="{{ $setting->purchase_coin_duration }}" name="purchase_coin_duration" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <label>Site Address</label>
                                                                            <textarea placeholder="Site Address" class="form-control" name="site_address">{{ $setting->site_address }}</textarea>
                                                                        </div>
                                                                    </div>                                                              
                                                                    <button class="btn btn-primary" type="submit">Update Setting</button>
                                                                </form>
                                                            </div>       
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="advance-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <div class="row">
                                                            <div class="col-lg-8 offset-lg-2">
                                                                <h4 class="text-primary">Advance Site Setting</h4>
                                                                <form action="{{ route('update-advance-settings', $setting->unique_id) }}" method="POST">
                                                                    @csrf
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label>Send Login Alert Mail</label>
                                                                            <select class="form-control" name="send_login_alert_mail">
                                                                                <option {{ ($setting->send_login_alert_mail == 'yes')? 'selected' : '' }} value="yes">Yes</option>
                                                                                <option {{ ($setting->send_login_alert_mail == 'no')? 'selected' : '' }} value="no">No</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>Send Welcome Message Mail</label>
                                                                            <select class="form-control" name="send_welcome_message_mail">
                                                                                <option {{ ($setting->send_welcome_message_mail == 'yes')? 'selected' : '' }} value="yes">Yes</option>
                                                                                <option {{ ($setting->send_welcome_message_mail == 'no')? 'selected' : '' }} value="no">No</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>Two Way Factor</label>
                                                                            <select class="form-control" name="two_factor_access">
                                                                                <option {{ ($setting->two_factor_access == 'yes')? 'selected' : '' }} value="yes">Yes</option>
                                                                                <option {{ ($setting->two_factor_access == 'no')? 'selected' : '' }} value="no">No</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label>Account Verification Access</label>
                                                                            <select class="form-control" name="account_verification_access">
                                                                                <option {{ ($setting->account_verification_access == 'yes')? 'selected' : '' }} value="yes">Yes</option>
                                                                                <option {{ ($setting->account_verification_access == 'no')? 'selected' : '' }} value="no">No</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>Capital Withdrawal Access</label>
                                                                            <select class="form-control" name="capital_withdrawal_access">
                                                                                <option {{ ($setting->capital_withdrawal_access == 'yes')? 'selected' : '' }} value="yes">Yes</option>
                                                                                <option {{ ($setting->capital_withdrawal_access == 'no')? 'selected' : '' }} value="no">No</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>Automatic Payout Access</label>
                                                                            <select class="form-control" name="automatic_payout_access">
                                                                                <option {{ ($setting->automatic_payout_access == 'yes')? 'selected' : '' }} value="yes">Yes</option>
                                                                                <option {{ ($setting->automatic_payout_access == 'no')? 'selected' : '' }} value="no">No</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                            <label>Referral System Access</label>
                                                                            <select class="form-control" name="referral_system_access">
                                                                                <option {{ ($setting->referral_system_access == 'yes')? 'selected' : '' }} value="yes">Yes</option>
                                                                                <option {{ ($setting->referral_system_access == 'no')? 'selected' : '' }} value="no">No</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>Send Basic Mail</label>
                                                                            <select class="form-control" name="send_basic_emails">
                                                                                <option {{ ($setting->send_basic_emails == 'yes')? 'selected' : '' }} value="yes">Yes</option>
                                                                                <option {{ ($setting->send_basic_emails == 'no')? 'selected' : '' }} value="no">No</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>Automate Money Send</label>
                                                                            <select class="form-control" name="automate_money_send">
                                                                                <option {{ ($setting->automate_money_send == 'yes')? 'selected' : '' }} value="yes">Yes</option>
                                                                                <option {{ ($setting->automate_money_send == 'no')? 'selected' : '' }} value="no">No</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-primary" type="submit">Update Advance Settings</button>
                                                                </form>
                                                            </div>       
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="logo-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <div class="row">
                                                            <div class="col-lg-8 offset-lg-2">
                                                                <h4 class="text-primary">Site Logo Setting</h4>
                                                                <center>
                                                                    <div style="width: 200px; height: 200px; border-radius: 50%; border: 3px solid grey;">
                                                                        <img src="{{($setting->site_logo_url == 'default.png') ? 'images/default.png' : $setting->site_logo_url}}" alt="{{$setting->site_name}}" width="150" height="150" />
                                                                    </div>
                                                                </center>
                                                                <form action="{{ route('update-site-logo', $setting->unique_id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label>Site Logo</label>
                                                                        <input type="file" class="form-control" name="thumbnail" />
                                                                    </div>
                                                                    <button class="btn btn-primary" type="submit">Update Site Logo</button>
                                                                </form>
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
	
	<!--removeIf(production)-->
        
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    @include('includes.e_script')
		
</body>

</html>