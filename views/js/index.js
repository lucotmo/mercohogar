// filtrar botones



(function(e){
  const filterBtn =  document.querySelectorAll('.categorias__items');
  filterBtn.forEach( (btn) => {
    btn.addEventListener('click', (e) => {
    e.preventDefault();
    const value = e.target.dataset.filter;

    const items = document.querySelector('.productos').querySelectorAll('.product-container');

    items.forEach( (item) =>{
      if ( value === 'all' ){
        item.style.display = 'block';
      }else{
        if ( item.classList.contains(value) ){
          item.style.display = 'block';
        }else{
          item.style.display = 'none';
        }
      }
    })
    })
  })
})();


// search input

(function(){
  const search = document.getElementById('search-item');
  search.addEventListener('keyup', function(){
    let value = search.value.toLowerCase().trim();
    const items = document.querySelector('.productos').querySelectorAll('.product-container');
    items.forEach( (item) => {
      let type = item.dataset.item;
      let length = value.length;

      let match = type.slice(0, length);

      if ( value === match ){
        item.style.display = 'block';
      }
      else{
        item.style.display = 'none';
      }
    })
  })
})();




(function(){
  const Pedido = document.getElementById('pedido');
  const cartBtnRightProductos = document.querySelector('.productos').querySelectorAll('.product-container')
  const Products = JSON.parse(localStorage.getItem("pedido")) || [];


  if ( Products.length == 0 ){
    document.querySelector('.contenedor-total-pedido').style.display = "none"
    document.querySelector('.banner__promos').style.display = "block"
  }else{
    document.querySelector('.contenedor-total-pedido').style.display = "block"
    document.querySelector('.banner__promos').style.display = "none"
  }


  if (Products.length > 0){
    Products.forEach( function(product) {
      renderProduct(product)
      renderInputProduct(product)
      renderInput(product)
      //console.log(1)
      precioTotalPedido()
    })
  }


  cartBtnRightProductos.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault();
      let padre = e.target.parentElement.parentElement.parentElement,
        idProduct = padre.querySelector('input').id,
        imgProduct = padre.querySelector('img').src,
        tituloProduct = padre.querySelector('.product__title').textContent,
        medidaProduct = padre.querySelector('.product__medida').textContent,
        valorProduct = padre.querySelector('.product__valor-actual').textContent,
        cantidadProduct = padre.querySelector('input').value

        
      if ( e.target.className === 'icon-r fa fa-plus' ){
        let i = e.target.parentElement.querySelector('input').value;
        if ( i >= 0 ){
          e.target.parentElement.querySelector('input').value = parseInt(i) + parseInt(1)
          if ( e.target.parentElement.querySelector('input').value >= 2 ){
            let cantidadProduct = parseInt(padre.querySelector('input').value);
            let totalPrecioProduct = cantidadProduct * parseInt(valorProduct);
            let newProduct = {
              id: idProduct,
              imagen: imgProduct,
              tituloProduct: tituloProduct,
              medidaProduct: medidaProduct,
              valorProduct: valorProduct,
              cantidad: cantidadProduct,
              totalPrecio: totalPrecioProduct
            };
            let Products = JSON.parse(localStorage.getItem("pedido")) || [],
              numb = padre.querySelector('input').id
              _idProduct = Products.findIndex( el => el.id === numb)

            Products[_idProduct].id = idProduct
            Products[_idProduct].cantidad = cantidadProduct
            Products[_idProduct].totalPrecio = totalPrecioProduct
            localStorage.setItem("pedido", JSON.stringify(Products))
            /* e.target.blur */

            updateProduct( newProduct )
            updateInputProduct(newProduct)
            //console.log(2)
            precioTotalPedido()
            //renderInput(newProduct)

          }

          if ( e.target.parentElement.querySelector('input').value == 1 ){
            let cantidadProduct = parseInt(padre.querySelector('input').value);
            let totalPrecioProduct = cantidadProduct * parseInt(valorProduct);
            let newProduct = {
              id: idProduct,
              imagen: imgProduct,
              tituloProduct: tituloProduct,
              medidaProduct: medidaProduct,
              valorProduct: valorProduct,
              cantidad: cantidadProduct,
              totalPrecio: totalPrecioProduct
            }
            let Products = JSON.parse(localStorage.getItem("pedido")) || [];
            Products.push( newProduct )
            localStorage.setItem("pedido", JSON.stringify(Products));
            renderProduct( newProduct )
            renderInputProduct(newProduct)
            renderInput(newProduct)
            //console.log(3)
            precioTotalPedido()
            if ( Products.length > 0 ){
              document.querySelector('.contenedor-total-pedido').style.display = "block"
              document.querySelector('.banner__promos').style.display = "none"
            }
          }

        }
      }
      if ( e.target.className === 'icon-l fa fa-minus' ){
    	  console.log("eliminar el panel central")
        let i = e.target.parentElement.querySelector('input').value;
        if ( i > 0 ){
          e.target.parentElement.querySelector('input').value = parseInt(i) - parseInt(1)
          if ( e.target.parentElement.querySelector('input').value > 0 ){
            let cantidadProduct = parseInt(padre.querySelector('input').value);
            let totalPrecioProduct = cantidadProduct * parseInt(valorProduct);
            let newProduct = {
              id: idProduct,
              imagen: imgProduct,
              tituloProduct: tituloProduct,
              medidaProduct: medidaProduct,
              valorProduct: valorProduct,
              cantidad: cantidadProduct,
              totalPrecio: totalPrecioProduct
            };
            let Products = JSON.parse(localStorage.getItem("pedido")) || [],
              numb = padre.querySelector('input').id
              _idProduct = Products.findIndex( el => el.id === numb)

            Products[_idProduct].id = idProduct
            Products[_idProduct].cantidad = parseInt(cantidadProduct)
            Products[_idProduct].totalPrecio = totalPrecioProduct
            localStorage.setItem("pedido", JSON.stringify(Products))
            /* e.target.blur */

            updateProduct( newProduct )
            updateInputProduct(newProduct)
            //console.log(4)
            precioTotalPedido()
          }
          
          if(e.target.parentElement.querySelector('input').value == 0) {
        	  let cantidadProduct = padre.querySelector('input').id;
              let pedido = document.getElementById('pedido');
              let all_input = pedido.querySelectorAll('.product-content input');
              
              let parent = null;
              for (let input in all_input) {
            	  if(all_input[input].id === cantidadProduct) {
            		  parent= all_input[input];
            		  break;
            	  }
              }
              parent.parentNode.parentElement.parentElement.remove();
              
        	  let Products = JSON.parse(localStorage.getItem("pedido")) || [],
              _idProduct = Products.findIndex( el => el.id === cantidadProduct);
        	  Products.splice(_idProduct, 1);
        	  localStorage.setItem("pedido", JSON.stringify(Products))
        	  precioTotalPedido()
        	  
        	  if ( Products.length == 0 ){
                  document.querySelector('.contenedor-total-pedido').style.display = "none"
                  document.querySelector('.banner__promos').style.display = "block"
        	  }
          }
        }
      }

    })
  })



  function renderInput(product){
    let templatePadreInput = `
      <a class="icon-l fa fa-minus"></a>
      <input type="text" size="1" value="${product.cantidad}" id="${product.id}"></input>
      <a class="icon-r fa fa-plus"></a>
      `

    let inp = Array.from(document.querySelector('.productos').querySelectorAll('input')).filter(el => el.id === product.id)[0];
    let padreInput = inp.parentElement;
    padreInput.innerHTML = templatePadreInput
    //console.log(inp.parentElement)

  };

  function renderProduct(product){
    let templateProduct = `
        <li class="product-content" >
          <a class="product__img-oferta" href="">
            <img src="${product.imagen}" alt="">
          </a>
          <span class="product__title"> ${product.tituloProduct} </span>
          <span class="product__medida"> ${product.medidaProduct} </span>
          <span class="product__valor-actual" style="display: none;">${product.valorProduct}</span>
          <div class="product__cantidad">
            <div class="form-cantidad">
              <a class="icon-l fa fa-minus"></a>
              <input type="text" size="1" value="${product.cantidad}" id="${product.id}"></input>
              <a class="icon-r fa fa-plus"></a>
            </div>
          </div>
          <span class="precio__final">${product.totalPrecio}</span>
        </li>
      `
    Pedido.insertAdjacentHTML('beforeend', templateProduct)

  }

  function renderInputProduct(product){
    let templateProduct = `
        <div id="contentInputProduct">
          <input class="id_product" type="text" name="id_product[]"  value="${product.id}">
          <input class="valor_product" type="text" name="valor_product[]"  value="${product.valorProduct}">
          <input class="cantidad_product" type="text" name="cantidad_product[]"  value="${product.cantidad}">
          <input class="precio_total" type="text" name="precio_total[]"  value="${product.totalPrecio}">
        </div>
      `
    let inpProduct = document.querySelector('.list-pedido-envio')
    inpProduct.insertAdjacentHTML('beforeend', templateProduct)

  }

  function updateProduct(product){
    let templateProduct = `
      <a class="product__img-oferta" href="">
        <img src="${product.imagen}" alt="">
      </a>
      <span class="product__title"> ${product.tituloProduct} </span>
      <span class="product__medida"> ${product.medidaProduct} </span>
      <span class="product__valor-actual" style="display: none;">${product.valorProduct}</span>
      <div class="product__cantidad">
        <div class="form-cantidad">
          <a class="icon-l fa fa-minus"></a>
          <input type="text" size="1" value="${product.cantidad}" id="${product.id}"></input>
          <a class="icon-r fa fa-plus"></a>
        </div>
      </div>
      <span class="precio__final">${product.totalPrecio}</span>
    `
    let inp = Array.from(pedido.querySelectorAll('input')).filter(el => el.id === product.id)[0];
    let padre = inp.parentElement.parentElement.parentElement
    padre.innerHTML = templateProduct

  }

  function updateInputProduct(product){
    let templateProduct = `
        <input class="id_product" type="text" name="id_product[]"  value="${product.id}">
        <input class="valor_product" type="text" name="valor_product[]"  value="${product.valorProduct}">
        <input class="cantidad_product" type="text" name="cantidad_product[]"  value="${product.cantidad}">
        <input class="precio_total" type="text" name="precio_total[]"  value="${product.totalPrecio}">
      `
    let inp = Array.from(document.querySelector('.list-pedido-envio').querySelectorAll('.id_product')).filter(el => el.value === product.id)[0]
    let padre = inp.parentElement
    padre.innerHTML = templateProduct

  }

  const pedi = document.getElementById('pedido');
  pedi.addEventListener('click', e =>{
    let padre = e.target.parentElement.parentElement.parentElement,
      idProduct = padre.querySelector('input').id,
      imgProduct = padre.querySelector('img').src,
      tituloProduct = padre.querySelector('.product__title').textContent,
      medidaProduct = padre.querySelector('.product__medida').textContent,
      valorProduct = padre.querySelector('.product__valor-actual').textContent
    if ( e.target.className === 'icon-r fa fa-plus' ){
      let i = e.target.parentElement.querySelector('input').value;
      if ( i > 0 ){
        e.target.parentElement.querySelector('input').value = parseInt(i) + parseInt(1)
        if ( e.target.parentElement.querySelector('input').value > 0 ){
          let cantidadProduct = parseInt(padre.querySelector('input').value);
          let totalPrecioProduct = cantidadProduct * parseInt(valorProduct);
          let newProduct = {
            id: idProduct,
            imagen: imgProduct,
            tituloProduct: tituloProduct,
            medidaProduct: medidaProduct,
            valorProduct: valorProduct,
            cantidad: cantidadProduct,
            totalPrecio: totalPrecioProduct
          };
          let Products = JSON.parse(localStorage.getItem("pedido")) || [],
            numb = padre.querySelector('input').id
            _idProduct = Products.findIndex( el => el.id === numb)

          Products[_idProduct].id = idProduct
          Products[_idProduct].cantidad = parseInt(cantidadProduct)
          Products[_idProduct].totalPrecio = totalPrecioProduct
          localStorage.setItem("pedido", JSON.stringify(Products))

          updateProduct( newProduct )
          updateInputProduct(newProduct)
          renderInput(newProduct)
          //console.log(5)
          precioTotalPedido()

        }
      }

    }
    if ( e.target.className === 'icon-l fa fa-minus' ){
      let i = e.target.parentElement.querySelector('input').value;
      if ( i > 0 ){
    	  /*var a = [1, 2, 3, 4];
    	  console.log(a)
    	  a.splice(-1 ,1);
    	  console.log(a)
    	  return false;*/
        e.target.parentElement.querySelector('input').value = parseInt(i) - parseInt(1)
        //console.log(e.target.parentElement.querySelector('input').value)
        
        if ( e.target.parentElement.querySelector('input').value == 0 ){
          let Products = JSON.parse(localStorage.getItem("pedido")) || [];
          //console.log(Products);
          //console.log(e)
          //console.log(e.target)
          //console.log(e.target.dataset.id)
          //console.log(e.target.nextElementSibling.id)
          //return false;
          //let toRemove =  Products.findIndex( product => product.id.toString() === e.target.dataset.id );
          let toRemove =  Products.findIndex( product => product.id.toString() === e.target.nextElementSibling.id );
          //console.log( toRemove );
          let hermano = e.target.nextElementSibling.id;
          //console.log(hermano);
          let elem = Products.filter(el => el.id === hermano)[0].id;
          //console.log(elem)
          //return false;
          let inp = Array.from(document.querySelector('.productos').querySelectorAll('input')).filter(el => el.id === elem)[0];
          let inp2 = Array.from(document.querySelector('.list-pedido-envio').querySelectorAll('.id_product')).filter(el => el.value === elem)[0];
          
          Products.splice(toRemove ,1)
          localStorage.setItem("pedido", JSON.stringify(Products))
          Products.forEach( function(product) {
            renderInput(product)
            //console.log(6)
            precioTotalPedido()
          })
          //console.log(Products)
          e.target.parentElement.parentElement.parentElement.remove()
          inp.value = 0
          inp2.parentElement.innerHTML = ''
        	  console.log(7)
          precioTotalPedido()
          if ( Products.length == 0 ){
            document.querySelector('.contenedor-total-pedido').style.display = "none"
            document.querySelector('.banner__promos').style.display = "block"
          }
        }

        if ( e.target.parentElement.querySelector('input').value > 0 ){
          let cantidadProduct = parseInt(padre.querySelector('input').value);
          let totalPrecioProduct = cantidadProduct * parseInt(valorProduct);
          let newProduct = {
            id: idProduct,
            imagen: imgProduct,
            tituloProduct: tituloProduct,
            medidaProduct: medidaProduct,
            valorProduct: valorProduct,
            cantidad: cantidadProduct,
            totalPrecio: totalPrecioProduct
          };
          let Products = JSON.parse(localStorage.getItem("pedido")) || [],
            numb = e.target.nextElementSibling.id
            _idProduct = Products.findIndex( el => el.id === numb)

          Products[_idProduct].id = idProduct
          Products[_idProduct].cantidad = parseInt(cantidadProduct)
          Products[_idProduct].totalPrecio = totalPrecioProduct
          localStorage.setItem("pedido", JSON.stringify(Products))
          /* e.target.blur */

          updateProduct( newProduct )
          updateInputProduct(newProduct)
          renderInput(newProduct)
          console.log(8)
          precioTotalPedido()
        }

      }

    }
  })




  function precioTotalPedido(){
    const total = [];
    //const box = document.querySelector('.precio-total__final');
    const items = document.getElementById('pedido').querySelectorAll('.precio__final');

    items.forEach(function(item){
      total.push(parseFloat(item.textContent));
    })

    const totalMoney = total.reduce(function(total, item){
      total += item;
      return total;
    },0)
    function agregarComas(numero){
      numero += '';
      x = numero.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
    }
    const finalMoney = agregarComas(totalMoney)


    document.querySelector('.precio-total__final').textContent = finalMoney
    document.querySelector('.btn-tu_pedido-movil__total').textContent = finalMoney

    //document.querySelector('.precio-total__final').textContent = totalMoney
    //document.querySelector('.prec-valor').value = finalMoney
    document.querySelector('.prec-valor').value = totalMoney
    //document.querySelector('.total-valor').value = agregarComas(totalMoney)
    
    let counterFinal= 0, 
    domiValor = parseInt(document.querySelector('.domi-valor').value);
    if ( domiValor > 0 ){
    	counterFinal = totalMoney + domiValor;
    }
    //console.log(counterFinal)
    document.querySelector('.total-valor').value = counterFinal


    /*document.addEventListener('change', function(){
      ciudadValor = document.getElementById("ciudad").value;
      domicilioT = ciudadValor;
      //document.querySelector('.domi-valor').value = agregarComas(domicilioT);
      document.querySelector('.domi-valor').value = domicilioT;
      document.querySelector('.precio-total__final').textContent = finalMoney
      //document.querySelector('.prec-valor').value = finalMoney
      //document.querySelector('.prec-valor').value = totalMoney
      //document.querySelector('.total-valor').value = agregarComas(parseInt(totalMoney) + parseInt(domicilioT))
      //document.querySelector('.total-valor').value = (parseInt(totalMoney) + parseInt(domicilioT))
    })*/

  }


})()

let buttonGenerarPedido = document.querySelector('.btn__pedir'),
  buttonCerrarPedido = document.querySelector('.close-envio'),
  valorTotalRequerido = document.querySelector('.precio-total__final').textContent > '35000',
  btnCerrarEnvio = document.querySelector('.closeRespuestaEnvio'),
  checkDireccion = document.querySelectorAll('.check')[0],
  otraDireccion = document.querySelector('.direccionDiferente__content')

if( buttonGenerarPedido ){
  buttonGenerarPedido.addEventListener('click', function(e){
    e.preventDefault()
    document.querySelector('.formularioPedido').style.display = 'flex'
  })
}

if ( buttonCerrarPedido ){
  buttonCerrarPedido.addEventListener('click', function(e){
    e.preventDefault()
    document.querySelector('.formularioPedido').style.display = 'none'
  })
}

if ( btnCerrarEnvio ){
  btnCerrarEnvio.addEventListener('click', function(e){
    e.preventDefault()
    location.reload()
  })
}

if ( checkDireccion ){
  checkDireccion.addEventListener('click', function(e){
    if ( e.target.checked === true ){
      otraDireccion.style.display = 'flex'
    }else{
      otraDireccion.style.display = 'none'
    }
  })
}


console.log('si')