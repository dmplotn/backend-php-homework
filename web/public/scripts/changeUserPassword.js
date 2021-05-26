const changeUserPassword = async () => {
  removeErrorContainer();

  const newPassword = document.getElementById('newPassword').value;
  const passwordConfirmation = document.getElementById('passwordConfirmation').value;
  const searchParams = new URLSearchParams(window.location.search);
  const id = searchParams.get('id');

  const response = await fetch('/ajax_handlers/changeUserPassword.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `newPassword=${newPassword}&passwordConfirmation=${passwordConfirmation}&id=${id}`
  });

  const { status, errors = [] } = await response.json();

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
