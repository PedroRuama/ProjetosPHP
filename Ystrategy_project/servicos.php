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
                    <h1>Como podemos ajudar sua Empresa</h1>
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



        <br>
        <br>
        <div class="Flashlogin" id="eficiencia">
            <div class="vertical-section">

                <h1>Tome Decisões Informadas</h1>

            </div>
            <div class="desc_conteudo">
                <h3>Na Ystrategy, fornecemos informações precisas e confiáveis para apoiar suas decisões estratégicas, tanto para empresas quanto para indivíduos.</h3>
                <br>
                <ul>
                    <li><b>Informações Confiáveis:</b> Utilizamos fontes de dados atualizadas e confiáveis, oferecendo análises de mercado, relatórios financeiros e indicadores econômicos para empresas e análises de gastos, rendimentos e investimentos para indivíduos.</li>
                    <br>
                    <li><b>Análises Rigorosas: </b> Realizamos análises aprofundadas utilizando técnicas avançadas de análise financeira para identificar tendências e prever cenários futuros, dando uma visão clara e abrangente da sua situação financeira.</li>
                    <br>
                    <li><b>Foco em Resultados: </b>Nossas recomendações são focadas em resultados mensuráveis, ajudando a definir metas claras e estratégias para alcançá-las, seja otimizando custos e aumentando receitas para empresas ou maximizando retornos e planejando para a aposentadoria para indivíduos.</li>
                    <br>
                    <li><b>Tomada de Decisão Estratégica: </b>Oferecemos suporte contínuo com insights e recomendações baseadas em dados, garantindo que suas decisões sejam bem fundamentadas e alinhadas com seus objetivos de longo prazo.</li>
                </ul>
            </div>
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



        <section class="services">
            <div class="container">
                <div class="section scroll_animado sectionFull">
                    <h1>Organize suas financas pessoais</h1>
                </div>
                <div class="service-items">
                    <span> <a href="#planejamento">
                            <div class="service-item scroll_animado">
                                <h3>Planejamento Financeiro</h3>
                                <p>Estratégias personalizadas para alcançar suas metas financeiras.</p>
                            </div>
                        </a></span>

                    <span> <a href="#investimentos">
                            <div class="service-item scroll_animado">
                                <h3>Investimentos</h3>
                                <p>Consultoria para investimentos inteligentes e seguros.</p>
                            </div>
                        </a></span>
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

        <br>
        <br>
        <div class="Flashlogin" id="planejamento">
            <div class="vertical-section v-s2">

                <h1>Planejamento Financeiro</h1>

            </div>
            <div class="desc_conteudo">
                <h3>Um planejamento financeiro bem estruturado é a base para alcançar suas metas financeiras, sejam elas pessoais. Nosso serviço de planejamento financeiro é personalizado para atender às suas necessidades específicas.</h3>
                <br>
                <ul>
                    <li><b>Avaliação Inicial:</b> Nosso processo começa com uma avaliação detalhada da sua situação financeira atual. Para indivíduos, isso inclui a análise de renda, despesas, ativos, passivos e hábitos de consumo. </li>
                    <br>
                    <li><b>Definição de Metas: </b> Trabalhamos com você para definir metas financeiras claras e alcançáveis. Para pessoas físicas, isso pode incluir objetivos como a compra de uma casa, a educação dos filhos, a aposentadoria ou a criação de um fundo de emergência. </li>
                    <br>
                    <li><b>Desenvolvimento de Estratégias: </b>Com base na avaliação inicial e nas metas definidas, desenvolvemos estratégias financeiras personalizadas. Isso pode incluir planos de poupança e investimento, estratégias de gestão de dívidas, otimização de impostos e planejamento de sucessão.</li>
                    <br>
                    <li><b>Implementação: </b>Ajudamos você a implementar as estratégias financeiras recomendadas, oferecendo orientação passo a passo e suporte contínuo. Nossa equipe de especialistas está disponível para responder suas perguntas e ajustar o plano conforme necessário, garantindo que você esteja no caminho certo para alcançar suas metas.</li>
                </ul>
            </div>
        </div>
        <br>
        <br>
        <div class="Flashlogin" id="investimentos">
            <div class="vertical-section v-s2">

                <h1>Investimentos</h1>

            </div>
            <div class="desc_conteudo">
                <h3>O planejamento de investimentos é uma parte essencial de nossa abordagem para ajudar indivíduos e empresas a alcançarem seus objetivos financeiros de forma inteligente e segura. </h3>
                <br>
                <ul>
                    <li><b>Avaliação de Perfil e Objetivos:</b>Começamos entendendo seu perfil de investidor e seus objetivos financeiros específicos. Para indivíduos, isso pode incluir a criação de um portfólio de investimentos para aposentadoria, a compra de imóveis ou a educação dos filhos. </li>
                    <br>
                    <li><b>Estratégias Personalizadas: </b> Com base na sua avaliação inicial, desenvolvemos estratégias de investimento personalizadas. Isso inclui a seleção cuidadosa de ativos e instrumentos financeiros que se alinham com seus objetivos de retorno, tolerância ao risco e horizonte de investimento. </li>
                    <br>
                    <li><b>Diversificação e Gestão de Riscos: </b>Promovemos a diversificação inteligente do seu portfólio de investimentos para reduzir riscos e maximizar retornos. Aconselhamos sobre alocações de ativos equilibradas e estratégias de gestão de riscos.</li>
                    <br>
                    <li><b>Educação e Orientação: </b>Além de implementar estratégias, oferecemos educação contínua e orientação sobre investimentos. Explicamos conceitos complexos de forma clara e acessível, capacitando você a tomar decisões informadas e entender o impacto das escolhas de investimento no seu futuro financeiro.</li>
                </ul>
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