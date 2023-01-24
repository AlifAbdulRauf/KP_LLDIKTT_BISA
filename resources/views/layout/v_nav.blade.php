 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">LLDIKTI WILAYAH X</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="/home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

@if (auth()->user()->role_user=='Admin')
<!-- Divider -->
<hr class="sidebar-divider">
 <!-- Nav Item - Pages Collapse Menu -->
 <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Data Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
            <a class="collapse-item" href="/karyawan">karyawan</a>
            <a class="collapse-item" href="/user">user</a>
            <a class="collapse-item" href="/lokasi">lokasi</a>
            <a class="collapse-item" href="/transportasi">Transportasi</a>
            <a class="collapse-item" href="penginapan">penginapan</a>
        </div>
    </div>
</li>

<!-- Heading -->
<!-- <div class="sidebar-heading">
    Dinas Luar
</div> -->
<!-- Divider -->
<!-- <hr class="sidebar-divider">
<!- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" 
        aria-expanded="true" aria-controls="collapseOne">
        <i class="fas fa-fw fa-folder"></i>
        <span>Dinas Luar</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
            <a class="collapse-item" href="/pusat">Pusat</a>
            <a class="collapse-item" href="/kantor">Kantor</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" 
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Surat Tugas</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
            <a class="collapse-item" href="/surat_tugaspp">Pusat</a>
            <a class="collapse-item" href="/surat_tugaskk">Kantor</a>
        </div>
    </div>
</li>

@elseif (auth()->user()->role_user=='Pimpinan')
 <!-- Nav Item - Charts -->
 <li class="nav-item">
    <a class="nav-link" href="/disposisi">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Disposisi</span></a>
</li>

@elseif (auth()->user()->role_user=='Admin HKT')
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" 
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Surat Tugas</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
            <a class="collapse-item" href="/surat_tugasp">Pusat</a>
            <a class="collapse-item" href="/surat_tugask">Kantor</a>
        </div>
    </div>
</li>

@elseif (auth()->user()->role_user=='Admin Keuangan')
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Keuangan</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
            <a class="collapse-item" href="/keuangan">Pusat</a>
            <a class="collapse-item" href="/keuangank">Kantor</a>
            <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a> -->
        </div>
    </div>
</li>
@endif









<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading
<div class="sidebar-heading">
    Addons
</div> -->

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item active">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
        aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item active" href="blank.html">Blank Page</a>
        </div>
    </div>
</li> -->



<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="/profil">
        <i class="fas fa-fw fa-table"></i>
        <span>Ubah Password</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!--End of Sidebar -->