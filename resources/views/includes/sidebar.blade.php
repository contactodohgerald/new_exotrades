<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-user"></i>
                    <span class="nav-text">Profile</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('profile') }}">View Profile</a></li>
                    <li><a href="{{ route('edit-profile') }}">Edit Profile</a></li>
                </ul>
            </li>

            @if (auth()->user()->account_type == 'user')
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-controls-3"></i>
                        <span class="nav-text">Invest Section</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('invest') }}">Invest</a></li>
                        <li><a href="{{ route('pending-investment-history') }}">Pending History</a></li>
                        <li><a href="{{ route('investment-history') }}">Investment History</a></li>
                    </ul>
                </li> 
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-heart"></i>
                        <span class="nav-text">Earning Section</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('earnings-page') }}">Earnings</a></li>
                        <li><a href="{{ route('earnings-history') }}">Earning History</a></li>
                    </ul>
                </li>
                {{-- <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-heart"></i>
                        <span class="nav-text">Transfer Funds <sup class="text-danger">New</sup></span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('transfer-funds-page') }}">Transfer Funds</a></li>
                        <li><a href="{{ route('transfer-funds-history') }}">Transfer Funds History</a></li>
                        <li><a href="{{ route('recieve-funds-history') }}">Recieve Funds History</a></li>
                    </ul>
                </li> --}}
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-notepad"></i>
                        <span class="nav-text">Withdrawal</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('funds-withdrawal') }}">Initiate Withdrawal</a></li>
                        <li><a href="{{ route('withdrawal-history') }}">Withdrawal History</a></li>
                    </ul>
                </li> 
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-layer-1"></i>
                        <span class="nav-text">Purchase Crypto <sup class="text-danger">New</sup></span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('crypto-purchase') }}">Crypto Purchase </a></li>
                        <li><a href="{{ route('crypto-purchase-history') }}">Purchase History</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-network"></i>
                        <span class="nav-text">Upgrade Investment</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('reinvest') }}">Upgrade Investment</a></li>
                        <li><a href="{{ route('pending_withdrawals') }}">View Pending History</a></li>
                        <li><a href="{{ route('confirm_withdrawals') }}">View Confirmed History</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Emergency Cashout <sup class="text-danger">New</sup></span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('investment-cashout') }}">Emergency Withdraw</a></li>
                        <li><a href="{{ route('pending-emergency-withdrawal') }}">View Pending History</a></li>
                        <li><a href="{{ route('view-emergency-withdrawal') }}">View Confirmed History</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-layer-1"></i>
                        <span class="nav-text">Refferals</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('my-referrals') }}">Refferals</a></li>
                        <li><a href="{{ route('withdraw-comission') }}">Refferals Withdrwal</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void()" class="has-arrow ai-icon" aria-expanded="false">
                        <i class="flaticon-381-controls-3"></i>
                        <span class="nav-text">Wallet Setup</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('user-wallet-page') }}">Add Wallets</a></li>
                        <li><a href="{{ route('view-user-wallet-page') }}">View Wallets</a></li>
                    </ul>
                </li>
            @else
                <li>
                    <a href="javascript:void()" class="has-arrow ai-icon" aria-expanded="false">
                        <i class="flaticon-381-controls-3"></i>
                        <span class="nav-text">Investments</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('confrim-investment') }}">Confrim Investment</a></li>
                        <li><a href="{{ route('view-investment-history') }}">Investment History</a></li>
                    </ul>
                </li> 
                <li>
                    <a href="{{ route('interest-adder') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-network"></i>
                        <span class="nav-text">Interest Adder</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-controls-1"></i>
                        <span class="nav-text">Payouts</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('pay-out') }}">Payouts</a></li>
                        <li><a href="{{ route('payment-history') }}">Payment History</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-layer-1"></i>
                        <span class="nav-text">Purchase Crypto <sup class="text-danger">New</sup></span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin-comfirm-purchase') }}">Confrim Purchase </a></li>
                        <li><a href="{{ route('admin-purchase-history') }}">Purchase History</a></li>
                        <li><a href="{{ route('purchase-payout') }}">Crypto Purchase Payout</a></li>
                        <li><a href="{{ route('purchase-payout-history') }}">Purchase Payout History</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-controls-3"></i>
                        <span class="nav-text">Upgrade Investment</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('confirm-upgraded-invest') }}">Confirm Investment</a></li>
                        <li><a href="{{ route('upgraded-invest-history') }}">Investment History</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Emergency Cashout</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin-confirm-withdrawals') }}">Order Payouts</a></li>
                        <li><a href="{{ route('upgrade-withdraw-history') }}">Order History</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-heart"></i>
                        <span class="nav-text">Users</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('users-account') }}">User Account</a></li>
                    </ul>
                </li> 
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-internet"></i>
                        <span class="nav-text">Investment Plans</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('create-plan') }}">Add Plan</a></li>
                        <li><a href="{{ route('view-plan') }}">View Plan</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('post-news') }}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-controls-2"></i>
                        <span class="nav-text">Post News</span>
                    </a>
                </li> 
                <li>
                    <a class="ai-icon" href="{{ route('settings-page') }}" aria-expanded="false">
                        <i class="flaticon-381-settings-2"></i>
                        <span class="nav-text">Site Settings</span>
                    </a>
                </li> 
                <li>
                    <a href="javascript:void()" class="has-arrow ai-icon" aria-expanded="false">
                        <i class="flaticon-381-controls-3"></i>
                        <span class="nav-text">Site Wallet Setup</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('site-wallet-page') }}">Add Wallets</a></li>
                        <li><a href="{{ route('view-site-wallet-page') }}">View Wallets</a></li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="javascript:void(0);"  data-toggle="modal" data-target="#logoutModal" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>