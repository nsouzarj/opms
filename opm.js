// OPM Advogados - Script Principal

document.addEventListener('DOMContentLoaded', () => {
    console.log('OPM Script Iniciado');

    // 1. Efeito do cabeçalho ao rolar
    const header = document.getElementById('main-header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    // 2. Menu Mobile
    const mobileBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (mobileBtn && navLinks) {
        mobileBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            const icon = mobileBtn.querySelector('i');
            if (icon) {
                if (navLinks.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });

        // Fechar menu ao clicar em um link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                const icon = mobileBtn.querySelector('i');
                if (icon) {
                    icon.classList.add('fa-bars');
                    icon.classList.remove('fa-times');
                }
            });
        });
    }

    // 3. Animações de Scroll (Reveal)
    if ('IntersectionObserver' in window) {
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-up, .animate-left, .animate-right, .fade-in').forEach(el => {
            observer.observe(el);
        });
    } else {
        // Fallback para navegadores sem IntersectionObserver
        document.querySelectorAll('.animate-up, .animate-left, .animate-right, .fade-in').forEach(el => {
            el.style.opacity = '1';
            el.style.transform = 'none';
        });
    }

    // 4. Lógica do Formulário de Contato
    const contactForm = document.getElementById('contact-form');
    const formStatus = document.getElementById('form-status');

    if (contactForm && formStatus) {
        console.log('Configurando formulário de contato');
        contactForm.addEventListener('submit', async function(e) {
            // CRÍTICO: Prevenir o recarregamento da página IMEDIATAMENTE
            e.preventDefault();
            console.log('Iniciando envio do formulário...');

            // Estado de carregamento
            formStatus.className = 'form-status'; // Limpa classes anteriores
            formStatus.style.display = 'block';
            formStatus.textContent = 'Enviando mensagem...';
            
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.disabled = true;

            const formData = new FormData(contactForm);

            try {
                const response = await fetch('php/send_email.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Resposta do Servidor:', response.status, errorText);
                    throw new Error(`Erro ${response.status}: Falha na comunicação com o servidor. Verifique o console (F12) para detalhes.`);
                }

                const result = await response.json();

                if (result.success) {
                    formStatus.classList.add('success');
                    formStatus.textContent = result.message || 'Mensagem enviada com sucesso! Logo entraremos em contato.';
                    contactForm.reset();
                } else {
                    throw new Error(result.message || 'Ocorreu um erro ao enviar sua mensagem.');
                }
            } catch (error) {
                console.error('Erro no envio:', error);
                formStatus.classList.add('error');
                formStatus.textContent = error.message;
            } finally {
                if (submitBtn) submitBtn.disabled = false;
            }
        });
    } else {
        console.error('Formulário (#contact-form) ou Status (#form-status) não encontrados no DOM.');
    }
});
