<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61a3e5ea9099530957f706bd/1flk3k7ma';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- Modal -->
<div class="modal fade" id="logoutModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logout Notification</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <div class="col-lg-12">
                        <h4 class="text-center">Do you really wish to logout from {{ env('APP_NAME') }} ?</h4>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary" type="submit">Log Me Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="copyright">
       <p> © 2019 - <?php $d=date('Y'); print $d;?> @ {{env('APP_NAME')}}. All Rights Reserved</p>
    </div>
</div>

@include('sweetalert::alert')