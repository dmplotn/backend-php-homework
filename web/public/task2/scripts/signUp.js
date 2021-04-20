const signUp = async () => {
  const login = document.getElementById('login').value;
  const password = document.getElementById('password').value;
  const passwordConfirmation = document.getElementById('passwordConfirmation').value;
  
  const response = await fetch('/task2/signUp.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `login=${login}&password=${password}&passwordConfirmation=${passwordConfirmation}`
  });

  const { status, errors = [] } = await response.json();

  if (status === 'success') {
    document.location.href = '/task2/index.php';
  }

  if (status === 'sign up error') {
    displayGeneralErrorMessage('signUp', errors.signUp);
  }

  if (status === 'validation error') {
    displayValidationErrorMessages(errors);
  }
};
