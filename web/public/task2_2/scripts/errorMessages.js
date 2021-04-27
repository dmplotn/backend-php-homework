const displayValidationErrorMessages = (errors) => {
  clearErrorContainers();
  Object
    .keys(errors)
    .forEach((id) => {
      const element = document.getElementById(id);
      setErrorMessage(element, errors[id]);
    });
};

const setErrorMessage = (element, messages) => {
  const errorContainer = element.nextElementSibling;
  const errorItems = messages
    .map((message) => {
      const item = document.createElement('li');
      item.textContent = message;
      return item;
    });
  errorContainer.append(...errorItems);
};

const displayGeneralErrorMessage = (containerId, message) => {
  clearErrorContainers();
  const errorContainer = document.getElementById(containerId);
  const item = document.createElement('li');
  item.textContent = message;
  errorContainer.append(item);
};

const clearErrorContainers = () => {
  const errorContainers = document.getElementsByClassName('errorContainer');
  Array
    .from(errorContainers)
    .forEach((container) => container.innerHTML = '');
};
