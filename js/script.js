document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.button');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const role = this.href.split('=')[1];
            alert('Anda akan login sebagai ' + role);
            window.location.href = this.href;
        });
    });
});