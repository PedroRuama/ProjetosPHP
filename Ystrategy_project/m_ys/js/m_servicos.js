function maiuscula(string) {


    res = string.value.toUpperCase();

    string.value = res;



}

function minuscula(string) {

    min = string.value.toLowerCase();

    string.value = min;



}

function filtro_m_servicos(motorista) {
    document.getElementById("div_menu").style.display = 'none'
    document.getElementById("sair_m").style.display = 'block'
    var motorista_tr = document.getElementsByClassName("motorista_tr")
    var coluna_motorista = document.getElementsByClassName("tabela-resumo1")
  


    for(let index = 0; index < motorista_tr.length; index++){
        // console.log("for");
        const LINHA = motorista_tr[index];
        let td = 0;
        while (td < LINHA.getElementsByTagName('td').length) {
            if (LINHA.getElementsByTagName('td')[td].innerHTML.includes(motorista)) {
                LINHA.style.removeProperty("display");
                td = LINHA.getElementsByTagName('td').length
                // td = motorista_tr.getElementsByTagName('td').length
                
            } else {
                LINHA.style.display = 'none'
            }
            td++
        }
    }
    for(let index = 0; index < coluna_motorista.length; index++){
        console.log("for");
        const COLUNA_M = coluna_motorista[index];

        if (COLUNA_M.getElementsByTagName('th')[0].innerHTML.includes(motorista)) {
            COLUNA_M.style.removeProperty("display");
            //  = COLUNA_M.getElementsByTagName('td').length
            // td = motorista_tr.getElementsByTagName('td').length
            
        } else {
            COLUNA_M.style.display = 'none'
        }
        
        

    }

}