// const testenovo = document.querySelectorAll('.a');
// testenovo.forEach((ativo) => {
//     botao1.addEventListener('click', () => {
//         const ativoselecionado = document.querySelector('.ativo');
//         ativoselecionado.classList.remove('on');
//         ativo.classList.add('on');
               
//     })
    
// })

const botoescarrossel = document.querySelectorAll('.botao1');
const imagens = document.querySelectorAll('.ativo');
botoescarrossel.forEach((botao1,indice) => {
   botao1.addEventListener('click', () => {
     const botaoselecionado1 = document.querySelector('.on');
     botaoselecionado1.classList.remove('on');
      botao1.classList.add('on');
     const imagemativa = document.querySelector('.onn');
     imagemativa.classList.remove('onn');
      imagens[indice].classList.add('onn');
    //   console.log(botao1);
  })
})