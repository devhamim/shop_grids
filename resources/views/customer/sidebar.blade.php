<div class="list-group">

    <a href="{{route('customer.dashboard')}}" class="list-group-item list-group-item-action {{Request::routeIs('customer.dashboard')?'active':''}}" aria-current="true">
        Dashboard
    </a>
    <a href="{{route('customer.profile')}}" class="list-group-item list-group-item-action {{Request::routeIs('customer.profile')?'active':''}}">Profile</a>
    <a href="{{route('customer.order')}}" class="list-group-item list-group-item-action {{Request::routeIs('customer.order')?'active':''}}">Order</a>
    <a href="#" class="list-group-item list-group-item-action">Account</a>
    <a href="#" class="list-group-item list-group-item-action">Change Password</a>
    <a href="#" class="list-group-item list-group-item-action">Logout</a>
</div>
