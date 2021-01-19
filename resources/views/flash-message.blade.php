<div class="flash-msg-container">
    @if (session('success') )
        <div class="alert alert-success  alert-dismissible fade show">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger  alert-dismissible fade show">
    		<button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('error') }}</strong>
        </div>
    @endif

    @if (session('response.status') == 'error')
        <div class="alert alert-danger alert-block alert-dismissible fade show">
    		<button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('response.message') }}</strong>
        </div>
    @endif 

    @if (session('response.status') == 'success' )
        <div class="alert alert-success  alert-block alert-dismissible fade show" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('response.message') }}</strong>
        </div>
    @endif 

</div>