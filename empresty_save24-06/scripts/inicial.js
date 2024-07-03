window.onload =function (){
    login = document.getElementById('login').value
    console.log(document.getElementById('login').value);
    if (login == 1) {
        document.getElementById('aEstatisticas').style.display = 'none';
        document.getElementById('aGerenciar').style.display = 'none';
        document.getElementById('aAddCad').style.display = 'none';
        document.getElementById('Inicial').style.display = 'none';
        document.getElementById('InicialMobi').style.display = 'flex';
    }
}