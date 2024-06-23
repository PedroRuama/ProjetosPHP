<?php

include_once('controllers/conexao.php');
include('menu.php');

// ORDER BY id DESC LIMIT 6; 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultoria Financeira</title>
    <link rel="stylesheet" href="styles/index.css">
    <script src="scripts/index.js"></script>
</head>



<script>
    document.addEventListener('DOMContentLoaded', function() {

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

    <?php


    if (isset($_GET["serviceEm"])) {
    ?>



        <section class="hero carousel">
            <div class="cards-container">

                <div class="img_capa card img_service">
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
        </section>


        <section id="services" class="services">
            <div class="container">
                <div class="section scroll_animado sectionFull">
                    <h1>Serviços para sua Empresa</h1>
                </div>
                <div class="service-items">
                    <div class="service-item scroll_animado">
                        <h3>Planejamento Financeiro</h3>
                        <p>Estratégias personalizadas para alcançar suas metas financeiras.</p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Investimentos</h3>
                        <p>Consultoria para investimentos inteligentes e seguros.</p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Consultoria Empresarial</h3>
                        <p>Melhore a saúde financeira da sua empresa.</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="Flashlogin">
            <div class="section">
                <h1>Faça sua conta e agende sua consulta online!</h1>
                <br>
                <br>
                <h2 class="scroll_animado">Confie suas finanças a especialistas que entendem as necessidades do seu negócio.</h2>
                <br>
                <br>
                <p class="scroll_animado">Nosso compromisso é fornecer indicadores essenciais que tornem seu processo de tomada de decisão mais ágil e preciso.</p>
                <br>
                <br>
                <p class="scroll_animado">Disponibilizamos uma solução completa e automatizada para a gestão financeira de franquias e pequenas empresas, permitindo que você se concentre no que realmente importa: o crescimento do seu negócio.</p>
                <br>
                <br>
                <h2 class="scroll_animado">Nós gerenciamos as finanças, enquanto você foca na expansão!</h2>
                <br>
                <br>
                <p class="scroll_animado">Agende sua consulta hoje mesmo e dê o próximo passo para o sucesso financeiro da sua empresa!</p>

            </div>


            <?php
            include('criarcontaEM.php');
            ?>

        </div>
    <?php
    } else if (isset($_GET['servicePf'])) {
    ?>
        <section class="hero carousel">
            <div class="cards-container">
                <div class="img_capa card img_service">
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
            </div>
        </section>






        <section class="services" id="services2">
            <div class="container">
                <div class="section scroll_animado sectionFull">
                    <h1 style="color: var(--primary-color)">Serviços para você, Pessoa Fisica</h1>
                </div>
                <div class="service-items">
                    <div class="service-item scroll_animado">
                        <h3>Planejamento Financeiro</h3>
                        <p>Estratégias personalizadas para alcançar suas metas financeiras.</p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Investimentos</h3>
                        <p>Consultoria para investimentos inteligentes e seguros.</p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Consultoria Empresarial</h3>
                        <p>Melhore a saúde financeira da sua empresa.</p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Consultoria Empresarial</h3>
                        <p>Melhore a saúde financeira da sua empresa.</p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Consultoria Empresarial</h3>
                        <p>Melhore a saúde financeira da sua empresa.</p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Consultoria Empresarial</h3>
                        <p>Melhore a saúde financeira da sua empresa.</p>
                    </div>
                    <div class="service-item scroll_animado">
                        <h3>Consultoria Empresarial</h3>
                        <p>Melhore a saúde financeira da sua empresa.</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="Flashlogin">
            <?php
            include('criarcontaPF.php');
            ?>

            <div class="section">
                <h1>Transforme Suas Finanças Pessoais com Nossos Especialistas</h1>
                <br>
                <br>
                <h2 class="scroll_animado">Confie suas finanças a especialistas que entendem suas necessidades pessoais.</h2>
                <br>
                <br>
                <p class="scroll_animado">Disponibilizamos uma solução completa e automatizada para a gestão financeira pessoal. Nossa plataforma intuitiva e eficiente permite que você se concentre no que realmente importa: alcançar seus objetivos e sonhos.</p>
                <br>
                <br>
                <p class="scroll_animado">Descubra como nossa abordagem personalizada pode transformar a saúde financeira da sua vida. Reduza a complexidade das operações financeiras e ganhe mais tempo para aproveitar a vida.</p>
                <br>
                <br>
                <h2 class="scroll_animado">Crie sua conta e dê o próximo passo para o sucesso financeiro pessoal!</h2>
            </div>

        </div>


    <?php
    }

    ?>



    <?php
    include('rodape.php');
    ?>
    </div>
</body>

</php>