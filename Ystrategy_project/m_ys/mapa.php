<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa Interativo - Áreas Coloridas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .map-container {
            position: relative;
            display: inline-block;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        svg {
            position: absolute;
            top: 0;
            z-index: 10;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        .region {
            fill: rgba(255, 0, 0, 0.5); /* Cor vermelha semitransparente */
            stroke: #000;
            stroke-width: 1;
            cursor: pointer;
            
            z-index: 11;
        }
        .region:hover {
            fill: rgba(0, 255, 0, 0.7); /* Cor verde ao passar o mouse */
        }
        .tooltip {
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            display: none;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <h1>Mapa Interativo - Áreas Coloridas</h1>
    <div class="map-container">
        <!-- Imagem do mapa -->
        <img src="imgs/mapa-metropolitana-de-sao-paulo.jpg" alt="Mapa Região Metropolitana de São Paulo">
        
        <!-- Sobreposição com SVG para as áreas -->
        <svg viewBox="">
            <!-- Exemplo de regiões -->
            <polygon class="region" alt="Sp" title="Sp" href="#"  data-region="1" points="304,573,331,571,357,563,375,566,390,555,396,547,402,520,397,498,389,480,386,458,395,434,382,424,378,407,396,398,382,384,390,369,411,358,420,333,438,333,455,337,477,343,489,349,507,353,520,353,527,340,532,325,538,303,528,290,537,280,546,265,536,255,514,255,497,255,479,255,467,257,447,264,431,272,428,251,427,225,433,205,443,189,425,192,409,204,397,217,371,224,362,218,351,223,341,215,334,206,321,201,301,202,292,209,275,210,287,246,299,246,306,258,316,273,316,281,313,295,305,307,288,324,285,332,304,329,322,329,312,339,302,349,294,359,292,386,292,403,300,418,302,429,292,439,288,454,304,463,304,476,301,484,299,509,292,509,284,516,282,525,307,550" />
            <polygon class="region" data-region="2" points="395,363,406,362,417,373,412,392,400,407,385,408,387,429,393,442,391,454,387,464,387,470,396,481,400,492,395,499,398,518,401,523,400,536,399,544,410,547,424,540,433,535,442,524,452,517,462,511,471,507,484,500,499,483,502,472,508,463,516,454,504,448,490,436,475,421,463,417,454,414,458,400,452,388,441,376,433,363,425,360,415,356" />
            <polygon class="region" data-region="3" points="383,405,393,405,405,400,414,390,416,379,416,371,406,367,400,365,393,365,387,382,393,388,396,397" />
            <polygon class="region" data-region="4" points="432,263,433,252,428,240,428,230,432,215,442,206,450,188,466,182,484,184,498,187,509,181,514,170,522,159,527,149,538,142,549,135,555,152,555,163,562,165,563,174,549,185,548,196,545,206,548,215,552,223,540,229,533,239,534,251,522,247,513,251,492,255,468,253,449,262,437,269" />
     
            <!-- Adicione mais regiões com as coordenadas corretas -->
        </svg>
        
        <!-- Tooltip para exibir informações -->
        <div class="tooltip" id="tooltip"></div>
    </div>

    <script>
        const tooltip = document.getElementById('tooltip');

        // Adicionar eventos para as regiões do SVG
        document.querySelectorAll('.region').forEach(region => {
            region.addEventListener('mouseover', (e) => {
                const regionId = region.dataset.region;
                tooltip.textContent = `Região: ${regionId}`;
                tooltip.style.left = e.pageX + 'px';
                tooltip.style.top = e.pageY + 'px';
                tooltip.style.display = 'block';
            });

            region.addEventListener('mouseout', () => {
                tooltip.style.display = 'none';
            });

            region.addEventListener('click', () => {
                const regionId = region.dataset.region;
                alert(`Você clicou na região ${regionId}`);
                // Lógica para redirecionar ou enviar dados
            });
        });
    </script>
</body>
</html>
