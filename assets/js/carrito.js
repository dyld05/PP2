function mostrarCarrito() {
    const carritoPopUp = document.getElementById('carrito-popup');
    carritoPopUp.style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function() {
    let carrito = [];
    let totalCarrito = 0;

    function ocultarCarrito() {
        const carritoPopUp = document.getElementById('carrito-popup');
        carritoPopUp.style.display = 'none';
    }

    function actualizarCarrito() {
        const listaCarrito = document.getElementById('lista-carrito');
        listaCarrito.innerHTML = '';

        carrito.forEach((producto) => {
            const listItem = document.createElement('li');
            listItem.innerHTML = `
                <div class="producto-carrito">
                    <h3>${producto.nombre}</h3>
                    <img src="../../../PP2/assets/img/${producto.imagen}" alt="${producto.nombre}">
                    <p>$${producto.precio.toFixed(2)}</p>
                    <p>${producto.descripcion}</p>
                    <div class="controles-cantidad">
                        <button style="background-color: #EB5E28" class="cardButton menos" data-product-id="${producto.id}">-</button>
                        <div class="cantidad">${producto.cantidad !== undefined ? producto.cantidad : 1}</div>
                        <button style="background-color: #EB5E28" class="cardButton mas" data-product-id="${producto.id}">+</button>
                    </div>
                </div>
            `;
            listaCarrito.appendChild(listItem);
        });

        const totalCarritoElement = document.getElementById('total-carrito');
        totalCarritoElement.textContent = totalCarrito.toFixed(2);
    }

    function cambiarCantidad(idProducto, cambio) {
        console.log('Entrando a cambiarCantidad con id:', idProducto, 'y cambio:', cambio);
        const producto = carrito.find((p) => p.id === idProducto);

        if (producto) {
            producto.cantidad += cambio;

            if (producto.cantidad <= 0) {
                const productoIndex = carrito.indexOf(producto);
                carrito.splice(productoIndex, 1);
            }

            totalCarrito += producto.precio * cambio;

            const cantidadCarritoElement = document.getElementById('cantidad-carrito');
            cantidadCarritoElement.textContent = carrito.reduce((total, producto) => total + producto.cantidad, 0);
            
            actualizarCarrito();
        }
    }

    function agregarAlCarrito(id, nombre, descripcion, precio, imagen) {
        const productoExistente = carrito.find((p) => p.id === id);

            if (productoExistente) {
                productoExistente.cantidad += 1;
            } else {
            const producto = {
                id: id,
                nombre: nombre,
                descripcion: descripcion,
                precio: precio,
                imagen: imagen,
                cantidad: 1
            };

            carrito.push(producto);
        }

        totalCarrito += precio;

        const cantidadCarritoElement = document.getElementById('cantidad-carrito');
        cantidadCarritoElement.textContent = carrito.reduce((total, producto) => total + producto.cantidad, 0);

        mostrarCarrito();
        actualizarCarrito();
    }

    document.getElementById('lista-carrito').addEventListener('click', (event) => {
        console.log('Clic en lista-carrito'); 
        const target = event.target;
        if (target.classList.contains('menos')) {
            const id = parseInt(target.dataset.productId);
            cambiarCantidad(id, -1);
        } else if (target.classList.contains('mas')) {
            const id = parseInt(target.dataset.productId);
            cambiarCantidad(id, 1);
        }
    });

    document.querySelectorAll('.btnAgregarCarrito').forEach((btn) => {
        btn.addEventListener('click', () => {
            const id = parseInt(btn.getAttribute('data-product-id'));
            const nombre = btn.getAttribute('data-nombre');
            const descripcion = btn.getAttribute('data-descripcion');
            const precio = parseFloat(btn.getAttribute('data-precio'));
            const imagen = btn.getAttribute('data-imagen');

            agregarAlCarrito(id, nombre, descripcion, precio, imagen);
            mostrarCarrito();
        });
    });

    document.getElementById('cerrar-carrito').addEventListener('click', function() {
        ocultarCarrito();
    });

    document.getElementById('carrito-popup').addEventListener('click', (event) => {
        event.stopPropagation();
    });
});