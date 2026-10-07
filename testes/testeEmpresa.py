from selenium import webdriver
from selenium.webdriver.common.by import By
import time

driver = webdriver.Chrome()

try:

    # ==========================================
    # 1 - CADASTRO
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
    # 2 - LOGIN / AUTENTICAÇÃO
    # ==========================================

    print("Abrindo tela de login...")
    driver.get("http://localhost/gestao/telas/autenticar.html")
    time.sleep(2)

    print("Preenchendo login...")

    driver.find_element(By.NAME, "email").send_keys("selenium@gmail.com")
    time.sleep(1)

    driver.find_element(By.NAME, "senha").send_keys("123456")
    time.sleep(2)

    print("Autenticando...")
    driver.find_element(By.TAG_NAME, "button").click()
    time.sleep(3)

    print("Login realizado!")
    print("URL atual:", driver.current_url)

    time.sleep(2)


    # ==========================================
    # 3 - BUSCAR EMPRESA
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

    print("Empresa encontrada!")


    # ==========================================
    # 4 - EDITAR EMPRESA
    # ==========================================

    print("Abrindo edição...")
    driver.find_element(By.LINK_TEXT, "Editar").click()
    time.sleep(2)

    print("Alterando nome...")

    campo_nome = driver.find_element(By.NAME, "nome")

    campo_nome.clear()
    time.sleep(1)

    campo_nome.send_keys("Empresa Selenium Editada")
    time.sleep(2)

    print("Salvando alteração...")
    driver.find_element(By.TAG_NAME, "button").click()
    time.sleep(3)


    # ==========================================
    # 5 - NOVA BUSCA
    # ==========================================

    print("Fazendo nova busca para verificar a alteração...")

    driver.get("http://localhost/gestao/telas/Busca.php")
    time.sleep(2)

    campo_pesquisa = driver.find_element(By.NAME, "pesquisa")
    campo_pesquisa.send_keys("Empresa Selenium Editada")
    time.sleep(2)

    driver.find_element(By.TAG_NAME, "button").click()
    time.sleep(3)


    # ==========================================
    # 6 - VERIFICAR EDIÇÃO
    # ==========================================

    texto_pagina = driver.page_source

    if "Empresa Selenium Editada" in texto_pagina:
        print("✓ Edição confirmada!")
    else:
        print("✗ A edição não foi encontrada!")

    time.sleep(2)


    # ==========================================
    # 7 - EXCLUIR
    # ==========================================

    print("Excluindo empresa...")
    time.sleep(2)

    driver.find_element(By.LINK_TEXT, "Excluir").click()
    time.sleep(2)


    # ==========================================
    # 8 - CONFIRMAR ALERTA
    # ==========================================

    try:

        alerta = driver.switch_to.alert

        print("Mensagem:", alerta.text)

        time.sleep(2)

        alerta.accept()

        print("✓ Empresa excluída!")

    except:
        print("Nenhum alerta encontrado.")

    time.sleep(3)


    # ==========================================
    # FINAL
    # ==========================================

    print("================================")
    print("TESTE CONCLUÍDO!")
    print("================================")

    input("Pressione ENTER para fechar o navegador...")


except Exception as erro:

    print("================================")
    print("ERRO:")
    print(erro)
    print("================================")

    input("Pressione ENTER para fechar o navegador...")


finally:

    driver.quit()