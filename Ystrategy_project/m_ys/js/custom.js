// Receber o SELETOR da janela modal
const cadastrocliente = new bootstrap.Modal(document.getElementById("cadastrocliente"));
// Receber o SELETOR do formulário cadastrar marca
const form_nomecliente = document.getElementById("form_nomecliente");
// Receber o SELETOR do botão da janela modal cadastrar marca
const inclui_nome_btn = document.getElementById("inclui_nome_btn");
var nome_cliente = document.getElementById("nome_cliente");

// Somente acessa o IF quando existir o SELETOR "cadMarcaForm"
if(form_nomecliente){

  // Aguardar o usuario clicar no botao cadastrar
  form_nomecliente.addEventListener("submit", async (e) => {
      
      // Não permitir a atualização da pagina
        e.preventDefault();
     const dadosform = new FormData(form_nomecliente);

     inclui_nome_btn.value = "Salvando...";
  
    const dados =  await  fetch("incluir_cliente.php",{
      method: "POST",
      body: dadosform
    });
    const resposta = await dados.json();
    console.log(resposta);
     var novooption = document.createElement("option")
     novooption.value = resposta['nome_cliente']
     novooption.text = resposta['nome_cliente']
     nome_cliente.appendChild(novooption);
     novooption.setAttribute("selected","selected")
    form_nomecliente.reset();
    inclui_nome_btn.value = "Incluir";
    cadastrocliente.hide();

       
  });
}