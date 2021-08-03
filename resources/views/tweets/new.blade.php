<form class="post-tweet" action="/" method="POST">
    @csrf
    <textarea class="form-control" name="body" placeholder="Enter Your Tweet.."></textarea>
    @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="info d-flex align-items-center justify-content-between">
        <img class="avatar" src="/{{ Auth::user()->profile->image }}" alt="">
        <button class="btn btn-main">Add Tweet</button>
    </div>
</form>
