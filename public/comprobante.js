const table_productos_lista = document.getElementById("table_productos_lista")
const container_servicios = document.getElementById("container-servicios")

if(table_productos_lista){
    table_productos_lista.addEventListener("click", async (event) => {
        event.preventDefault();
        const target = event.target
        if(target.closest('button') != undefined){
            let idproducto = target.closest('button').dataset.idproducto

            let nombreProducto = target.closest('button').parentNode.nextElementSibling.innerText
            document.getElementById('modal-nombre_producto').innerText = nombreProducto
            document.querySelector('.modal-bg').classList.add('modal-bg--active');
            document.querySelector('.modal').addEventListener('click', async (event) => {
                event.preventDefault();
                const targetModal = event.target
                if(targetModal.closest('.modal__action--cancelar') != undefined){
                    document.querySelector('.modal-bg').classList.remove('modal-bg--active');
                }
                if(targetModal.closest('.modal__action--continuar') != undefined){
                    document.querySelector('.modal-bg').classList.remove('modal-bg--active');
                    target.closest('button').parentNode.parentNode.remove()
                    const form = new FormData()
                    form.append("idproducto", idproducto)
                    form.append("btnQuitarProducto","")
                    // const response = await fetch('../moduloVentas/getComprobantePago.php',{
                    //     method: 'POST',
                    //     body: form
                    // })
                    const data = await response.json()
                    console.log("🚀 ~ file: comprobante.js ~ line 32 ~ document.querySelector ~ data", data)
                }
            })
        }
        if(target.closest('.input-counter') != undefined){
            let idproducto = target.closest('.input-counter').dataset.idproducto
            let value = target.closest('.input-counter').value
            const form = new FormData()
            form.append("idproducto", idproducto)
            form.append("cantidad", value)
            form.append("btnCounterProducto", "")
            await fetch("getComprobantePago.php",{
                method: 'POST',
                body: form
            });
            [ ...document.querySelectorAll('.input-result') ].forEach(element => {
                let precioUnitario = parseFloat(element.parentNode.previousElementSibling.previousElementSibling.firstElementChild.value)
                let cantidad = parseFloat(element.parentNode.previousElementSibling.firstElementChild.value).toFixed(2)
                element.value = parseFloat(precioUnitario*cantidad).toFixed(2);
            });
        }
    })
}
if(container_servicios){
    container_servicios.addEventListener("change", async (event) => {
        const target = event.target.tagName("INPUT")
        if(!target) return
        console.log("cambio")
    })
}