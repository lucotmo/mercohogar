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



// pedido

// obtener elementos

const precioTotalPedido = document.querySelector('.precio-total__final');
//const Pedido = document.getElementById('pedido');
//const itemData = JSON.parse(localStorage.getItem("pedido")) || [];




// add product content

/* (function(){
  const cartBtnRightProductos = document.querySelector('.productos').querySelectorAll('.product-container')

  cartBtnRightProductos.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault();
      if ( e.target.className === 'icon-r fa fa-plus' ){
        let i = e.target.parentElement.querySelector('input').value;
        if ( i >= 0 ){
          e.target.parentElement.querySelector('input').value = parseInt(i) + parseInt(1)
          console.log('lucho')
          if ( e.target.parentElement.querySelector('input').value == 1 ){
            console.log('right')
            //console.log(datosLocalstorage(e))
            Products.push( newProduct )
            localStorage.setItem('pedido', JSON.stringify(itemData));
            renderProduct(newProduct)


            console.log('insertando')
            //console.log(e.target.parentElement.parentElement.parentElement)
            console.log(padre.querySelector('input').id)
          }
        }
      }
      if ( e.target.className === 'icon-l fa fa-minus' ){
        let i = e.target.parentElement.querySelector('input').value;
        if ( i > 0 ){
          e.target.parentElement.querySelector('input').value = parseInt(i) - parseInt(1)
          if ( e.target.parentElement.querySelector('input').value == 0 ){
            console.log('eliminando')
          }
        }
      }




    })
  })


  function datosLocalstorage(e){
    const padre = e.target.parentElement.parentElement.parentElement,
      idProduct = padre.querySelector('input').id,
      imgProduct = padre.querySelector('img').src,
      tituloProduct = padre.querySelector('.product__title').textContent,
      medidaProduct = padre.querySelector('.product__medida').textContent,
      valorProduct = padre.querySelector('.product__valor-actual').textContent,
      cantidadProduct = padre.querySelector('input').value,
      totalPrecioProduct = cantidadProduct * parseInt(valorProduct),
      newProduct = {
        id: idProduct,
        imagen: imgProduct,
        tituloProduct: tituloProduct,
        medidaProduct: medidaProduct,
        valorProduct: valorProduct,
        cantidad: cantidadProduct,
        totalPrecio: totalPrecioProduct
      }

  };

  function renderProduct(product){
    let templateProduct = `
        <li class="product-content" >
          <div class="id_producto" style="diplay: none;">${product.id}</div>
          <a class="product__img-oferta" href="">
            <img src="${product.imagen}" alt="">
          </a>
          <span class="product__title"> ${product.tituloProduct} </span>
          <span class="product__medida"> ${product.medidaProduct} </span>
          <div class="product__cantidad">
            <div class="form-cantidad">
              <a class="icon-l fa fa-minus"></a>
              <input type="text" size="1" value="${product.cantidadProduct}" id="${product.id}"></input>
              <a class="icon-r fa fa-plus"></a>
            </div>
          </div>
          <span class="precio__final">${product.totalPrecioProduct}</span>
        </li>
      `
    //Pedido.insertAdjacentElement('beforeend', templateProduct);
    console.log(Pedido)

  }
}); */

/* document.addEventListener('click', function(e){
  const cantidad = e.target.parentElement.querySelector('.cantidad').value;
  console.log(e.target.parentElement.querySelector('.cantidad').value)
}) */

//console.log(document.querySelector('.productos'))
//console.log(document.getElementById('pedido'))






/* (function(){
  const cartBtnRightProductos = document.querySelector('.productos').querySelectorAll('.product-container')

  cartBtnRightProductos.forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault();
      if ( e.target.className === 'icon-r fa fa-plus' ){
        let i = e.target.parentElement.querySelector('input').value;
        if ( i >= 0 ){
          e.target.parentElement.querySelector('input').value = parseInt(i) + parseInt(1)
          if ( e.target.parentElement.querySelector('input').value == 1 ){
            console.log('right')
          }
        }
      }
      if ( e.target.className === 'icon-l fa fa-minus' ){
        let i = e.target.parentElement.querySelector('input').value;
        if ( i > 0 ){
          e.target.parentElement.querySelector('input').value = parseInt(i) - parseInt(1)
          if ( e.target.parentElement.querySelector('input').value == 0 ){
            console.log('eliminando')
          }
        }
      }

    })
  })
}) */

(function( ){
  const cartBtnRightProductos = document.querySelector('.productos').querySelectorAll('.product-container')
  console.log(cartBtnRightProductos)
  /* cartBtnRightProductos.forEach(function(btn){
    btn.addEventListener('click', function(e){
      console.log(e.target)
    })
  }) */
})