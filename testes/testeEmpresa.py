from selenium import webdriver
from selenium.webdriver.common.by import By
import time

driver = webdriver.Chrome()
#python testeEmpresa.py para executar
try:

    # ==========================================
    # 1 - CADASTRAR
    # ==========================================

    print("Abrindo cadastro...")
    driver.get("http://localhost/gestao/telas/salvarEmpresa.html")
    time.sleep(2)

    print("Preenchendo cadastro...")

    driver.find_element(By.NAME, "nome").send_keys("Empresa Selenium")
    time.sleep(1)

    driver.find_element(By.NAME, "email").send_keys("selenium@gmail.com")
    time.sleep(1)

    driver.find_element(By.NAME, "senha").send_keys("123456")
    time.sleep(1)

    driver.find_element(By.NAME, "telefone").send_keys("999999999")
    time.sleep(2)

    print("Cadastrando...")
    driver.find_element(By.TAG_NAME, "button").click()
    time.sleep(3)


    # ==========================================
    # 2 - BUSCAR EMPRESA
    # ==========================================

    print("Abrindo busca...")
    driver.get("http://localhost/gestao/telas/Busca.php")
    time.sleep(2)

    print("Pesquisando empresa...")
    campo_pesquisa = driver.find_element(By.NAME, "pesquisa")
    campo_pesquisa.send_keys("Empresa Selenium")
    time.sleep(2)

    driver.find_element(By.TAG_NAME, "button").click()
    time.sleep(3)


    # ==========================================
    # 3 - EDITAR
    # ==========================================

    print("Abrindo edição...")
    driver.find_element(By.LINK_TEXT, "Editar").click()
    time.sleep(2)

    print("Alterando nome...")

    campo_nome = driver.find_element(By.NAME, "nome")

    # Apaga o nome antigo
    campo_nome.clear()
    time.sleep(1)

    campo_nome.send_keys("Empresa Selenium Editada")
    time.sleep(2)

    print("Salvando alteração...")
    driver.find_element(By.TAG_NAME, "button").click()
    time.sleep(3)


    # ==========================================
    # 4 - NOVA BUSCA PARA VERIFICAR A EDIÇÃO
    # ==========================================

    print("Fazendo nova busca para verificar a alteração...")

    driver.get("http://localhost/gestao/telas/Busca.php")
    time.sleep(2)

    campo_pesquisa = driver.find_element(By.NAME, "pesquisa")
    campo_pesquisa.send_keys("Empresa Selenium Editada")
    time.sleep(2)

    driver.find_element(By.TAG_NAME, "button").click()
    time.sleep(3)

    # Verifica se o nome alterado aparece
    texto_pagina = driver.page_source

    if "Empresa Selenium Editada" in texto_pagina:
        print("✓ Edição confirmada!")
    else:
        print("✗ A edição não foi encontrada!")


    # ==========================================
    # 5 - EXCLUIR
    # ==========================================

    print("Preparando para excluir...")
    time.sleep(2)

    driver.find_element(By.LINK_TEXT, "Excluir").click()
    time.sleep(2)


    # ==========================================
    # 6 - CONFIRMAR ALERTA
    # ==========================================

    try:
        alerta = driver.switch_to.alert

        print("Mensagem:", alerta.text)

        time.sleep(2)

        alerta.accept()

        print("✓ Exclusão confirmada!")

    except:
        print("Nenhum alerta encontrado.")


    time.sleep(3)


    # ==========================================
    # 7 - FINAL
    # ==========================================

    print("Teste concluído!")

    input("Pressione ENTER para fechar o navegador...")


except Exception as erro:

    print("ERRO:")
    print(erro)

    input("Pressione ENTER para fechar o navegador...")


finally:

    driver.quit()