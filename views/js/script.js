var btnMenuContainer = document.querySelector('.btn-menu');
btnMenuContainer.addEventListener('click', function(e){
  document.querySelector('.menu-container').classList.toggle('active-menu');
  document.querySelector('.line').classList.toggle('line-animate');
})

var buttonGroup = document.querySelectorAll('.categorias__items')
var btnCategorias = document.querySelector('.caterorias__title');
var btnTuPedidoMovil = document.querySelector('.btn-tu_pedido-movil');
var btnCerrarAside = document.querySelector('.close-aside');

if ( buttonGroup ){
  buttonGroup.forEach(function(btn){
    btn.addEventListener('click', function(e){
      let hijoChequeado = Array.from(btn.parentElement.children).filter(el => el.className === 'categorias__items is-checked');
      hijoChequeado[0].classList.value = 'categorias__items'
      btn.classList.add('is-checked')
      document.querySelector('.categorias-content').classList.toggle('active-categorias')
    })
  })
}

if ( btnCategorias ){
  btnCategorias.addEventListener('click', function(e){
    document.querySelector('.categorias-content').classList.toggle('active-categorias')
  })
}

if ( btnTuPedidoMovil ){
  btnTuPedidoMovil.addEventListener('click', function(e){
    document.querySelector('.aside').classList.toggle('active-aside');
  })
}

if ( btnCerrarAside ){
  btnCerrarAside.addEventListener('click', function(e){
    document.querySelector('.aside').classList.toggle('active-aside');
  })
}


//https://vimeo.com/90791304


/* var imageBanner = document.querySelector('.banner__img-content');

function slide(){
  if ( imageLeft == '0%' ){
    imageBanner.setAttribute("style", "left:-100%;")
  }else if ( imageLeft == '-100%' ){
    imageBanner.setAttribute("style", "left:-200%;")
  }else{
    imageBanner.setAttribute("style", "left:0%;")
  }
}

console.log(setInterval(slide, 1000));
console.log(imageBanner.setAttribute("style", "left:-200%;"));




var x = 0;
console.log('lucho')
console.log(document.querySelector('.banner__img-content').style.left) */

/* export const createCustomElement = (element,attributes,children) => {
  let customElement = document.createElement(element);
  if (children !== undefined) children.forEach(el => {
    if (el.nodeType) {
      if (el.nodeType === 1 || el.nodeType === 11) customElement.appendChild(el);
    } else {
      customElement.innerHTML += el;
    }
  });
  addAttributes(customElement,attributes);
  return customElement;
};


const createVimeoModalContent = vimeoCode =>
`<div class="video">
  <iframe src="https://player.vimeo.com/video/${vimeoCode}?autoplay=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>`;

const getVimeoCode = url => url.slice('https://vimeo.com/'.length);


export const openVimeoModal = selector => {
  let linksElements = [...document.querySelectorAll(selector)],
    links = linksElements.map(link => link.href);

  linksElements.forEach((el,i) => {
    el.addEventListener('click', e => {
      e.preventDefault();
      edModal(createVimeoModalContent(getVimeoCode(links[i])));
    })
  })
}; */


const form = document.forms[0],
    respuesta = document.querySelector('.Response'),
    contentForm = document.querySelector('.formularioPedido'),
    respuestaEnvioForm = document.querySelector('.respuestaEnvio')

const mensaje_error = msg => `
  <p class="section center  red  darken-1  white-text  Messages" >
    ${msg}
  </p>
`

const mensaje_ok = msg => `
  <p class="section center  green  darken-1  white-text  Messages" >
    ${msg}
  </p>
`

const mensajeEnvio = msg => `
  <p class="section center  green  darken-1  white-text  Messages" >
    ${msg}
  </p>
`



let inpDomi = document.querySelector('.precioDomicilio-container')

document.addEventListener('change', e => {
  if (e.target.matches('#ciudad')) {
    let data = new FormData()
    data.append('ciudad_id', e.target.value)
    e.preventDefault()

    fetch('./views/pages/app.view.php', {
      body: data,
      method: 'post'
    })
      .then(res => {
        return (res.ok)
          ? res.text()
          : Promise.reject({ status: res.status, statusText: res.statusText })
      })
      .then(res => {
        inpDomi.innerHTML = `${res}`
        let valorPedido = document.querySelector('.prec-valor').value,
          domiValor = document.querySelector('.domi-valor').value
        document.querySelector('.total-valor').value = parseInt(valorPedido) + parseInt(domiValor)
      })
      .catch(err => {
        let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
        inpDomi.innerHTML = mensaje
      })
  }
  if (e.target.matches('#ciudad2')) {
    let data = new FormData()
    data.append('ciudad_id', e.target.value)
    e.preventDefault()

    fetch('./views/pages/app.view.php', {
      body: data,
      method: 'post'
    })
      .then(res => {
        return (res.ok)
          ? res.text()
          : Promise.reject({ status: res.status, statusText: res.statusText })
      })
      .then(res => {
        inpDomi.innerHTML = `${res}`
        let valorPedido = document.querySelector('.prec-valor').value,
          domiValor = document.querySelector('.domi-valor').value
        document.querySelector('.total-valor').value = parseInt(valorPedido) + parseInt(domiValor)
      })
      .catch(err => {
        let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
        inpDomi.innerHTML = mensaje
      })
  }
})

/* document.addEventListener('submit', e => {
  if (e.target.matches('form')) {
    e.preventDefault()
    alert('Enviando pedido...')

    let data = new FormData(e.target)

    fetch('models/envio.php', {
      body: data,
      method: 'post'
    })
      .then(res => {
        return (res.ok)
          ? res.json()
          : Promise.reject({ status: res.status, statusText: res.statusText })
      })
      .then(res => {
        console.log(res)
        let mensaje

        if (res.err) {
          mensaje = mensaje_error(res.msg)
        } else {
          //mensaje = mensaje_ok(res.msg)
          contentForm.style.display = "none"
          respuestaEnvioForm.style.display = "flex"

          form.reset()
          localStorage.removeItem("pedido")

        }
        //respuesta.innerHTML = mensaje
      })
      .catch(err => {
        let mensaje = mensaje_error(`Parece que hay un problema. Error ${err.status}: ${err.statusText}`)
        respuesta.innerHTML = mensaje
      })
  }
}) */

var cel_inp = document.querySelector('.cel-inp');
if( cel_inp !== null ) {
	cel_inp.addEventListener('input', function () { 
	    this.value = this.value.replace(/[^0-9]/g,'');
	});
}

var codRef_inp =  document.querySelector('.codRef-inp');
if( codRef_inp !== null ) {
	codRef_inp.addEventListener('input', function () { 
	    this.value = this.value.replace(/[^0-9]/g,'');
	});
}



var click_direccion = document.getElementById('ch_otra_direccion');
click_direccion.addEventListener('click', e => {
    var ciudad2 = document.getElementById('ciudad2'),
    barrio2 = document.getElementById('barrio2'),
    direccion2 = document.getElementById('direccion2');
	ciudad2.value="";
	barrio2.value="";
	direccion2.value="";
	
    if(e.target.checked) {
    	e.target.value=1;
    	ciudad2.required = true;
    	barrio2.required = true;
    	direccion2.required = true; 
    } else {
    	e.target.value=0;
    	ciudad2.required = false; 
    	barrio2.required = false; 
    	direccion2.required = false;
    }
});

document.addEventListener('submit', e => {
  if (e.target.matches('form')) {
    e.preventDefault()
    
    let data = new FormData(e.target)
    fetch('views/pages/app.view.php', {
      body: data,
      method: 'post'
    }).then(res => {
    	console.log(res)
        return (res.ok)
          ? res.json()
          : Promise.reject({ status: res.status, statusText: res.statusText })
      }).then(res => {
    	  //console.log(res.cliente)
    	let body = null;
        if (res.cliente) {
        	body = `<div class="respuestaEnvio-content">
      		    <a class="closeRespuestaEnvio"  onclick="location.reload()" href="javascript:;">X</a>
      		    <h1 class="respuestaEnvio__title">Parece que hay un problema</h1>
      		    <p class="respuestaEnvio__info">`+res.msg+`</p>
      		  </div>`
        } else {
        	var direccion_ ;
          if( click_direccion.checked ) {
        	  direccion_ = document.getElementById('direccion2').value;
          } else {
        	  direccion_ = document.getElementById("direccion").value;
          }
    	  body = `<div class="respuestaEnvio-content">
  		    <a class="closeRespuestaEnvio"  onclick="location.reload()" href="javascript:;">X</a>
  		    <h1 class="respuestaEnvio__title">Tu pedido fue recibido con <span>éxito</span></h1>
  		    <p class="respuestaEnvio__saludo">Hola <span>`+document.querySelector(".nom-inp").value+ ' ' +document.querySelector(".ape-inp").value+ `</span>, 
  		    tu pedido se enviara a la <span>`+direccion_+`</span></p>  
  		    <p class="respuestaEnvio__contact">Te contactaremos al <span>`+document.querySelector(".cel-inp").value+`</span>
  		        para confirmar horario de
  		        entrega del pedido!</p>
  		    <p class="respuestaEnvio__info">Recuerda que el servicio de atención es de lunes a sábado, horarios 7 a.m a 9 p.m </p>
  		  </div>`
        }
        
        contentForm.style.display = "none"
    	respuestaEnvioForm.insertAdjacentHTML('beforeend', body)
        respuestaEnvioForm.style.display = "flex"
        form.reset()
        localStorage.removeItem("pedido")
      }).catch(err => {    
    	  console.log(err)
    	let body = `<div class="respuestaEnvio-content">
  		    <a class="closeRespuestaEnvio" onclick="location.reload()" href="javascript:;">X</a>
  		    <h1 class="respuestaEnvio__title">Parece que hay un problema</h1>
  		    <p class="respuestaEnvio__info">Por favor intente más tarde.</p>
  		  </div>`
    	contentForm.style.display = "none"
        respuestaEnvioForm.insertAdjacentHTML('beforeend', body)
        respuestaEnvioForm.style.display = "flex"
        form.reset()
        localStorage.removeItem("pedido")
      })
  }
})

console.log('pro fin')
