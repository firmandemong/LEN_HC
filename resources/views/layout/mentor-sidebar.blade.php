<li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
    Peserta
</div>
<li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-chalkboard-teacher"></i>
        <span>Data Peserta</span></a>
</li>

<hr class="sidebar-divider">
<div class="sidebar-heading">
    Divisi
</div>
<li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
    <a class="nav-link" href="/divisi/kuota">
        <i class="fas fa-fw fa-chalkboard-teacher"></i>
        <span>Kuota Divisi</span></a>
</li>
