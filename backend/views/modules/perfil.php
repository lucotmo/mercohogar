<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:ingreso");

	exit();

}

require "views/modules/header.php";
require "views/modules/navegacionStart.php";
require "views/modules/navegacionEnd.php";
//echo "<pre>". print_r($_SESSION,1),"</pre>";
?>

<div class="mainPerfil-content">
  <div class="title-content">
    <h1 class="title__titulo">Perfil</h1>
  </div>
  <div class="containerEditPerfil"></div>
  <div class="formMiembro">
    <div class="formModal-container" style="display:none;" id="formModalNuevoMiembro">
      <form class="formModal-content" method="post" enctype="multipart/form-data">
        <a class="btnCerrarFormModal" href="#" id="btnCerrarFormModalNuevoMiembro">X</a>
        <h3 class="form-titulo">Nuevo Miembro</h3>
        <div class="inpText-content">
          <label for="usuario" class="labelText">Usuario</label>
          <input type="text" class="inpText" name="usuario" id="usuario" placeholder="Usuario">
        </div>
        <div class="inpText-content">
          <label for="pass" class="labelText">Contraseña</label>
          <input type="password" class="inpText" name="pass" id="pass" placeholder="Contraseña">
        </div>
        <div class="inpText-content">
          <input type="file" class="inpText" name="nuevaImagen" >
        </div>
        <div class="inpSelect-content">
          <select type="text" class="inpSelect" name="perfil">
            <option value="">Perfil</option>
            <option value="0">Administrador</option>
            <option value="1">Editor</option>
          </select>
        </div>
        <div class="inpSelect-content">
          <select type="text" class="inpSelect" name="ciudad">
            <option value="">Ciudad</option>
            <option value="1">Bucaramanga</option>
            <option value="2">Bogota</option>
          </select>
        </div>
        <div class="inpText-content">
          <label for="emailNuevo" class="labelText">Email</label>
          <input type="email" class="inpText" name="emailNuevo" id="emailNuevo" placeholder="Email">
        </div>
        <div class="inpSubmit-content">
          <input type="submit" class="inpSubmit" value="Guardar">
        </div>
      </form>
    </div>

    <div class="formModal-container" style="display:none;" id="formModalEditarMiembro">
      <form class="formModal-content" method="post" enctype="multipart/form-data">
        <a class="btnCerrarFormModal" href="#" id="btnCerrarFormModalEditarMiembro">X</a>
        <h3 class="form-titulo">Editar Perfil</h3>
        <input name="idPerfil" type="hidden" value="<?php echo $_SESSION["perfil_id"];?>">
        <input name="actualizarSesion" type="hidden" value="ok">
        <div class="inpText-content">
          <label for="editarUsuario" class="labelText">Usuario</label>
          <input type="text" class="inpText" name="editarUsuario" value="<?php echo $_SESSION["usuario"];?>" id="editarUsuario" placeholder="Usuario">
        </div>
        <div class="inpText-content">
          <label for="editarPassword" class="labelText">Contraseña</label>
          <input type="password" class="inpText" name="editarPassword" id="editarPassword" placeholder="Contraseña">
        </div>
        <div class="inpText-content">
          <img src="<?php echo $_SESSION["photo"]; ?>" width="20%" class="img-circle">
          <input type="hidden" value="<?php echo $_SESSION["photo"]; ?>" name="cargadoImagen">
          <input type="file" name="updateImagen" value="<?php echo $_SESSION["photo"]; ?>" class="btn btn-default" id="cambiarFotoPerfil" style="display:inline-block; margin:10px 0">
        </div>
        <div class="inpSelect-content">
          <select type="text" class="inpSelect" name="editarPerfil">
            <option value="">Perfil</option>
            <option <?php echo ($_SESSION['rol'] == '0' ? 'selected' : '') ?> value="0">Administrador</option>
            <option <?php echo ($_SESSION['rol'] == '1' ? 'selected' : '') ?> value="1">Editor</option>
          </select>
        </div>
        <div class="inpSelect-content">
          <select type="text" class="inpSelect" name="editarCiudad">
            <option value="">Ciudad</option>
            <option <?php echo ($_SESSION['id_ciudad'] == '1' ? 'selected' : '') ?>  value="1">Bucaramanga</option>
            <option <?php echo ($_SESSION['id_ciudad'] == '2' ? 'selected' : '') ?> value="2">Bogota</option>
          </select>
        </div>
        <div class="inpText-content">
          <label for="editarEmailNuevo" class="labelText">Email</label>
          <input type="email" value="<?php echo $_SESSION['email'] ?>" class="inpText" name="editarEmailNuevo" id="editarEmailNuevo" placeholder="Email">
        </div>
        <div class="inpSubmit-content">
          <input type="submit" class="inpSubmit" value="Guardar">
        </div>
      </form>
    </div>

    <div class="formModal-container" style="display:none;" id="formModalNuevoAfiliado">
      <form class="formModal-content" method="post">
        <a class="btnCerrarFormModal" href="#" id="btnCerrarFormModalNuevoAfiliado">X</a>
        <h3 class="form-titulo">Nuevo Afiliado</h3>
        <div class="inpText-content">
          <label for="celularAfiliadoNuevo" class="labelText">Celular</label>
          <input type="text" class="inpText" name="celularAfiliadoNuevo" id="celularAfiliadoNuevo" placeholder="Celular">
        </div>
        <div class="inpText-content">
          <label for="nombreAfiliadoNuevo" class="labelText">Nombre</label>
          <input type="text" class="inpText" name="nombreAfiliadoNuevo" id="nombreAfiliadoNuevo" placeholder="Nombre">
        </div>
        <div class="inpText-content">
          <label for="apellidosAfiliadoNuevo" class="labelText">Apellidos</label>
          <input type="text" class="inpText" name="apellidosAfiliadoNuevo" id="apellidosAfiliadoNuevo" placeholder="Nombre">
        </div>
        <div class="inpText-content">
          <label for="passAfiliadoNuevo" class="labelText">Contraseña</label>
          <input type="password" class="inpText" name="passAfiliadoNuevo" id="passAfiliadoNuevo" placeholder="Contraseña">
        </div>
        <div class="inpSubmit-content">
          <input type="submit" class="inpSubmit" value="Guardar">
        </div>
      </form>
    </div>
  </div>
  <?php
    $verPerfiles = new GestorPerfiles();
    $verPerfiles -> guardarPerfilController();
  ?>
  <?php
    $verAfiliados = new GestorAfiliados();
    $verAfiliados -> guardarAfiliadoController();
  ?>



  <div class="perfil-container">
    <div class="perfil-content">
      <nav class="bienvenidaPerfil-content">
        <div class="saludoPerfil">
          <a href="#" class="fa fa-edit btn__perfilDatos" id="btnEditarNuevoMiembro"></a>
          <span class="holaPerfil">Hola <?php echo $_SESSION["usuario"]; ?></span>
        </div>
        <img src="<?php echo $_SESSION["photo"]; ?>" class="img-circle">
      </nav>
      <div class="perfilDatos-content">
        <span class="perfilDatos__perfil">Rol:
          <p>
            <?php
            if( $_SESSION["rol"] == 0){
              echo "Administrador";
            }
            else{
              echo "Editor";
            }
            ?>
          </p>
        </span>
        <span class="perfilDatos__Email">Email: <p><?php echo $_SESSION["email"]; ?></p></span>
        <span class="perfilDatos__Contraseña">Contraseña: <p>*******</p></span>
      </div>
    </div>
    <div class="perfiles-container">
      <button href="" class="btnRegistrarMiembros" id="btnRegistrarNuevoMiembro">Registrar nuevo miembro</button>
      <div class="perfiles-content">
        <table class="responsive-table">
          <tr>
            <th>Usuario</th>
            <th>Pefil</th>
            <th>Email</th>
            <th>Acciones</th>
            <th></th>
          </tr>
          <?php
            $verPerfiles = new GestorPerfiles();
            $verPerfiles -> verPerfilesController();
            $verPerfiles -> editarPerfilController();
            $verPerfiles -> borrarPerfilController();
          ?>
        </table>

      </div>
    </div>
  </div>
  <div class="title-content">
    <h1 class="title__titulo">Afiliados</h1>
  </div>
  <div class="btnAgregar-content">
    <button class="btnAgregar" id="btnRegistrarNuevoAfiliado">Nuevo afiliado</button>
  </div>
  <div class="afiliados-container">
    <div class="afiliados-content">
      <table class="responsive-table">
        <tr>
          <th>Afiliado</th>
          <th>Celular</th>
          <th>Pagado</th>
          <th>Adeudo</th>
          <th>Acciones</th>
          <th></th>
        </tr>
        <?php
          $verAfiliados = new GestorAfiliados();
          $verAfiliados -> verAfiliadoController();
          $verAfiliados -> borrarAfiliadoController();
          ?>
      </table>
    </div>
  </div>

  <div class="title-content">
    <h1 class="title__titulo">Clientes</h1>
  </div>
  <div class="afiliados-container">
    <div class="afiliados-container" >
      <div class="afiliados-content" id="clientes-content">
        <table class="responsive-table">
          <tr>
            <th>Celular</th>
            <th>Cliente</th>
            <th>No. Ventas</th>
            <th>Acciones</th>
            <th></th>
          </tr>
          <?php
            $verClientes = new GestorClientes();
            $verClientes -> verClientesController();
            ?>
        </table>

      </div>
    </div>
  </div>
</div>

<div class="respuestaAfiliados"></div>
<div class="respuestaClientes"></div>
<div class="respuestaEnvioForm"></div>