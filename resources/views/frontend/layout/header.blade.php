<!-- ======= Header ======= -->
<nav>
    <div class="logo">
        <a href="{{route('home')}}"><img src="{{asset('public/frontend/assets/img/logo 2.png')}}" alt=""></a>
    </div>
    <input type="checkbox" id="click" class="menu-checkbox">
    <label for="click" class="menu-btn">
        <i class="bi bi-list"></i>
    </label>
    <ul>
        <li><a class="active" href="#">Find a Part</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="{{route('supplier.join')}}">Become a Supplier</a></li>
        <li><a href="{{route('login')}}">Breaker Login</a></li>
    </ul>
</nav>
<!-- End Header -->
