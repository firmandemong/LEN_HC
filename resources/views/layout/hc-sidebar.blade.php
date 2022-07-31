<li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
    <a class="nav-link" href="/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
    Peserta
</div>
<li class="nav-item {{Request::is('data-pengajuan') ? 'active' : ''}}">
    <a class="nav-link" href="/data-pengajuan">
        <i class="fas fa-fw fa-clipboard"></i>
        <span>Data Pengajuan</span></a>
</li>
<li class="nav-item {{Request::is('data-peserta') ? 'active' : ''}}">
    <a class="nav-link" href="/data-peserta">
        <i class="fas fa-fw fa-user"></i>
        <span>Data Peserta</span></a>
</li>
<li class="nav-item {{Request::is('data-peserta') ? 'active' : ''}}">
    <a class="nav-link" href="/data-peserta">
        <i class="fas fa-fw fa-user"></i>
        <span>Sertifikat Peserta</span></a>
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
    Pembimbing & Divisi
</div>
<li class="nav-item {{Request::is('data-pembimbing') ? 'active' : ''}}">
    <a class="nav-link" href="/data-pembimbing">
        <i class="fas fa-fw fa-chalkboard-teacher"></i>
        <span>Data Pembimbing</span></a>
</li>
<li class="nav-item {{Request::is('data-divisi') ? 'active' : ''}}">
    <a class="nav-link" href="/data-divisi">
        <i class="fas fa-fw fa-list-alt"></i>
        <span>Data Divisi</span></a>
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
    Instansi
</div>
<li class="nav-item {{Request::is('data-instansi') ? 'active' : ''}}">
    <a class="nav-link" href="/data-instansi">
        <i class="fas fa-fw fa-chalkboard-teacher"></i>
        <span>Data Instansi</span></a>
</li>
<li class="nav-item {{Request::is('data-jurusan') ? 'active' : ''}}">
    <a class="nav-link" href="/data-jurusan">
        <i class="fas fa-fw fa-list-alt"></i>
        <span>Data Jurusan</span></a>
</li>