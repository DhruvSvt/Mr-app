<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item">
                <a class="nav-item-hold" href="{{ route('index') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item " data-item="masters">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Settings-Window"></i>
                    <span class="nav-text">Masters</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item " data-item="doctor">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Stethoscope"></i>
                    <span class="nav-text">Doctors</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item " data-item="chemist">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Doctor"></i>
                    <span class="nav-text">Chemists</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item " data-item="dashboard">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
        <ul class="childNav" data-parent="masters">
            <li class="nav-item ">
                <a class="" href="{{ route('city.index') }}">
                    <i class="nav-icon fa-solid fa-city"></i>
                    <span class="item-name">City</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('area.index') }}" class="">
                    <i class="nav-icon fa-solid fa-chart-area"></i>
                    <span class="item-name">Area</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="" href="{{ route('product.index') }}">
                    <i class="nav-icon fa-solid fa-capsules"></i>
                    <span class="item-name">Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="" href="{{ route('strength.index') }}">
                    <i class="nav-icon fa-solid fa-dumbbell"></i>
                    <span class="item-name">Strenght</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="" href="{{ route('speciality.index') }}">
                    <i class="nav-icon fa fa-medkit"></i>
                    <span class="item-name">Speciality</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="doctor">
            <li class="nav-item ">
                <a class="" href="{{ route('doctor.create') }}">
                    <i class="nav-icon i-Add-User"></i>
                    <span class="item-name">Create Doctor</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="" href="{{ route('doctor.index') }}">
                    <i class="nav-icon i-Stethoscope"></i>
                    <span class="item-name">Doctor Details</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="chemist">
            <li class="nav-item ">
                <a class="" href="{{ route('chemist.create') }}">
                    <i class="nav-icon i-Medicine-2"></i>
                    <span class="item-name">Create Chemist</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="" href="{{ route('chemist.index') }}">
                    <i class="nav-icon i-Shop"></i>
                    <span class="item-name">Chemist Details</span>
                </a>
            </li>
        </ul>
        <ul class="childNav" data-parent="dashboard">
            <li class="nav-item ">
                <a class="" href="dashboard/dashboard1.html">
                    <i class="nav-icon i-Clock-3"></i>
                    <span class="item-name">Version 1</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="dashboard/dashboard2.html" class="">
                    <i class="nav-icon i-Clock-4"></i>
                    <span class="item-name">Version 2</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="" href="dashboard/dashboard3.html">
                    <i class="nav-icon i-Over-Time"></i>
                    <span class="item-name">Version 3</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="" href="dashboard/dashboard4.html">
                    <i class="nav-icon i-Clock"></i>
                    <span class="item-name">Version 4</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
</div>
