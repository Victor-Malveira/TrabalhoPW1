function mostrarMensagemCandidato(texto, sucesso) {
    const mensagem = document.getElementById("mensagem");
    if (!mensagem) return;
    mensagem.textContent = texto;
    mensagem.style.color = sucesso ? "green" : "red";
}

async function salvarCandidato() {
    const nome = document.getElementById("nome")?.value ?? "";
    const email = document.getElementById("email")?.value ?? "";
    const senha = document.getElementById("senha")?.value ?? "";
    const telefone = document.getElementById("telefone")?.value ?? "";
    const formatoCurriculo = document.getElementById("formatoCurriculo")?.value ?? "";
    const candidato = { nome, email, senha, telefone, formatoCurriculo };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=salvarCandidato", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(candidato)
        });
        const dados = await resposta.json();
        if (resposta.ok && dados.sucesso) {
            mostrarMensagemCandidato(dados.mensagem, true);
            if (dados.redirecionar) {
                const destino = new URL(dados.redirecionar, resposta.url).href;
                setTimeout(() => { window.location.href = destino; }, 1500);
            }
        } else {
            mostrarMensagemCandidato(dados.mensagem || "Não foi possível realizar a operação.", false);
        }
    } catch (erro) {
        mostrarMensagemCandidato(erro.message, false);
    }
}

async function autenticarCandidato() {
    const email = document.getElementById("email")?.value ?? "";
    const senha = document.getElementById("senha")?.value ?? "";
    const candidato = { email, senha };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=autenticarCandidato", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(candidato)
        });
        const dados = await resposta.json();
        if (resposta.ok && dados.sucesso) {
            mostrarMensagemCandidato(dados.mensagem, true);
            if (dados.redirecionar) {
                const destino = new URL(dados.redirecionar, resposta.url).href;
                setTimeout(() => { window.location.href = destino; }, 1500);
            }
        } else {
            mostrarMensagemCandidato(dados.mensagem || "Não foi possível realizar a operação.", false);
        }
    } catch (erro) {
        mostrarMensagemCandidato(erro.message, false);
    }
}

async function editarCandidato() {
    const id = document.getElementById("id")?.value ?? "";
    const nome = document.getElementById("nome")?.value ?? "";
    const email = document.getElementById("email")?.value ?? "";
    const telefone = document.getElementById("telefone")?.value ?? "";
    const formatoCurriculo = document.getElementById("formatoCurriculo")?.value ?? "";
    const candidato = { id, nome, email, telefone, formatoCurriculo };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=editarCandidato", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(candidato)
        });
        const dados = await resposta.json();
        if (resposta.ok && dados.sucesso) {
            mostrarMensagemCandidato(dados.mensagem, true);
            if (dados.redirecionar) {
                const destino = new URL(dados.redirecionar, resposta.url).href;
                setTimeout(() => { window.location.href = destino; }, 1500);
            }
        } else {
            mostrarMensagemCandidato(dados.mensagem || "Não foi possível realizar a operação.", false);
        }
    } catch (erro) {
        mostrarMensagemCandidato(erro.message, false);
    }
}

async function excluirCandidato() {
    const id = document.getElementById("id")?.value ?? "";
    const candidato = { id };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=excluirCandidato", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(candidato)
        });
        const dados = await resposta.json();
        if (resposta.ok && dados.sucesso) {
            mostrarMensagemCandidato(dados.mensagem, true);
            if (dados.redirecionar) {
                const destino = new URL(dados.redirecionar, resposta.url).href;
                setTimeout(() => { window.location.href = destino; }, 1500);
            }
        } else {
            mostrarMensagemCandidato(dados.mensagem || "Não foi possível realizar a operação.", false);
        }
    } catch (erro) {
        mostrarMensagemCandidato(erro.message, false);
    }
}

async function sairCandidato() {
    const candidato = {  };
    try {
        const resposta = await fetch("../controladores/rota.php?acao=sairCandidato", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(candidato)
        });
        const dados = await resposta.json();
        if (resposta.ok && dados.sucesso) {
            mostrarMensagemCandidato(dados.mensagem, true);
            if (dados.redirecionar) {
                const destino = new URL(dados.redirecionar, resposta.url).href;
                setTimeout(() => { window.location.href = destino; }, 1500);
            }
        } else {
            mostrarMensagemCandidato(dados.mensagem || "Não foi possível realizar a operação.", false);
        }
    } catch (erro) {
        mostrarMensagemCandidato(erro.message, false);
    }
}


async function buscarCandidato() {
    const pesquisa=document.getElementById("pesquisa")?.value ?? "";
    try{
        const resposta=await fetch("../controladores/rota.php?acao=buscarCandidato",{
            method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({pesquisa:pesquisa})
        });
        const dados=await resposta.json();
        if(resposta.ok && dados.sucesso)return dados.candidatos;
        mostrarMensagemCandidato(dados.mensagem, false);
    }catch(erro){mostrarMensagemCandidato(erro.message, false);}
}
