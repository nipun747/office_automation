@if ( session()->has('flash_message') )
 
  <div class="alert alert-success alert-dismissable">
      <h5>{{ session()->get('flash_message') }}</h5>
  </div>
  
@endif