<div class="formularioPedido">
  <form class="formulario">
    <a class="close-envio" href="#">x</a>
    <div class="contenidoDatosFormularioPedido">
      <div class="celCod">
        <div class="celular">
          <label for="" class="cel-title">Celular</label>
          <input type="text" name="celular" class="cel-inp" placeholder="Celular" required >
        </div>
        <div class="codigo-referido">
          <label for="" class="codRef-title">Codigo de referido (opcional)</label>
          <input type="text" name="referido" class="codRef-inp" placeholder="Referido" >
        </div>
      </div>
      <div class="nomApell">
        <div class="nombre">
          <label for="" class="nom-title">Nombre</label>
          <input type="text" name="nombre" class="nom-inp" placeholder="Nombre" required >
        </div>
        <div class="apellidos">
          <label for="" class="ape-title">Apellidos</label>
          <input type="text" name="apellidos"  class="ape-inp" placeholder="Apellidos" required >
        </div>
      </div>
      <div class="ciuBarr">
        <div class="ciudad">
          <label for="" class="ciu-title">Ciudad</label>
          <select required type="text" name="ciudad" id="ciudad" class="ciu-inp" >
            <option value="" disabled selected>Selecciona una</option>
            <?php
              $ciudades = new Ciudades();
              $ciudades -> seleccionarCiudadesController();
            ?>
          </select>
        </div>
        <div class="barrio">
          <label for="" class="bar-title">Barrio</label>
          <input type="text" name="barrio" class="bar-inp" placeholder="Barrio" required>
        </div>
      </div>
      <div class="direccion">
        <label for="" class="dir-title">Direccion</label>
        <input type="text" name="direccion" class="dir-inp" placeholder="Direccion" required>
      </div>
    </div>
    <div class="direccionDiferentes-container">
      <div class="opcionDif">
        <p for="" class="envioDif">enviar a unar direccion diferente</p>
        <input class="check" type="checkbox">
      </div>
      <div class="direccionDiferente__content">
        <div class="ciuBarr">
          <div class="ciudad2">
            <label for="" class="ciu-title">Ciudad</label>
            <select type="text" name="ciudad2" id="ciudad2" class="ciu-inp">
              <option value="" disabled selected>Selecciona una</option>
              <?php
                $ciudades = new Ciudades();
                $ciudades -> seleccionarCiudadesController();
              ?>
            </select>
          </div>
          <div class="barrio">
            <label for="" class="bar-title">Barrio</label>
            <input type="text" name="barrio2" class="bar-inp" placeholder="Barrio">
          </div>
        </div>
        <div class="direccion">
          <label for="" class="dir-title">Direccion</label>
          <input type="text" name="direccion2" class="dir-inp" placeholder="Direccion">
        </div>
      </div>
    </div>
    <h3 class="info-pe">tus datos personales se utilizaran para enviar tu pedido </h3>
    <div class="acepTerm">
      <input class="check" type="checkbox" class="terminosA" checked required><a href="" class="link__acepto">acepto termino</a>
    </div>

    <h3 class="entrega-info" >Entrega en 24 hr</h3>
    <h3 class="pago-info">pago en efectivo al momento de la entrega</h3>

    <div class="list-pedido-envio" style="display:none;"></div>

    <div class="precio-final-container">
      <div class="precioPedido-container">
        <span class="prec-text">Tu pedido $</span>
        <input type="text" name="valorPedido" class="prec-valor" name="suma-productos" value="0" required>
      </div>
      <div class="precioDomicilio-container">
        <span class="domi-text">Domicilio $</span>
        <input type="text" name="domicilio" class="domi-valor" name="domicilio" value="0" required>
      </div>
    </div>
    <div class="precioTotal-container">
      <span class="total-text">Valor Total $</span>
      <input type="text" name="valorTotal" class="total-valor" name="suma-total" value="0" required>
    </div>
    <div class="btn-envio-content">
      <input class="btn-envio-pedido" type="submit" value="Enviar pedido">
    </div>
    <div class="Response"></div>
  </form>
</div>