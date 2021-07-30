const table = document.querySelector("#mbody");

function carregaTabela () {
  fetch("https://localhost/t2s/src/controll/routes/route.movimentacoes.php")
  .then(res => {
    return res.json();
  })
  .then(data => {
    console.log(data);
    data.forEach(item => {
      let tr = document.createElement("tr");
      let cliente = document.createElement("td");
      cliente.innerHTML = item.cliente;
      let conteiner = document.createElement("td");
      conteiner.innerHTML = item.conteiner;
      let tipo = document.createElement("td");
      tipo.innerHTML = item.tipo;
      let inicio = document.createElement("td");
      inicio.innerHTML = item.inicio;
      let fim = document.createElement("td");
      fim.innerHTML = item.fim;

      tr.appendChild(cliente);
      tr.appendChild(conteiner);
      tr.appendChild(tipo);
      tr.appendChild(inicio);
      tr.appendChild(fim);

      table.appendChild(tr);
    })
  })
  .catch(err => {
    console.log(err);
  })
}