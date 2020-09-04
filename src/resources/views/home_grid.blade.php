<div class="row row-cols-1 row-cols-md-4">
    @foreach($users as $user)
    <div class="col mb-4">
        <div class="card h-100">
        <img src="{{asset($user->photo)}}" class="card-img-top" height="200" alt="{{$user->name}}">
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