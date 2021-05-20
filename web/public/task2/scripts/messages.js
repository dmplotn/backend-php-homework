const clearMessageContainers = () => {
  const errorMessageContainer = document.getElementById('errorMessageContainer');
  const successMessageContainer = document.getElementById('successMessageContainer');
  const resultContainer = document.getElementById('resultContainer');
  errorMessageContainer.innerHTML = '';
  successMessageContainer.innerHTML = '';
  resultContainer.innerHTML = '';
};

const displayMessage = (status, message) => {
  let containterId;
  switch (status) {
    case 'ok':
      containterId = 'successMessageContainer';
      break;
    case 'error':
    default:
      containterId = 'errorMessageContainer';
  }

  const messageContainer = document.getElementById(containterId);
  messageContainer.innerText = message;
};

const displayResult = (result) => {
  const resultContainer = document.getElementById('resultContainer');
  resultContainer.innerText = `Результат: "${result}"`;
};