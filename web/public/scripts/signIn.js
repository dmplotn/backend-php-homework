const signIn = async () => {
  removeErrorContainer();

  const login = document.getElementById('login').value;
  const password = document.getElementById('password').value;
  
  const response = await fetch('/ajax_handlers/signIn.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `login=${login}&password=${password}`
  });

  const { status, errors = [] } = await response.json();

  console.log(status, errors);

  switch (status) {
    case 'success':
      document.location.href = '/index.php';
      break;
    case 'error':
    default:
      displayErrorContainer(errors);
      break;
  }
};
