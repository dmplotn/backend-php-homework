const signIn = async () => {
  const login = document.getElementById('login').value;
  const password = document.getElementById('password').value;
  
  const response = await fetch('/task2_2/ajax_handlers/signIn.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `login=${login}&password=${password}`
  });

  const { status, errors = [] } = await response.json();

  switch (status) {
    case 'success':
      document.location.href = '/task2_2/index.php';
      break;
    case 'validation error':
      displayValidationErrorMessages(errors);
      break;
    case 'sign in error':
    case 'server error':
      displayGeneralErrorMessage('signIn', errors.signIn);
      break;
    default:
      break;
  }
};
