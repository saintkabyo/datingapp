@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    @if($errors->has('longitude') || $errors->has('latitude'))
                        <div class="alert alert-danger">
                            Location data not found! Please allow us to access your location data. 
                        </div>                    
                    @endif

                    {{Form::open(['route'=>'register','files'=>true])}}
                    {{Form::hidden('longitude')}}
                    {{Form::hidden('latitude')}}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    {{Form::text('name',null,['id'=>'name','class'=>'form-control '.($errors->has('name') ? 'is-invalid' : ''),'autocomplete'=>'name','autofocus'=>true])}}
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    {{Form::email('email',null,['id'=>'email','class'=>'form-control '.($errors->has('email') ? 'is-invalid' : ''),'autocomplete'=>'email'])}}
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        {{Form::radio('gender','Male',false,['id'=>'gender_1','class'=>'form-check-input'.($errors->has('gender') ? 'is-invalid' : '')])}}
                                        <label class="form-check-label" for="gender_1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        {{Form::radio('gender','Female',false,['id'=>'gender_2','class'=>'form-check-input'.($errors->has('gender') ? 'is-invalid' : '')])}}
                                        <label class="form-check-label" for="gender_2">Female</label>
                                    </div>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                        

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                                <div class="col-md-6">
                                    {{Form::text('dob',null,['id'=>'dob','class'=>'date form-control '.($errors->has('dob') ? 'is-invalid' : ''),'autocomplete'=>'dob'])}}
                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    {{Form::password('password',['id'=>'password','class'=>'form-control '.($errors->has('password') ? 'is-invalid' : ''),'autocomplete'=>'new-password'])}}
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    {{Form::password('password_confirmation',['id'=>'password-confirm','class'=>'form-control','autocomplete'=>'new-password'])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <img src="{{asset('img/default/user.svg')}}" width="300" height="300" class="img-fluid img-thumbnail" style="margin: 5px auto;" id="photo_display">
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo (&#x2264; 150kb) <span class="text-danger">*</span></label>
                                {{Form::file('photo',['id'=>'photo'])}}
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Register') }}
                        </button>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$(document).ready(function(){

    if ("geolocation" in navigator)
    {
        navigator.geolocation.getCurrentPosition(function(position){ 
            $("input[name='latitude']").val(position.coords.latitude);
            $("input[name='longitude']").val(position.coords.longitude);
        });
    }

    $(".date").datepicker({
        autoclose:true,
        format:'dd-mm-yyyy'
    });

	function showPhoto(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      $('#photo_display').attr('src', e.target.result);
	    }
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("#photo").change(function() {
	  showPhoto(this);
	});
});    
</script>
@endpush