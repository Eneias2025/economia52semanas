# 💰 Sistema de Economia em 52 Semanas

Este projeto é um sistema web desenvolvido com Laravel que ajuda os usuários a economizarem dinheiro por meio de depósitos semanais durante 52 semanas. O sistema permite criar até **3 planos personalizados**, acompanhar o progresso, registrar depósitos semanais e desfazê-los em caso de erro, além de excluir planos quando necessário.
Projeto rodando em https://economia.wcsasistemas.cyou/

---

## 📌 Funcionalidades

### ✅ Criar Plano de Economia
- O usuário pode criar **até 3 planos de economia diferentes**.
- Cada plano pode ter:
  - Um **nome personalizado** (ex: “Viagem 2025”, “Reserva de Emergência”).
  - Um valor total de **meta** a ser economizado ao longo de 52 semanas.

### 📅 Geração de Depósitos Semanais
- Ao criar um plano, o sistema gera automaticamente **52 depósitos semanais**.
- Os valores seguem uma **proporção crescente**, iniciando com valores menores e aumentando progressivamente até atingir a meta total definida.

### 📈 Acompanhamento do Progresso
- Para cada plano, o sistema mostra:
  - Valor da **meta**.
  - **Total já depositado**.
  - Porcentagem de **progresso**.
  - Barra de progresso com marcos de 25%, 50%, 75% e 100%.
  - **Tabela detalhada** com as 52 semanas, data prevista, valor e status de depósito.

### ✔️ Marcar Depósito como Feito
- O usuário pode clicar no botão **"Marcar como feito"** para registrar que o depósito da semana foi realizado.

### ❌ Desfazer Depósito
- Caso o depósito tenha sido marcado por engano, o usuário pode clicar em **"Desfazer depósito"**.
- O botão é destacado em **vermelho** para indicar a ação reversa.

### 🗑️ Excluir Plano
- É possível **excluir completamente** um plano de economia, removendo também todos os depósitos associados.
- Útil em casos onde o usuário muda os objetivos ou cometeu um erro na criação do plano.

---

## 🧑‍💻 Tecnologias Utilizadas

- Laravel 10+
- Blade (Template Engine)
- Tailwind CSS (estilização e responsividade)
- Eloquent ORM (para manipulação dos dados)
- PostgreSQL, MySQL / SQLite (banco de dados)

---

## ⚙️ Como Usar

### 1. Clonar o projeto
```bash
git clone https://github.com/Eneias2025/economia52semanas.git
cd seu-repositorio