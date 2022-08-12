<li class="nav-item {{Request::is('dashboard') ? 'active' : ''}}">
    <a class="nav-link" href="/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<li class="nav-item {{Request::is('daily-activity*') ? 'active' : ''}}">
    <a class="nav-link" href="/daily-activity">
        <i class="fa fa-tasks"></i>
        <span>Report Harian</span></a>
</li>

<li class="nav-item {{Request::is('list-tugas*') || Request::is('task*')  ? 'active' : ''}}">
    <a class="nav-link" href="/list-tugas">
        <i class="fa fa-clipboard"></i>
        <span>Data Tugas</span></a>
</li>

<li class="nav-item {{Request::is('evaluation-result*') ? 'active' : ''}}">
    <a class="nav-link" href="/evaluation-result">
        <i class="fa fa-check-square"></i>
        <span>Nilai & Sertifikat</span></a>
</li>
