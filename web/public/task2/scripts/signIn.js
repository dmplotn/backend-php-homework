const signIn = async () => {
  const login = document.getElementById('login').value;
  const password = document.getElementById('password').value;
  
  const response = await fetch('/task2/signIn.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `login=${login}&password=${password}`
  });

  const { status, errors = [] } = await response.json();

  if (status === 'success') {
    document.location.href = '/task2/index.php';
  }

  if (status === 'sign in error') {
    displayGeneralErrorMessage('signIn', errors.signIn);
  }

  if (status === 'validation error') {
    displayValidationErrorMessages(errors);
  }
};
