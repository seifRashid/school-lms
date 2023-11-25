@if (!empty(session('error')))
    <div class="alert alert-danger alert-dismisible fade-in" role="alert">
        {{ session('error') }}
    </div>
@elseif (!empty(session('success')))
    <div class="alert alert-success alert-dismisible fade-in" role="alert">
        {{ session('success') }}
    </div> 
@endif