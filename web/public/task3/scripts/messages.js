const clearMessageContainers = () => {
  const successMessageContainer = document.getElementById('successMessageContainer');
  const errorMessageContainer = document.getElementById('errorMessageContainer');

  successMessageContainer.innerHTML = '';
  errorMessageContainer.innerHTML = '';
}

const clearPropertyContainer = () => {
  const propertyContainer = document.getElementById('propertyContainer');
  propertyContainer.innerHTML = '';
};

const displayMessage = (status, message) => {
  let containerId;
  switch (status) {
    case 'success':
      containerId = 'successMessageContainer';
      break;
    case 'validationError':
    case 'unknownParamError':
    case 'serverError':
      containerId = 'errorMessageContainer';
      break;
    default:
      break;
  }

  const container = document.getElementById(containerId);
  container.textContent = message;
};
