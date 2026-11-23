function mostrarMensagemAvaliacao(texto, sucesso, formulario = null) {
    const mensagem = formulario ? formulario.querySelector(".mensagem-avaliacao") : document.getElementById("mensagem");
    if (!mensagem) return;
    mensagem.textContent = texto;
    mensagem.style.color = sucesso ? "green" : "red";
}

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
            mostrarMensagemAvaliacao(dados.mensagem, true, formulario);
            if (dados.redirecionar) {
                const destino = new URL(dados.redirecionar, resposta.url).href;
                setTimeout(() => { window.location.href = destino; }, 1500);
            }
        } else {
            mostrarMensagemAvaliacao(dados.mensagem || "Não foi possível realizar a operação.", false, formulario);
        }
    } catch (erro) {
        mostrarMensagemAvaliacao(erro.message, false, formulario);
    }
}

async function editarAvaliacao(formulario, id) {
    if (!Number.isSafeInteger(Number(id)) || Number(id) <= 0) {
        mostrarMensagemAvaliacao("A avaliação não possui um ID válido. Atualize a página.", false);
        return;
    }
    const nota = formulario.elements.namedItem("nota").value;
    const comentario = formulario.elements.namedItem("comentario").value;
    const possuiRampa = formulario.elements.namedItem("possuiRampa").value;
    const possuiBanheiroAdaptado = formulario.elements.namedItem("possuiBanheiroAdaptado").value;
    const possuiSinalizacaoBraile = formulario.elements.namedItem("possuiSinalizacaoBraile").value;
    const possuiAcessibilidadeDigital = formulario.elements.namedItem("possuiAcessibilidadeDigital").value;
    const avaliacao = { id, nota, comentario, possuiRampa, possuiBanheiroAdaptado, possuiSinalizacaoBraile, possuiAcessibilidadeDigital };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=editarAvaliacao", {
            method: "POST", headers: { "Content-Type": "application/json" },
            body: JSON.stringify(avaliacao)
        });
        const dados = await resposta.json();
        mostrarMensagemAvaliacao(dados.mensagem || "Erro ao editar.", resposta.ok && dados.sucesso);
        if (resposta.ok && dados.sucesso) await buscarAvaliacoes();
    } catch (erro) {
        mostrarMensagemAvaliacao(erro.message, false);
    }
}

async function excluirAvaliacao(id) {
    if (!Number.isSafeInteger(Number(id)) || Number(id) <= 0) {
        mostrarMensagemAvaliacao("A avaliação não possui um ID válido. Atualize a página.", false);
        return;
    }
    try {
        const resposta = await fetch("../controladores/rota.php?acao=excluirAvaliacao", {
            method: "POST", headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id })
        });
        const dados = await resposta.json();
        mostrarMensagemAvaliacao(dados.mensagem || "Erro ao excluir.", resposta.ok && dados.sucesso);
        if (resposta.ok && dados.sucesso) await buscarAvaliacoes();
    } catch (erro) {
        mostrarMensagemAvaliacao(erro.message, false);
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
        lista.replaceChildren();
        const aviso = document.getElementById("avisoLogin");
        if (aviso) {
            aviso.hidden = !!dados.autenticado;
        }
        if(!dados.avaliacoes.length){lista.textContent="Essa empresa ainda não possui avaliações.";return;}
        for(const av of dados.avaliacoes){
            const div=document.createElement("div"),h=document.createElement("h3");
            if (av.podeEditar && (!Number.isSafeInteger(Number(av.id)) || Number(av.id) <= 0)) {
                mostrarMensagemAvaliacao("Esta avaliação foi carregada sem um ID válido. Atualize a página.", false);
            }
            h.textContent="Nota: "+av.nota+"/5";div.appendChild(h);
            for(const [campo,nome] of Object.entries({comentario:"Comentário",possuiRampa:"Rampa",possuiBanheiroAdaptado:"Banheiro adaptado",possuiSinalizacaoBraile:"Sinalização Braille",possuiAcessibilidadeDigital:"Acessibilidade digital",dataAvaliacao:"Data da avaliação"})){
                const p=document.createElement("p");
                p.textContent=nome+": "+(campo.startsWith("possui")?(av[campo]?"Sim":"Não"):(av[campo]??""));
                div.appendChild(p);
            }
            if (av.podeEditar && Number.isSafeInteger(Number(av.id)) && Number(av.id) > 0) {
                const editar = document.createElement("button");
                editar.type = "button";
                editar.textContent = "Editar";
                const formulario = document.createElement("form");
                formulario.hidden = true;
                const id = document.createElement("input");
                id.type = "hidden";
                id.name = "id";
                id.value = av.id;
                formulario.appendChild(id);
                const campos = {
                    nota: "Nota", comentario: "Comentário", possuiRampa: "Rampa",
                    possuiBanheiroAdaptado: "Banheiro adaptado",
                    possuiSinalizacaoBraile: "Sinalização Braille",
                    possuiAcessibilidadeDigital: "Acessibilidade digital"
                };
                for (const [campo, rotulo] of Object.entries(campos)) {
                    const label = document.createElement("label");
                    label.textContent = rotulo + ": ";
                    let entrada;
                    if (campo === "comentario") {
                        entrada = document.createElement("textarea");
                        entrada.value = av.comentario ?? "";
                    } else {
                        entrada = document.createElement("select");
                        for (const valor of (campo === "nota" ? ["1","2","3","4","5"] : ["1","0"])) {
                            const opcao = document.createElement("option");
                            opcao.value = valor;
                            opcao.textContent = campo === "nota" ? valor : (valor === "1" ? "Sim" : "Não");
                            opcao.selected = String(av[campo]) === valor;
                            entrada.appendChild(opcao);
                        }
                    }
                    entrada.name = campo;
                    label.appendChild(entrada);
                    formulario.appendChild(label);
                    formulario.appendChild(document.createElement("br"));
                }
                const salvar = document.createElement("button");
                salvar.type = "button";
                salvar.textContent = "Salvar alterações";
                salvar.onclick = () => editarAvaliacao(formulario, Number(av.id));
                formulario.appendChild(salvar);
                editar.onclick = () => { formulario.hidden = !formulario.hidden; };
                div.appendChild(editar);
                div.appendChild(formulario);
                const excluir = document.createElement("button");
                excluir.type = "button";
                excluir.textContent = "Excluir";
                const confirmar = document.createElement("button");
                confirmar.type = "button";
                confirmar.textContent = "Confirmar exclusão";
                confirmar.hidden = true;
                excluir.onclick = () => { confirmar.hidden = !confirmar.hidden; };
                confirmar.onclick = () => excluirAvaliacao(Number(av.id));
                div.appendChild(excluir);
                div.appendChild(confirmar);
            }
            div.appendChild(document.createElement("hr"));lista.appendChild(div);
        }
    }catch(erro){lista.textContent=erro.message;}
}
document.addEventListener("DOMContentLoaded",buscarAvaliacoes);
