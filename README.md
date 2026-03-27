# OPM Advogados | Oliveira Pimentel & Melo Advogados Associados

![Banner OPM Advogados](assets/about-meeting.jpg)

Este repositório contém o código-fonte do website institucional da **Oliveira Pimentel & Melo Advogados Associados (OPM Advogados)**. O projeto foi desenvolvido para oferecer uma presença digital sólida e profissional, destacando a excelência do escritório em diversas áreas do Direito.

## ⚖️ Sobre o Escritório

A OPM Advogados é um escritório pautado em altos valores éticos, oferecendo assessoria jurídica de alta qualidade com foco em resultados, inovação e segurança jurídica para clientes pessoa física e jurídica.

## ✨ Funcionalidades do Website

*   **Design Institucional:** Estética sofisticada e profissional, alinhada à identidade visual do escritório.
*   **Seções Detalhadas:**
    *   **Home:** Introdução e boas-vindas.
    *   **Institucional:** Missão, Visão, Valores e história do escritório.
    *   **Especialidades:** Detalhamento da atuação em Direito Civil, Criminal e Trabalhista.
    *   **Profissionais:** Apresentação dos sócios-fundadores e suas qualificações.
    *   **Contato:** Formulário integrado e links diretos para atendimento.
*   **Geolocalização:** Integração com Google Maps para as unidades do Rio de Janeiro e Angra dos Reis.
*   **Responsividade:** Website totalmente adaptado para dispositivos móveis, tablets e desktops.
*   **Interatividade:** Efeitos de scroll (reveal), menu mobile dinâmico e validação de formulário em tempo real.

## 🚀 Tecnologias Utilizadas

*   **Frontend:** HTML5, CSS3 (Custom Properties, Flexbox, Grid), JavaScript Vanilla (ES6+).
*   **Animações:** Intersection Observer API para efeitos de revelação ao rolar a página.
*   **Ícones:** Font Awesome 6.4.0.
*   **Tipografia:** Google Fonts (Montserrat, Playfair Display, Libre Baskerville).
*   **Backend:** PHP + PHPMailer para processamento e envio do formulário de contato via SMTP.

## 📂 Estrutura do Repositório

```text
├── assets/             # Imagens, logotipos e fotos da equipe
├── php/                # Lógica de backend e biblioteca PHPMailer
├── index.html          # Página principal do website
├── opm.css             # Estilização global e componentes
├── opm.js              # Scripts de interatividade e formulários
└── README.md           # Documentação do projeto
```

## 💻 Como Configurar Localmente

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/nsouzarj/opms.git
   ```
2. **Ambiente de Execução:**
   Como o website utiliza PHP para o envio de e-mails, é necessário um servidor local como **XAMPP**, **Laragon** ou similar.
3. **Configuração de E-mail:**
   As configurações de SMTP devem ser ajustadas no arquivo `php/send_email.php` para garantir o funcionamento do formulário de contato.
4. **Visualização:**
   Acesse via `http://localhost/opms` (ou o caminho correspondente no seu servidor local).

---

### 📍 Unidades de Atendimento

*   **Rio de Janeiro:** Rua do Ouvidor, 63, Centro.
*   **Angra dos Reis:** Rua Coronel Carvalho, 13, Centro.

---
© 2026 Oliveira Pimentel & Melo Advogados Associados. Todos os direitos reservados.
