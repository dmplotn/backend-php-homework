const displayProperties = async () => {
  clearPropertyContainer();

  const workerType = document.getElementById('workerType').value;
  const response = await fetch(`/task3/ajax_handlers/getProperties.php?workerType=${workerType}`, {
    method: 'GET',
  });
  
  const { status, properties, message } = await response.json();
  
  console.log(message);

  if (status === 'unknownParamError') {
    displayMessage(status, message);
    return;
  }

  updateProperties(properties);
};

const updateProperties = (properties) => {
  clearPropertyContainer();
  clearMessageContainers();

  const container = document.getElementById('propertyContainer');

  const inputFields = properties.map((propertyName) => {
    const input = document.createElement('input');
    input.type = 'text';
    input.id = propertyName;
    input.classList.add('border-2', 'border-gray-300');

    const label = document.createElement('label');
    label.for = propertyName;
    label.textContent = propertyName;

    const pInput = document.createElement('p');
    pInput.append(input);

    const pLabel = document.createElement('p');
    pLabel.append(label);

    const div = document.createElement('div');
    div.classList.add('mb-4');
    div.append(pLabel, pInput);

    return div;
  });

  container.append(...inputFields);
};

const clearPropertyInputs = () => {
  Array
    .from(document.getElementsByTagName('input'))
    .forEach((input) => input.value = '');
};
