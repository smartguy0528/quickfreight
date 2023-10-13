@if(session('errors') && session('errors')->first('message'))
<input type="hidden" class="errorMsg" value="{{session('errors')->first('message')}}">
@endif

@if (Session::has('success'))
<div class="d-none" id="successMsg">
    {{Session('success')}}
</div>
@endif
