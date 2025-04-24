function mascaraMoeda(input) {
    input.addEventListener("input", () => {
      let valor = input.value.replace(/[^0-9]/g, "");
  
      if (valor.length < 3) {
        // Garante pelo menos 3 dígitos para ter 2 casas decimais
        valor = valor.padStart(3, "0");
      }
  
      let parteInteira = valor.slice(0, -2);
      let parteDecimal = valor.slice(-2);
  
      input.value = `${parseInt(parteInteira)}.${parteDecimal}`;
    });
  }
  