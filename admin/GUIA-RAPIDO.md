# 🚀 Guia Rápido - Brasília Basquete Admin

## 📋 Acesso Rápido

### Login
```
URL: http://seusite.com.br/admin/
Usuário: admin
Senha: admin123 (troque imediatamente!)
```

---

## ⚡ Ações Mais Comuns

### ➕ Adicionar Jogador

1. Menu → **Jogadores**
2. Botão **"+ Novo Jogador"**
3. Preencher:
   - Número (obrigatório)
   - Nome (obrigatório)
   - Posição (obrigatório)
   - URL da Foto
   - Outros dados
4. **Salvar**

### ✏️ Editar Jogador

1. Menu → **Jogadores**
2. Encontrar jogador na lista
3. Botão **"✏️ Editar"**
4. Fazer alterações
5. **Atualizar**

### 📝 Criar Post

1. Menu → **Posts**
2. Botão **"+ Novo Post"**
3. Preencher:
   - Título (obrigatório)
   - Categoria (obrigatório)
   - Conteúdo (obrigatório)
   - Resumo
   - Imagem destacada
4. Marcar **"Publicado"**
5. **Publicar**

### 🗑️ Excluir Conteúdo

1. Encontrar item na lista
2. Botão **"🗑️ Excluir"**
3. **Confirmar**

⚠️ **Atenção:** Exclusão é permanente!

---

## 🔧 Configuração Inicial (Primeira Vez)

### 1. Configurar Banco de Dados

```bash
Arquivo: admin/config/db_credentials.php
```

```php
return [
    'host' => 'localhost',
    'database' => 'u568843907_brasiliabasque',
    'username' => 'u568843907_bsbbkt',
    'password' => 'SUA_SENHA_AQUI', // ← Adicione aqui
    'charset' => 'utf8mb4'
];
```

### 2. Primeiro Acesso

1. Abrir navegador
2. Acessar: `http://seusite.com.br/admin/`
3. Login: `admin` / `admin123`
4. **Trocar senha imediatamente!**

---

## 🖼️ Como Adicionar Imagens

### Opção 1: Hospedagem Externa

1. Fazer upload em:
   - [Imgur](https://imgur.com)
   - [ImgBB](https://imgbb.com)
   - Outro serviço

2. Copiar link direto da imagem
   ```
   Exemplo: https://i.imgur.com/abc123.jpg
   ```

3. Colar no campo "URL da Foto/Imagem"

### Opção 2: Servidor Próprio

1. Criar pasta: `/uploads/`
2. Fazer upload via FTP
3. URL será:
   ```
   https://seusite.com.br/uploads/imagem.jpg
   ```

---

## 🎯 Campos Obrigatórios

### Jogadores
- ✅ Número
- ✅ Nome
- ✅ Posição

### Posts
- ✅ Título
- ✅ Categoria
- ✅ Conteúdo

---

## 🏷️ Categorias Padrão

1. **Notícias** - Informações gerais
2. **Bastidores** - Treinos e dia a dia
3. **Entrevistas** - Conversas com jogadores
4. **Jogos** - Resultados e análises
5. **Elenco** - Novidades sobre jogadores
6. **História** - Conteúdo histórico

---

## 🐛 Problemas Comuns

### Erro de Conexão ao Banco
✅ Verificar senha em `db_credentials.php`
✅ Confirmar que banco existe
✅ Testar credenciais no phpMyAdmin

### Imagens Não Aparecem
✅ URL está completa e correta?
✅ Imagem existe no servidor?
✅ Formato é JPG, PNG ou WEBP?

### Não Consigo Fazer Login
✅ Usuário: `admin` (minúsculo)
✅ Senha: `admin123`
✅ Caps Lock desativado?

### Post Não Aparece no Site
✅ Status está "Publicado"?
✅ Pressionar Ctrl+F5 (limpar cache)

---

## 📊 Boas Práticas

### Jogadores
- 📸 Use fotos com fundo neutro
- 📏 Tamanho: 400-600px largura
- ✅ Mantenha dados atualizados
- 🔄 Use "Inativo" em vez de excluir

### Posts
- 📝 Título claro e atrativo
- 📄 Texto com 400-800 palavras
- 🖼️ Sempre use imagem destacada
- 🏷️ Escolha categoria correta
- ✍️ Revise antes de publicar

### Segurança
- 🔒 Troque senha padrão
- 💾 Faça backups regulares
- 🚫 Nunca compartilhe credenciais
- 🔐 Use senhas fortes

---

## 🎨 Personalização

### Alterar Logo
```
Arquivo: admin/includes/header.php
Procurar: <img src="..." />
```

### Alterar Cores
```
Arquivo: admin/assets/css/admin.css
Procurar: :root { --primary-color: ... }
```

---

## 📞 Ajuda

### Documentação Completa
📖 Ver arquivo: `MANUAL.md`
(Manual detalhado com tudo explicado passo a passo)

### Logs de Erro
```
Locais comuns:
- error_log
- php_errors.log
- Painel da hospedagem
```

---

## 💡 Dicas Rápidas

1. **Salve rascunhos** antes de publicar
2. **Use preview** para ver como ficará
3. **Organize por categorias** desde o início
4. **Fotos menores** = site mais rápido
5. **Backup semanal** = tranquilidade
6. **Teste em mobile** também

---

## ⌨️ Atalhos do Teclado

- `Ctrl + S` - Salvar arquivo
- `Ctrl + F5` - Recarregar (limpar cache)
- `Tab` - Navegar entre campos
- `Enter` - Confirmar formulário

---

## 📱 Menu do Painel

```
📊 Dashboard    - Visão geral e estatísticas
👥 Jogadores    - Gerenciar elenco
📝 Posts        - Criar e editar notícias
🏷️ Categorias   - Organizar blog
🖼️ Galeria      - Gerenciar fotos (em breve)
⚙️ Configurações - Ajustes e senha
```

---

## ✅ Checklist Diário

```
☐ Verificar novos comentários/mensagens
☐ Postar atualização se houver notícia
☐ Revisar estatísticas do dashboard
☐ Atualizar informações se necessário
☐ Verificar se todas imagens carregam
☐ Testar funcionalidade básica
```

---

## 📅 Checklist Semanal

```
☐ Fazer backup do banco de dados
☐ Verificar posts mais lidos
☐ Limpar posts em rascunho antigos
☐ Atualizar elenco se houver mudanças
☐ Revisar e responder feedback
```

---

## 🆘 Suporte Emergencial

### Esqueci a Senha

**Via phpMyAdmin:**
1. Acessar phpMyAdmin
2. Tabela `users`
3. Usuário `admin`
4. Campo `password` = `$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi`
5. Salvar
6. Nova senha: `admin123`

### Site Fora do Ar

1. ✅ Servidor está online?
2. ✅ Banco de dados conectado?
3. ✅ Arquivo `db_credentials.php` existe?
4. ✅ Permissões de arquivo corretas?
5. ✅ Ver logs de erro

### Banco de Dados Corrompido

1. 📞 Contatar hospedagem imediatamente
2. 💾 Restaurar último backup
3. 🔍 Investigar causa do problema

---

## 📚 Recursos Úteis

### Ferramentas Online
- **TinyPNG** - Comprimir imagens
- **Coolors** - Paletas de cores
- **Unsplash** - Fotos gratuitas
- **Canva** - Criar imagens

### Hospedagem de Imagens
- **Imgur** - imgur.com
- **ImgBB** - imgbb.com
- **Postimages** - postimages.org

### Clientes FTP
- **FileZilla** - Windows/Mac/Linux
- **Cyberduck** - Mac
- **WinSCP** - Windows

---

## 📈 Métricas Importantes

### Dashboard Mostra:
- 👥 Total de jogadores ativos
- 📝 Posts publicados
- 📊 Visualizações totais
- 🏷️ Categorias ativas
- 📅 Posts recentes
- 👤 Jogadores recentes

---

**💡 Dica Final:** Mantenha este guia aberto enquanto trabalha no painel!

**🔖 Marque nos favoritos para acesso rápido**

---

*Versão 1.0 - Atualizado em 2025-12-01*
