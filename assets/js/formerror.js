
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
      const name = document.getElementById('name').value.trim();
      const surname = document.getElementById('surname').value.trim();
      const username = document.getElementById('username').value.trim();
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();

      if (!name || !surname || !username || !email || !password) {
        event.preventDefault(); 

        iziToast.error({
          title: 'Hata',
          message: 'Lütfen tüm alanları doldurun.',
          position: 'topRight',
          backgroundColor: '#830000',
          theme: 'light'
        });
      }
    });
  