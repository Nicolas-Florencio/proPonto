# proPonto
Desenvolvimento de CRUD (gerenciador de eventos) como parte do processo seletivo da empresa Pró Ponto

# 📌 Gerenciador de Eventos

## 📝 Descrição
Este projeto é um **Gerenciador de Eventos** desenvolvido para realizar o cadastro, listagem, edição, exclusão e filtragem de eventos. O sistema garante a integridade dos dados, impedindo o cadastro duplicado de eventos com o mesmo nome e oferecendo mensagens de confirmação para todas as operações.

---

## 💻 Tecnologias Utilizadas
- **MySQL** (Banco de Dados)
- **PHP** (Backend)
- **HTML** (Estrutura)
- **CSS** (Estilo)
- **JavaScript** (Interatividade)

### 🔧 Ferramentas de Apoio
- **Postman** (Testes de API)
- **XAMPP** ou **WampServer** (Servidor Apache + MySQL)

---

## 📌 Funcionalidades
- 📄 **Listagem de Eventos**
- ➕ **Cadastro de Eventos**
- ✏️ **Edição de Eventos**
- ❌ **Exclusão de Eventos**
- 🔍 **Filtragem por:**
    - Nome
    - Endereço
    - Intervalo de Datas
    - Valores (Preço mínimo e máximo)
- 🔐 **Validação para evitar duplicidade de registros pelo nome**
- 🔔 **Mensagens de confirmação para salvar, editar e excluir**

---

## ⚙️ Requisitos
### Softwares Necessários
- XAMPP ou WampServer (Servidor Apache + MySQL)

### Banco de Dados
- Nome do Banco: **eventos**
- Usuário: **php**
- Senha: **senha123**

#### Script de Criação do Banco
```sql
CREATE DATABASE eventos;

USE eventos;

CREATE TABLE evento (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60) NOT NULL UNIQUE,
    descricao VARCHAR(150),
    endereco VARCHAR(200) NOT NULL,
    link_endereco VARCHAR(50),
    dataHora_inicio DATETIME NOT NULL,
    tipo VARCHAR(30) NOT NULL,
    preco DECIMAL(10, 2)
);
```

---

## 🚀 Instalação e Execução
1. Clone este repositório:
   ```bash
   git clone https://github.com/seu_usuario/gerenciador-eventos.git
   ```
2. Configure o banco de dados com o script acima.
3. Certifique-se que o servidor Apache e MySQL estão ativos.
4. Acesse o navegador em:
   ```
   http://localhost/seu_projeto/
   ```

---

## 💪 Como Usar
1. Acesse a página inicial.
2. Cadastre um novo evento preenchendo todos os campos obrigatórios.
3. Utilize os filtros para buscar eventos por nome, endereço, datas ou valores.
4. Edite ou exclua registros conforme necessário.
5. Confirme todas as operações ao visualizar as mensagens.

---

## 🔑 Dicas
- Sempre verifique se o servidor XAMPP/WampServer está ativo.
- Utilize o Postman para testar os endpoints PHP durante o desenvolvimento.

---

## 📌 Contribuição
Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e enviar pull requests.

---

## 📄 Licença
Este projeto é de uso livre para fins acadêmicos.

---

Feito com 💙 por **Nicolas** 🚀

