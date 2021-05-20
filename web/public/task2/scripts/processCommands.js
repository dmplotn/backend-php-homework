const processCommands = async () => {
  const commands = document.getElementById('commands').value;
  const response = await fetch('/task2/ajax_handlres/processCommands.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `commands=${commands}`
  });

  const { status, message, result = null } = await response.json();

  clearMessageContainers();

  switch(status) {
    case 'ok':
      displayMessage(status, message);
      displayResult(result);
      break;
    case 'error':
    default:
      displayMessage(status, message);
  }
};
