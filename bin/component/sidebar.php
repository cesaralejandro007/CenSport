<?php
use config\componentes\configSistema as configSistema;
?>
<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
          <div class="nav">
              <div class="sb-sidenav-menu-heading">Centro</div>
              <a class="nav-link" href="?pagina=<?php configSistema::_PRINCIPAL_();?>">
                  <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                  Principal
              </a>
              <div class="sb-sidenav-menu-heading">Interfaces</div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                  <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                  Secciones
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                  <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="?pagina=<?php configSistema::_Funcionarios_();?>">Funcionarios</a>
                      <a class="nav-link" href="?pagina=<?php configSistema::_Censo_();?>">Aperturar Censo</a>
                      <a class="nav-link" href="?pagina=<?php configSistema::_Deportes_();?>">Deportes</a>
                      <a class="nav-link" href="?pagina=<?php configSistema::_Grupos_();?>">Grupos Deportivos</a>
                  </nav>
              </div>
          </div>
      </div>
      <div class="sb-sidenav-footer">
      <div>Soporte: Cesar Vides</div>
      <div class="small">Telf: +58 0412-0318406</div>
      </div>
  </nav>
</div>