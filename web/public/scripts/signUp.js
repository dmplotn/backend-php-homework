const signUp = async () => {
  removeErrorContainer();

  const login = document.getElementById('login').value;
  const password = document.getElementById('password').value;
  const passwordConfirmation = document.getElementById('passwordConfirmation').value;
  
  const response = await fetch('/ajax_handlers/signUp.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `login=${login}&password=${password}&passwordConfirmation=${passwordConfirmation}`
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
