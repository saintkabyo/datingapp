<div class="row justify-content-center">
    @foreach($users as $user)
    <div class="col-md-6 ">
        <div class="card">
        <img src="{{asset($user->photo)}}" class="card-img-top" alt="{{$user->name}}">
            <div class="card-body">
                <h5 class="card-title">{{$user->name}}</h5>
                <p class="card-text">
                    <span>Age: {{$user->age()}}</span>
                    <span class="float-right">Distance: {{$user->distance()}} km</span>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{$users->appends(request()->input())->links()}}