async function salvarAvaliacao(formulario) {
    const empresaId = formulario.elements.namedItem("empresaId")?.value ?? "";
    const nota = formulario.elements.namedItem("nota")?.value ?? "";
    const comentario = formulario.elements.namedItem("comentario")?.value ?? "";
    const possuiRampa = formulario.elements.namedItem("possuiRampa")?.value ?? "";
    const possuiBanheiroAdaptado = formulario.elements.namedItem("possuiBanheiroAdaptado")?.value ?? "";
    const possuiSinalizacaoBraile = formulario.elements.namedItem("possuiSinalizacaoBraile")?.value ?? "";
    const possuiAcessibilidadeDigital = formulario.elements.namedItem("possuiAcessibilidadeDigital")?.value ?? "";
    const avaliacao = { empresaId, nota, comentario, possuiRampa, possuiBanheiroAdaptado, possuiSinalizacaoBraile, possuiAcessibilidadeDigital };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=salvarAvaliacao", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(avaliacao)
        });
        const dados = await resposta.json();
        if (resposta.ok && dados.sucesso) {
            alert(dados.mensagem);
            if (dados.redirecionar) window.location.href = new URL(dados.redirecionar, resposta.url).href;
        } else {
            alert(dados.mensagem || "Não foi possível realizar a operação.");
        }
    } catch (erro) {
        alert(erro.message);
    }
}

async function editarAvaliacao() {
    const id = document.getElementById("id")?.value ?? "";
    const nota = document.getElementById("nota")?.value ?? "";
    const comentario = document.getElementById("comentario")?.value ?? "";
    const possuiRampa = document.getElementById("possuiRampa")?.value ?? "";
    const possuiBanheiroAdaptado = document.getElementById("possuiBanheiroAdaptado")?.value ?? "";
    const possuiSinalizacaoBraile = document.getElementById("possuiSinalizacaoBraile")?.value ?? "";
    const possuiAcessibilidadeDigital = document.getElementById("possuiAcessibilidadeDigital")?.value ?? "";
    const avaliacao = { id, nota, comentario, possuiRampa, possuiBanheiroAdaptado, possuiSinalizacaoBraile, possuiAcessibilidadeDigital };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=editarAvaliacao", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(avaliacao)
        });
        const dados = await resposta.json();
        if (resposta.ok && dados.sucesso) {
            alert(dados.mensagem);
            if (dados.redirecionar) window.location.href = new URL(dados.redirecionar, resposta.url).href;
        } else {
            alert(dados.mensagem || "Não foi possível realizar a operação.");
        }
    } catch (erro) {
        alert(erro.message);
    }
}

async function excluirAvaliacao() {
    const id = document.getElementById("id")?.value ?? "";
    const avaliacao = { id };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=excluirAvaliacao", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(avaliacao)
        });
        const dados = await resposta.json();
        if (resposta.ok && dados.sucesso) {
            alert(dados.mensagem);
            if (dados.redirecionar) window.location.href = new URL(dados.redirecionar, resposta.url).href;
        } else {
            alert(dados.mensagem || "Não foi possível realizar a operação.");
        }
    } catch (erro) {
        alert(erro.message);
    }
}


async function buscarAvaliacoes() {
    const lista=document.getElementById("listaAvaliacoes");
    if(!lista)return;
    try{
        const resposta=await fetch("../controladores/rota.php?acao=buscarAvaliacoes",{
            method:"POST",headers:{"Content-Type":"application/json"},
            body:JSON.stringify({empresaId:lista.dataset.empresaId})
        });
        const dados=await resposta.json();
        if(!resposta.ok || !dados.sucesso)throw new Error(dados.mensagem || "Erro");
        if(!dados.avaliacoes.length){lista.textContent="Essa empresa ainda não possui avaliações.";return;}
        for(const av of dados.avaliacoes){
            const div=document.createElement("div"),h=document.createElement("h3");
            h.textContent="Nota: "+av.nota+"/5";div.appendChild(h);
            for(const [campo,nome] of Object.entries({comentario:"Comentário",possuiRampa:"Rampa",possuiBanheiroAdaptado:"Banheiro adaptado",possuiSinalizacaoBraile:"Sinalização Braille",possuiAcessibilidadeDigital:"Acessibilidade digital",dataAvaliacao:"Data da avaliação"})){
                const p=document.createElement("p");
                p.textContent=nome+": "+(campo.startsWith("possui")?(av[campo]?"Sim":"Não"):(av[campo]??""));
                div.appendChild(p);
            }
            div.appendChild(document.createElement("hr"));lista.appendChild(div);
        }
    }catch(erro){lista.textContent=erro.message;}
}
document.addEventListener("DOMContentLoaded",buscarAvaliacoes);
