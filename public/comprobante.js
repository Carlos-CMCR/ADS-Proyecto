const table_productos_proforma = document.getElementById("table_productos_proforma")

if(table_productos_proforma){
    let idproforma = table_productos_proforma.dataset.idproforma
    table_productos_proforma.addEventListener("click", (event) => {
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
                    form.append("idproforma", idproforma)
                    form.append("idproducto", idproducto)
                    form.append("btnQuitarProducto","")
                    const response = await fetch('../moduloVentas/getComprobantePago.php',{
                        method: 'POST',
                        body: form
                    })
                    const data = await response.json()
                    console.log("🚀 ~ file: comprobante.js ~ line 32 ~ document.querySelector ~ data", data)
                }
            })
        }
    })
}