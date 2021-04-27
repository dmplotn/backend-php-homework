const signUp = async () => {
  const login = document.getElementById('login').value;
  const password = document.getElementById('password').value;
  const passwordConfirmation = document.getElementById('passwordConfirmation').value;
  
  const response = await fetch('/task2_2/ajax_handlers/signUp.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `login=${login}&password=${password}&passwordConfirmation=${passwordConfirmation}`
  });

  const { status, errors = [] } = await response.json();

  switch (status) {
    case 'success':
      document.location.href = '/task2_2/index.php';
      break;
    case 'validation error':
      displayValidationErrorMessages(errors);
      break;
    case 'sign up error':
    case 'server error':
      displayGeneralErrorMessage('signUp', errors.signUp);
      break;
    default:
      break;
  }
};
