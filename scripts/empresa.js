// Funções do modelo empresa, seguindo o padrão simples do agenda.

async function salvarEmpresa() {
    const nome = document.getElementById("nome")?.value ?? "";
    const email = document.getElementById("email")?.value ?? "";
    const senha = document.getElementById("senha")?.value ?? "";
    const telefone = document.getElementById("telefone")?.value ?? "";
    const empresa = { nome, email, senha, telefone };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=salvarEmpresa", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(empresa)
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

async function autenticar() {
    const email = document.getElementById("email")?.value ?? "";
    const senha = document.getElementById("senha")?.value ?? "";
    const empresa = { email, senha };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=autenticar", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(empresa)
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

async function editarEmpresa() {
    const id = document.getElementById("id")?.value ?? "";
    const nome = document.getElementById("nome")?.value ?? "";
    const email = document.getElementById("email")?.value ?? "";
    const telefone = document.getElementById("telefone")?.value ?? "";
    const empresa = { id, nome, email, telefone };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=editarEmpresa", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(empresa)
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

async function excluirEmpresa() {
    const id = document.getElementById("id")?.value ?? "";
    const empresa = { id };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=excluirEmpresa", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(empresa)
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

async function sairEmpresa() {
    const empresa = {  };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=sairEmpresa", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(empresa)
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


async function buscarEmpresa() {
    const pesquisa = document.getElementById("pesquisa").value;
    const resultados = document.getElementById("resultadosEmpresas");
    const mensagem = document.getElementById("mensagem");
    resultados.replaceChildren();
    try {
        const resposta = await fetch("../controladores/rota.php?acao=buscarEmpresa", {
            method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({pesquisa:pesquisa})
        });
        const dados = await resposta.json();
        if(!resposta.ok || !dados.sucesso) throw new Error(dados.mensagem || "Erro na busca");
        mensagem.textContent = dados.empresas.length ? "" : "Nenhuma empresa encontrada.";
        for(const empresa of dados.empresas) {
            const div=document.createElement("div"), h=document.createElement("h2");
            h.textContent=empresa.nome; div.appendChild(h);
            const p=document.createElement("p");
            p.textContent="E-mail: "+empresa.email+" | Telefone: "+empresa.telefone;div.appendChild(p);
            const link=document.createElement("a");
            link.href="avaliacoesEmpresas.php?id="+encodeURIComponent(empresa.id);
            link.textContent="Ver avaliações";div.appendChild(link);
            if(candidatoLogado){
                const form=document.createElement("form"), id=document.createElement("input");
                id.type="hidden";id.name="empresaId";id.value=empresa.id;form.appendChild(id);
                for(const [campo,rotulo] of Object.entries({nota:"Nota",possuiRampa:"Rampa",possuiBanheiroAdaptado:"Banheiro adaptado",possuiSinalizacaoBraile:"Sinalização Braille",possuiAcessibilidadeDigital:"Acessibilidade digital"})){
                    const label=document.createElement("label"),select=document.createElement("select");
                    label.textContent=rotulo+": ";select.name=campo;
                    for(const valor of (campo==="nota"?["1","2","3","4","5"]:["1","0"])){
                        const option=document.createElement("option");
                        option.value=valor;option.textContent=campo==="nota"?valor:(valor==="1"?"Sim":"Não");
                        select.appendChild(option);
                    }
                    label.appendChild(select);form.appendChild(label);form.appendChild(document.createElement("br"));
                }
                const comentario=document.createElement("textarea");
                comentario.name="comentario";comentario.placeholder="Comentário";form.appendChild(comentario);
                const botao=document.createElement("button");
                botao.type="button";botao.textContent="Enviar avaliação";botao.onclick=()=>salvarAvaliacao(form);
                form.appendChild(botao);div.appendChild(form);
            }else{
                const aviso=document.createElement("p"), login=document.createElement("a");
                login.href="autenticarCandidato.php";login.textContent="Faça login para avaliar";
                aviso.appendChild(login);div.appendChild(aviso);
            }
            div.appendChild(document.createElement("hr"));resultados.appendChild(div);
        }
    }catch(erro){mensagem.textContent=erro.message;}
}
