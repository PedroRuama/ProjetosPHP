let nome_cliente_pedido = document.getElementById('nome_cliente_pedido');
nome_cliente_pedido.onchange = () =>{
  
   fetch("http://sidneyhost.ddns.net:8080/mundial/form_pedido.php?cliente=99")
      .then( response => {
        return response.text();
   })
   .then(texto =>{
    console.log(texto);
});
}