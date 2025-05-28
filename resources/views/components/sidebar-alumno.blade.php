<div class="sidebar" id="sidebar">
    <div class="brand">
        <img src="{{ asset('brand/CodigoIcon.jpg') }}" alt="logo">
        <span style="color: var(--color-text-primary); font-size: 1.1rem; font-weight: 600;">Alumno</span>
    </div>
    <ul class="menu">
        <li class="menu-item menu-item-static">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class='bx bx-home-alt-2'></i>
                <span>Inicio</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('alumnos.inscribir') }}" class="menu-link">
                <i class='bx bx-user-plus'></i>
                <span>Inscribirse</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('alumno.info') }}" class="menu-link">
                <i class='bx bx-id-card'></i>
                <span>Mi información</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('alumno.punteos') }}" class="menu-link">
                <i class='bx bx-list-ol'></i>
                <span>Mis punteos</span>
            </a>
        </li>
        <li class="menu-item menu-item-static">
            <a href="{{ route('alumno.cursos') }}" class="menu-link">
                <i class='bx bx-book'></i>
                <span>Lista de cursos</span>
            </a>
        </li>
    </ul>
    <div class="footer">
        <div class="user">
            <div class="user-img">
                <img src="{{ asset('user.jpg') }}" alt="user">
            </div>
            <div class="user-data">
                <span class="name">{{ Auth::user()->name }}</span>
                <span class="email">{{ Auth::user()->email }}</span>
            </div>
            <div class="user-icon">
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;">
                        <i class='bx bx-log-out' title="Cerrar sesión"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> 