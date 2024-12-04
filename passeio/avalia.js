document.getElementById('evaluationForm').addEventListener('submit', function(event) {
    const rating = document.getElementById('rating').value;

    if (rating < 1 || rating > 5) {
        event.preventDefault();
        document.getElementById('message').innerText = 'Por favor, insira uma nota válida entre 1 e 5.';
        document.getElementById('message').style.color = 'red';
    } else {
        document.getElementById('message').innerText = '';
    }
});