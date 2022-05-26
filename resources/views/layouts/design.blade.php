<!DOCTYPE html>
<html lang="en">

    @include('layouts.head')

    @yield('extra_style')

<body>   
    
    @include('layouts.header')
    
    
    @yield('content')
    
    
    @yield('extra_div')
    
    
    @include('layouts.footer')
    
    
    @include('layouts.e_script')
    
    @yield('extra_script') 

    @include('tawk_to')
	
</body>

</html>