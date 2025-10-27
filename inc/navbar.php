<aside class="sidebar-nav-wrapper">
  <div class="navbar-logo">
    <a href="bienvenidos">
      <h3 class="mb-2">T A L L E R</h3>
      <h5 class="mb-2"></h5>
    </a>
  </div>
  <nav class="sidebar-nav">
    <ul>
      <span class="divider">
        <hr>
      </span>
      <li class="nav-item nav-item-has-children" id="serviciosMain">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#7" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="icon">
            <i class="lni lni-cart"></i>
          </span>
          <span class="text">SERVICIOS</span>
        </a>
        <ul id="7" class="collapse dropdown-nav">
          <li>
            <a href="servicios" id="serviciosReg">
              <strong>REGISTRAR SERVICIO</strong>
            </a>
          </li>
          <li class="nav-item nav-item-has-children" id="serviciosReportMain">
            <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#6" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="text">REPORTES</span>
            </a>
            <ul id="6" class="collapse dropdown-nav">
              <li>
                <a href="serviciosReportRealizados" id="serviciosReportRealizados">
                  Servicios Realizados
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <span class="divider">
        <hr>
      </span>
      <li class="nav-item nav-item-has-children" id="inventarioMain">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#5" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="icon">
            <i class="lni lni-library"></i>
          </span>
          <span class="text">INVENTARIO / SERVICIOS</span>
        </a>
        <ul id="5" class="collapse dropdown-nav">
          <li>
            <a href="inventarioRegistrar" id="inventarioReg">
              Registrar Producto / Servicio
            </a>
          </li>
          <li>
            <a href="inventarioServiciosLista" id="inventarioServiciosList">
              Lista de Servicios
            </a>
          </li>
          <li>
            <a href="inventarioLista" id="inventarioList">
              Lista de Inventario
            </a>
          </li>
          <li class="nav-item nav-item-has-children" id="inventarioReportMain">
            <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#4" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="text">REPORTES</span>
            </a>
            <ul id="4" class="collapse dropdown-nav">
              <li>
                <a href="inventarioReportMoviminentos" id="inventarioReportMov">
                  Movimiento de Inventario
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <span class="divider">
        <hr>
      </span>
      <li class="nav-item nav-item-has-children" id="vehiculosMain">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#3" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="icon">
            <i class="lni lni-book"></i>
          </span>
          <span class="text">VEHICULOS</span>
        </a>
        <ul id="3" class="collapse dropdown-nav">
          <li>
            <a href="vehiculosRegistrar" id="vehiculosReg">
              Registrar Vehiculo
            </a>
          </li>
          <li>
            <a href="vehiculosLista" id="vehiculosList">
              Lista de Vehiculos
            </a>
          </li>
        </ul>
      </li>
      <span class="divider">
        <hr>
      </span>
      <li class="nav-item nav-item-has-children" id="administracionMain">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#2" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="icon">
            <i class="lni lni-calculator"></i>
          </span>
          <span class="text">ADMINISTRACION</span>
        </a>
        <ul id="2" class="collapse dropdown-nav">
          <li>
            <a href="enteRegistrar" id="enteRegistrar">
              Registrar Centro de Costo
            </a>
          </li>
        </ul>
      </li>
      <span class="divider">
        <hr>
      </span>
      <li class="nav-item nav-item-has-children" id="usuariosMain">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#0" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="icon">
            <i class="lni lni-users"></i>
          </span>
          <span class="text">USUARIOS</span>
        </a>
        <ul id="0" class="collapse dropdown-nav">
          <li>
            <a href="usuariosRegistrar" id="usuariosReg">
              Registrar Usuario
            </a>
          </li>
          <li>
            <a href="usuariosLista" id="usuariosList">
              Lista de Usuarios
            </a>
          </li>
        </ul>
      </li>
      <span class="divider">
        <hr />
      </span>
    </ul>
  </nav>
</aside>
<div class="overlay">
</div>
<main class="main-wrapper">
  <header class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-6">
          <div class="header-left d-flex align-items-center">
            <div class="menu-toggle-btn mr-20">
              <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                <i class="lni lni-chevron-left me-2"></i> Menu
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-md-7 col-6">
          <div class="header-right">
            <div class="profile-box ml-15">
              <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                data-bs-toggle="dropdown" aria-expanded="false">
                <div class="profile-info">
                  <div class="info">
                    <h6><?= $_SESSION['systemTaller']['nombreUsuario']; ?></h6>
                  </div>
                </div>
                <i class="lni lni-chevron-down"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                <li>
                  <a href="miPerfil">
                    <i class="lni lni-dollar"></i>
                    <?= number_format($_SESSION['systemTaller']['tasaRefUSD'], 4, ',', '.'); ?>
                  </a>
                </li>
                <li>
                  <a href="miPerfil">
                    <i class="lni lni-user"></i>
                    Mi Perfil
                  </a>
                </li>
                <li>
                  <a href="#0" id="btnCerrarSesion">
                    <i class="lni lni-exit"></i>
                    Cerrar Sesion
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>