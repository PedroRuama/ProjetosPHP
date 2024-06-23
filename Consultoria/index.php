<?php

include_once('controllers/conexao.php');
include('menu.php');
$ultimosCad = mysqli_query($conexao, "SELECT * FROM beats");
// ORDER BY id DESC LIMIT 6; 



if (isset($_GET['deslog'])) {

    echo "<script>alert('Deslogado com sucesso!');</script>";
}
if (isset($_GET['logado'])) {

    echo "<script>alert('Logado com sucesso! Bem vindo(a), " . $user . "');</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultoria Financeira</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/planos.css">
    <script src="scripts/index.js"></script>
</head>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cardsContainer = document.querySelector('.cards-container');
        const navDotsContainer = document.querySelector('.nav-dots');
        let cardIndex = 0;
        const cardWidth = document.querySelector('.card').offsetWidth;
        const cardsCount = cardsContainer.children.length;

        // Create navigation dots
        for (let i = 0; i < cardsCount; i++) {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            if (i === 0) {
                dot.classList.add('active');
            }
            dot.dataset.index = i;
            navDotsContainer.appendChild(dot);

            dot.addEventListener('click', function() {
                cardIndex = i;
                updateCardsPosition();
                updateDots();
            });
        }

        function updateCardsPosition() {
            const newPosition = -cardIndex * cardWidth;
            cardsContainer.style.transform = `translateX(${newPosition}px)`;
        }

        function updateDots() {
            document.querySelectorAll('.nav-dots .dot').forEach(dot => {
                dot.classList.remove('active');
            });
            document.querySelector(`.nav-dots .dot[data-index='${cardIndex}']`).classList.add('active');
        }

        function autoNext() {
            cardIndex = (cardIndex + 1) % cardsCount;
            updateCardsPosition();
            updateDots();
        }

        setInterval(autoNext, 7000);



        const boxes = document.querySelectorAll('.scroll_animado');

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                    observer.unobserve(entry.target); // Para de observar o elemento depois que ele foi animado
                }
            });
        }, {
            threshold: 0.4 // Ativa a animação quando 50% do elemento estiver visível
        });

        boxes.forEach(box => {
            observer.observe(box);
        });






    });
</script>


<body>

    <section class="hero carousel">
        <div class="cards-container">

            <div class="img_capa card">
                <span>
                    <div class="container">
                        <h2>Sua jornada para a liberdade financeira começa aqui!</h2>
                        <p>Transforme suas finanças com soluções personalizadas para as necessidades financeiras da sua empresa.</p>
                        <br>
                        <!-- <a href="#contact" class="cta-button">Entre em contato</a> -->
                    </div>
                </span>
                <img src="imgs/consultoria-financeira.webp" alt="foto_capa" class="img">
            </div>
            <div class="img_capa card">
                <span>
                    <div class="container">
                        <h2>Diagnostique problemas e oportunidades da sua empresa</h2>

                        <p>Oferecemos soluções personalizadas para suas necessidades financeiras.</p>
                        <br>
                        <!-- <a href="#contact" class="cta-button">Entre em contato</a> -->
                    </div>
                </span>
                <img src="imgs/problemas_oportunidades.jpg " alt="foto_capa" class="img">
            </div>
            <div class="img_capa card">
                <span>
                    <div class="container">
                        <h2>Tenha clareza sobre suas finanças</h2>

                        <p> Obtenha uma visão detalhada e transparente da sua situação financeira, permitindo decisões mais informadas e assertivas.</p>
                        <br>
                        <!-- <a href="#contact" class="cta-button">Entre em contato</a> -->
                    </div>
                </span>
                <img src="imgs/computador_graficos.jpg" alt="foto_capa" class="img">
            </div>
            <div class="img_capa card">
                <span>
                    <div class="container">
                        <h2>Alcance processos financeiros mais eficientes</h2>

                        <p>Simplifique e torne mais eficazes seus processos financeiros, aumentando a produtividade e a precisão na gestão.</p>
                        <br>
                        <!-- <a href="#contact" class="cta-button">Entre em contato</a> -->
                    </div>
                </span>
                <img src="imgs/mulher_tablet.jpg" alt="foto_capa" class="img">
            </div>
            <div class="img_capa card">
                <span>
                    <div class="container">
                        <h2>Invista seu dinheiro de forma segura e inteligente</h2>

                        <p>Aprenda a aplicar seus recursos com estratégias bem fundamentadas, garantindo segurança e crescimento sustentável.</p>
                        <br>
                        <!-- <a href="#contact" class="cta-button">Entre em contato</a> -->
                    </div>
                </span>
                <img src="imgs/investimento.jpg" alt="foto_capa" class="img">
            </div>
            <div class="img_capa card">
                <span>
                    <div class="container">
                        <h2>Tenha um orçamento estratégico e eficiente</h2>

                        <p>Planeje seu orçamento de maneira estratégica para alcançar seus objetivos financeiros com eficiência e eficácia.
                        <p>
                            <br>
                            <!-- <a href="#contact" class="cta-button">Entre em contato</a> -->
                    </div>
                </span>
                <img src="imgs/orcamento.jpg" alt="foto_capa" class="img">
            </div>
            <div class="img_capa card">
                <span>
                    <div class="container">
                        <h2>Planejamento financeiro para um futuro seguro</h2>

                        <p> Estruture seu futuro financeiro com um planejamento detalhado, assegurando estabilidade e crescimento a longo prazo.
                        <p>
                            <br>
                            <!-- <a href="#contact" class="cta-button">Entre em contato</a> -->
                    </div>
                </span>
                <img src="imgs/planejamento.jpg" alt="foto_capa" class="img">
            </div>
            <div class="img_capa card">
                <span>
                    <div class="container">
                        <h2>Controle abrangente de suas finanças pessoais</h2>

                        <p>Gerencie suas finanças pessoais com controle rigoroso e disciplina, garantindo um futuro financeiro seguro.
                        <p>
                            <br>
                            <!-- <a href="#contact" class="cta-button">Entre em contato</a> -->
                    </div>
                </span>
                <img src="imgs/contas.jpg" alt="foto_capa" class="img">
            </div>
            <div class="img_capa card">
                <span>
                    <div class="container">
                        <h2>Gestão patrimonial estratégica e eficaz</h2>

                        <p>Preserve e aumente seu patrimônio através de estratégias eficazes e personalizadas, assegurando um legado duradouro.
                        <p>
                            <br>
                            <!-- <a href="#contact" class="cta-button">Entre em contato</a> -->
                    </div>
                </span>
                <img src="imgs/moedas.jpg" alt="foto_capa" class="img">
            </div>

        </div>

        <div class="div_nav-dots">
            <div class="nav-dots"></div>
        </div>
    </section>
    <div class="Flashlogin">

        <div class="section">
            <h1>Afinal, o que é a Gestão Financeira/Empresarial? </h1>
            <br>
            <br>
            <h2 class="scroll_animado">Planejamento, Organização e Acompanhamento dos processos</h2>
            <br>
            <br>
            <p class="scroll_animado">Nosso propósito fundamental é a transparência das informações, eficiência, aumento dos lucros e a gestão eficaz da companhia ou pessoal;</p>
            <br>
            <br>
            <p class="scroll_animado">Criamos um planejamento exclusivo às suas necessidades e visões;</p>
            <br>
            <br>
            <h2 class="scroll_animado">Preencha o formulário de apresentação e dê o próximo passo para o sucesso financeiro pessoal!

            </h2>
        </div>

        <div class="blob_">
            <img src="imgs/computador-empresa.jpeg" alt="">
        </div>
    </div>


    <section id="services" class="services">
        <div class="container">
            <div class="section scroll_animado sectionFull">
                <h1>Tenha Ystrategy em sua organização</h1>
            </div>
            <div class="service-items">
                <div class="card_info scroll_animado">
                    <div class="icon_card">
                        <img src="iconsJD/computador_lucro.png" class="img" alt="">
                    </div>
                    <h3>Para que serve:</h3>



                    <ul class="features">
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card"> Garante a <strong>estabilidade financeira</strong>;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card"> Gera valor para a marca;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card"> Maior <strong> credibilidade </strong>entre CLIENTES FORNECEDORES e INVESTIDORES;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Auxilia nos processos decisórios;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Fortalece sua posição no mercado;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Honra obrigações financeiras;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Identifica riscos e oportunidades;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Gera transparência das operações e processos;</span>
                        </li>

                    </ul>



                </div>
                <div class="card_info scroll_animado">
                    <div class="icon_card">
                        <img src="iconsJD/conexoes.png" class="img" alt="">
                    </div>
                    <h3>Quais os peincipais benefícios:</h3>


                    <ul class="features">
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card"> Diminuição dos custos e despesas;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Aumento de Lucros e Margens;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Diminue os riscos;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Melhor produtividade</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Reduz erros operacionais;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Sustentabilidade a Longo Prazo;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Suporte e respaldo na tomada de decisões.</span>
                        </li>
                    </ul>
                </div>


                <div class="card_info scroll_animado">
                    <div class="icon_card">
                        <img src="iconsJD/lupa.png" class="img" alt="">
                    </div>
                    <h3>Como:</h3>

                    <ul class="features">
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Controle e planejamento orçamentário;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Planejamento e gestão de Fluxo de Caixa;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Controle de custos e despesas;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Automatização e/ou sistematização de processos;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>Análise de Investimentos;</span>
                        </li>
                        <li>
                            <span class="icon img">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                </svg>
                            </span>
                            <span class="txt_card">Elaboração de relatórios administrativos/financeiros de forma simplificada;</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>



    <div class="Flashlogin">
        <div class="blob_">
            <img src="imgs/computador-empresa.jpeg" alt="">
        </div>

        <section id="services" >
            <div class="container">
                
                <div class="service-items" >
                    <div class="service-item scroll_animado">
                        <h3>Avalie suas particularidades</h3>
                        <p>Crie um planejamento exclusivo as suas necessidades, objetivos e visões</p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Garanta mais eficiência</h3>
                        <p>Otimize processos e evolua a gestão de seus negócios a um outro nível. </p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Tome decisões</h3>
                        <p>Baseie-se a partir de informações fidedignas com foco em resultados.</p>
                    </div>
                </div>
            </div>
        </section>

    </div>












    <div class="tutorial">
        <div class="section scroll_animado sectionFull">
            <h1>Como funciona a consultoria?</h1>
        </div>

        <!-- <div class="alingH scroll_animado">
            <img src="imgs/criarconta2.png" class="img">
            <div class="alingV">
                <h1>Crie uma conta facil e rápido</h1><br>
                <p>Insira suas informações para criar sua conta e aproveite todos os benefícios da consultoria para sua empresa</p>
            </div>
        </div> -->
        <div class="alingH scroll_animado">

            <div class="alingV">
                <h1>Apresente seu negócio</h1><br>
                <p>Após criar seu login, apresente seu negócio o mais detalhado possivel, dando enfase à processos, despesas e situação atual, qual pode ser feito tanto de forma remota como presencial!</p>
                <br>
                <br>
                <a href="log_page.php?opcaosingUp">
                    <button class="singup">
                        COMEÇAR AGORA
                        <div class="arrow-wrapper">
                            <div class="arrow"></div>

                        </div>
                    </button>
                </a>
            </div>
            <img src="imgs/chatting.png" class="img">
        </div>
        <br>
        <br>
        <div class="alingH scroll_animado">
            <!-- <img src="imgs/grafico.png" class="img"> -->
            <img src="imgs/analises.png" class="img">

            <div class="alingV">
                <h1>Nós fazemos o diagnóstico da sua empresa/negócio </h1><br>
                <p>É feita a analíse da situação atual e é criado um plano de ação para alanvancar seu negócio, obtendo uma visão detalhada e transparente da sua situação financeira agindo de forma estratégica e eficaz</p>
            </div>
        </div>
        <div class="alingH scroll_animado">
            <div class="alingV">
                <h1>Execução do plano de ação</h1><br>
                <p>Nesse momento é colocado tudo em pratica! O plano de ação totalmente planejado para o seu negócio é executado com nosso acompanhamento e consultoria dos resultados!</p>
            </div>
            <img src="imgs/process.png" class="img">
        </div>
        <!-- <div class="alingH">
            <img src="imgs/Confirmed2.png" class="img">

            <div class="alingV">
                <h1>Confirme seu Agendamento</h1><br>
                <p>Revise os detalhes da sua consulta financeira e finalize a solicitação e pronto!- Você receberá um e-mail de confirmação com todas as informações necessárias</p>
            </div>
        </div> -->

    </div>



    <?php
    include('rodape.php');
    ?>
    </div>
</body>

</php>