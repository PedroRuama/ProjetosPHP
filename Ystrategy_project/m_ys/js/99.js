// Receber o SELETOR da janela modal
const cadastrarMarca = new bootstrap.Modal(document.getElementById("cadastrarMarca"));
// Receber o SELETOR do formulário cadastrar marca
const cadMarcaForm = document.getElementById("cadMarcaForm");
// Receber o SELETOR do botão da janela modal cadastrar marca
const cadMarcaBtn = document.getElementById("cadMarcaBtn");
// Receber o SELETOR do formulário cadastrar marca
const msgCadMarcaErro = document.getElementById("msgCadMarcaErro");
// Receber o SELETOR da mensagem genérica
const msg = document.getElementById("msg");
// Receber o SELETOR do campo marca
var selectMarcaId = document.getElementById("selectMarcaId");

// Somente acessa o IF quando existir o SELETOR "cadMarcaForm"
if (cadMarcaForm) {

    // Aguardar o usuario clicar no botao cadastrar
    cadMarcaForm.addEventListener("submit", async (e) => {

        // Não permitir a atualização da pagina
        e.preventDefault();

        // Receber os dados do formulário
        const dadosForm = new FormData(cadMarcaForm);

        // Apresentar no botão o texto salvando
        cadMarcaBtn.value = "Salvando...";

        // Chamar o arquivo PHP responsável em salvar a marca
        const dados = await fetch("cadastrar_marca.php", {
            method: "POST",
            body: dadosForm
        });

        // Realizar a leitura dos dados retornados pelo PHP
        const resposta = await dados.json();

        // Acessa o IF quando não cadastrar com sucesso
        if (!resposta['status']) {

            // Enviar a mensagem para o HTML
            msgCadMarcaErro.innerHTML = resposta['msg'];
            msg.innerHTML = "";
        } else {

            // Cria um novo elemento <option>
            var novoOption = document.createElement("option");

            // Definir o valor do novo <option>
            novoOption.value = resposta['marca_id'];

            // Definir o texto do novo <option>
            novoOption.text = resposta['nome_marca'];

            // Definir o atributo "selected" para tornar este <option> selecionado
            novoOption.setAttribute("selected", "selected");

            // Adiciona o novo <option> ao <select>
            selectMarcaId.appendChild(novoOption);

            // Enviar a mensagem para o HTML
            msg.innerHTML = resposta['msg'];
            msgCadMarcaErro.innerHTML = "";

            // Limpar o formulário
            cadMarcaForm.reset();

            // Fechar a janela modal
            cadastrarMarca.hide();

        }

        // Apresentar no botão o texto cadastrar
        cadMarcaBtn.value = "Cadastrar";
    });
}

// Receber o SELETOR do formulário cadastrar veículo
const cadVeiculoForm = document.getElementById("cadVeiculoForm");
// Receber o SELETOR do botão cadastrar veículo
const cadVeiculoBtn = document.getElementById("cadVeiculoBtn");

// Somente acessa o IF quando existir o SELETOR "cadMarcaForm"
if (cadVeiculoForm) {

    // Aguardar o usuario clicar no botao cadastrar
    cadVeiculoForm.addEventListener("submit", async (e) => {

        // Não permitir a atualização da pagina
        e.preventDefault();

        // Receber os dados do formulário
        const dadosForm = new FormData(cadVeiculoForm);

        // Apresentar no botão o texto salvando
        cadVeiculoBtn.value = "Salvando...";

        // Chamar o arquivo PHP responsável em salvar a marca
        const dados = await fetch("cadastrar_veiculo.php", {
            method: "POST",
            body: dadosForm
        });

        // Realizar a leitura dos dados retornados pelo PHP
        const resposta = await dados.json();

        // Acessa o IF quando não cadastrar com sucesso
        if (!resposta['status']) {

            // Enviar a mensagem para o HTML
            msg.innerHTML = resposta['msg'];
        } else {

            // Enviar a mensagem para o HTML
            msg.innerHTML = resposta['msg'];

            // Limpar o formulário
            cadVeiculoForm.reset();
            selectMarcaId.value = "";

        }

        // Apresentar no botão o texto cadastrar
        cadVeiculoBtn.value = "Cadastrar";
    });
}