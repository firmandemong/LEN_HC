<li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
    Peserta
</div>
<li class="nav-item {{Request::is('list-peserta') ? 'active' : ''}}">
    <a class="nav-link" href="/list-peserta">
        <i class="fas fa-user"></i>
        <span>Data Peserta</span></a>
</li>
<li class="nav-item {{Request::is('tugas-peserta') ? 'active' : ''}}">
    <a class="nav-link" href="/tugas-peserta">
        <i class="fas fa-clipboard"></i>
        <span>Penugasan</span></a>
</li>
<li class="nav-item {{Request::is('nilai-peserta') ? 'active' : ''}}">
    <a class="nav-link" href="/nilai-peserta">
        <i class="fa fa-check-square"></i>
        <span>Penilaian</span></a>
</li>

<hr class="sidebar-divider">
<div class="sidebar-heading">
    Divisi
</div>
<li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
    <a class="nav-link" href="/divisi/kuota">
        <i class="fas fa-fw fa-list-alt"></i>
        <span>Kuota Divisi</span></a>
</li>
