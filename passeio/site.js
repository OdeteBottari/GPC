document.getElementById('form-inscricao').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o envio do formulário

    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;

    // Aqui você pode adicionar lógica para enviar os dados para um servidor, se necessário

    document.getElementById('mensagem').innerText = `Obrigado pela inscrição, ${nome}! Você receberá informações no email ${email}.`;
    
    // Limpar o formulário
    this.reset();
});