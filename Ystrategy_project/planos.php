<?php

include_once('controllers/conexao.php');
include('menu.php');
// $ultimosCad = mysqli_query($conexao, "SELECT * FROM beats");
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
	<link rel="stylesheet" href="styles/index.css">
	<link rel="stylesheet" href="styles/planos.css">
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
	<div class="div_aling_plano">
		<div class="content">
			<div class="plan">
				<div class="inner">
					<span class="pricing">
						<span>
							$39,99 <small>/ m</small>
						</span>
					</span>
					<p class="title">Plano Básico</p>
					<p class="info">Ideal para pequenas empresas que estão começando a organizar suas finanças.</p>
					<ul class="features">
						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span><strong>Consultoria</strong> financeira mensal online</span>
						</li>
						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Relatórios <strong>financeiros básicos</strong></span>
						</li>
						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Acesso ao painel de controle online</span>
						</li>

						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Suporte via e-mail</span>
						</li>
						<li>
							<span class="close">&times;</span>

							<span><del>Análise de fluxo de caixa e planejamento orçamentário </del></span>
						</li>

						<li>
							<span class="close">&times;</span>
							<span><del> Treinamento para equipe </del></span>
						</li>

						<li>
							<span class="close">&times;</span>
							<span><del>Acompanhamento personalizado com um consultor dedicado</del></span>
						</li>

					</ul>
					<div class="action">
						<a class="button" href="#">
							Escolher plano
						</a>
					</div>
				</div>
			</div>


			<div class="plan">
				<div class="inner">
					<span class="pricing">
						<span>
							$59,99 <small>/ m</small>
						</span>
					</span>
					<p class="title">Plano Avançado</p>
					<p class="info">Inclui análise de fluxo de caixa e planejamento orçamentário. Perfeito para empresas que precisam de acompanhamento mais frequente.</p>
					<ul class="features">
						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span><strong>Consultoria</strong> financeira quinzenal online ou presencial</span>
						</li>
						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Relatórios <strong>financeiros detalhados</strong></span>
						</li>
						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Acesso ao painel de controle online</span>
						</li>

						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Suporte via e-mail e telefone</span>
						</li>

						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Análise de fluxo de caixa e planejamento orçamentário</span>
						</li>

						<li>
							<span class="close">&times;</span>
							<span><del> Treinamento para equipe </del></span>
						</li>

						<li>
							<span class="close">&times;</span>
							<span><del>Acompanhamento personalizado com um consultor dedicado</del></span>
						</li>


					</ul>
					<div class="action">
						<a class="button" href="#">
							Escolher plano
						</a>
					</div>
				</div>
			</div>


			<div class="plan">
				<div class="inner">
					<span class="pricing">
						<span>
							$79,99 <small>/ m</small>
						</span>
					</span>
					<p class="title">Plano Premium</p>
					<p class="info">Inclui análise de fluxo de caixa, planejamento orçamentário, projeções financeiras, treinamento para a equipe e consultor dedicado. Destinado a empresas que buscam um acompanhamento intensivo e personalizado.</p>
					<ul class="features">
						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span><strong>Consultoria</strong> financeira semanal online ou presencial</span>
						</li>
						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Relatórios <strong>financeiros personalizados e detalhados</strong></span>
						</li>
						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Acesso ao painel de controle online</span>
						</li>

						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Suporte prioritário via e-mail, telefone e chat</span>
						</li>

						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Análise de fluxo de caixa, planejamento orçamentário e e projeções financeiras</span>
						</li>

						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Treinamento para equipe</span>
						</li>

						<li>
							<span class="icon img">
								<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 0h24v24H0z" fill="none"></path>
									<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
								</svg>
							</span>
							<span>Acompanhamento personalizado com um consultor dedicado</span>
						</li>

					</ul>
					<div class="action">
						<a class="button" href="#">
							Escolher plano
						</a>
					</div>
				</div>
			</div>


		</div>
	</div>
</body>

</php>