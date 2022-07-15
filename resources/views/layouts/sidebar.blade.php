<div class="sidebar">
    <div class="mt-4 mb-3">
        <div class="row">
            <div class="col-auto">
                <figure class="avatar avatar-60 border-0"><img src="{{ asset('assets/img/user1.png') }}" alt=""></figure>
            </div>
            <div class="col pl-0 align-self-center">
                <h5 class="mb-1">{{ Auth::guard('orangtua')->user()->nama_lengkap }}</h5>
                <p class="text-mute small">{{ Auth::guard('orangtua')->user()->nik }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="list-group main-menu">
                <a href="/home" class="list-group-item list-group-item-action active"><i class="material-icons icons-raised">home</i>Home</a>
                <form action="/postlogout" method="POST">
                    @csrf
                    <button type="submit" class="list-group-item list-group-item-action"><i class="material-icons icons-raised bg-danger">power_settings_new</i>Logout
                        Logout</button>
                </form>
                <a href="login.html" class="list-group-item list-group-item-action">
            </div>
        </div>
    </div>
</div>
<a href="javascript:void(0)" class="closesidemenu"><i class="material-icons icons-raised bg-dark ">close</i></a>
