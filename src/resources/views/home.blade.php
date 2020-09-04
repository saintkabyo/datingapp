@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{Form::open(['route'=>'home','class'=>'form-inline','method'=>'get', 'name'=>'filter'])}}
                <div class="btn-group btn-group-toggle mr-3" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        {{Form::radio('v','grid',request('v') == 'grid')}} Grid
                    </label>
                    <label class="btn btn-secondary">
                        {{Form::radio('v','single',request('v') == 'single')}} Single
                    </label>
                </div>
                {{Form::select('g',[''=>'--Looking for--','Male'=>'Male','Female'=>'Female'],request('g'),['class'=>'form-control'])}}
            {{Form::close()}}
        </div>
        <div class="card-body">
            @if(request('v') == 'grid')
                @include('home_grid')
            @else
                @include('home_single')
            @endif
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$(document).ready(function(){
    $('input[name="v"],select[name="g"]').change(function(){
        $('form[name="filter"]').submit();
    });
});
</script>
@endpush