const getCurrentRatesData = () => {
  return JSON.parse(document.getElementById('current-rates-data').dataset.currentRatesData);
};

const sell = (value, rate) => {
  return value * rate;
}

const buy = (value, rate) => {
  return value / rate;
};

const format = (value) => {
  const formatter = new Intl.NumberFormat('ru-RU', {
    minimumFractionDigits: 2, maximumFractionDigits: 2 
  });
  return formatter.format(value).replace(',', '.');
};

const renderConverter = (state) => {
  const changeResult = document.getElementById('change-result');
  const changeValueInput = document.getElementById('change-value-input');
  const changeValueIso = document.getElementById('change-value-iso');
  const changeResultInput = document.getElementById('change-result-input');
  const orderSubmit = document.getElementById('order-submit');

  changeValueIso.textContent = state.changeValueIso;

  changeResult.textContent = '';

  if (state.afterSelect) {
    changeValueInput.value = '';
  }
  
  if (!state.changeValueInput.valid) {
    changeValueInput.classList.add('is-invalid');
    const changeValueInputError = document.getElementById('change-value-input-error');
    changeValueInputError.textContent = state.changeValueInput.error;
    orderSubmit.setAttribute('disabled', 'disabled');
  } else {
    changeValueInput.classList.remove('is-invalid');
    orderSubmit.setAttribute('disabled', 'disabled');

    if (state.value !== null) {
      const result = state.operation(state.value, state.rateData.currencyRate);
      const formattedResult = format(result);
      const currencyIso = state.operationType === 'sell' ? 'RUB' : state.rateData.currencyIso;
      changeResult.textContent = `Вы получите: ${formattedResult} ${currencyIso}`; 
      changeResultInput.value = result;
      orderSubmit.removeAttribute('disabled');
    }
  }
}

const restoreChangeForm = (state) => {
  if (!state.orderNameInput.error) {
    state.orderNameInput.valid = true;
  }
  const orderNameInput = document.getElementById('order-name-input');
  orderNameInput.classList.remove('is-invalid');

  if (!state.orderEmailInput.error) {
    state.orderEmailInput.valid = true;
  }
  const orderEmailInput = document.getElementById('order-email-input');
  orderEmailInput.classList.remove('is-invalid');

  if (!state.orderPhoneNumberInput.error) {
    state.orderPhoneNumberInput.valid = true;
  }
  const orderPhoneNumberInput = document.getElementById('order-phone-number-input');
  orderPhoneNumberInput.classList.remove('is-invalid');
}

const renderChangeForm = (state) =>  {
  restoreChangeForm(state);

  if (!state.orderNameInput.valid) {
    const orderNameInput = document.getElementById('order-name-input');
    orderNameInput.classList.add('is-invalid');

    const orderNameError = document.getElementById('order-name-error');
    orderNameError.textContent = state.orderNameInput.error;
  }

  if (!state.orderEmailInput.valid) {
    const orderEmailInput = document.getElementById('order-email-input');
    orderEmailInput.classList.add('is-invalid');

    const orderEmailError = document.getElementById('order-email-error');
    orderEmailError.textContent = state.orderEmailInput.error;
  }

  if (!state.orderPhoneNumberInput.valid) {
    const orderPhoneNumberInput = document.getElementById('order-phone-number-input');
    orderPhoneNumberInput.classList.add('is-invalid');

    const orderPhoneNumberError = document.getElementById('order-phone-number-error');
    orderPhoneNumberError.textContent = state.orderPhoneNumberInput.error;
  }
};

const validateChangeValueInput = (state) => {
  const pattern = /^[0-9]+(\.[0-9]{1,2})?$/;
  
  if (state.changeValueInput.value === '') {
    return true;
  }

  if (!state.changeValueInput.value.match(pattern)) {
    state.changeValueInput.error = 'Значение не соостветствует формату валюты';
    return false;
  }

  const value = parseFloat(state.changeValueInput.value);

  if (value <= 0 || value > 1000000) {
    state.changeValueInput.error = 'Значение должено быть от 0 до 1 млн';
    return false;
  }

  return true;
};

const validateOrderNameInput = (state) => {
  const length = state.orderNameInput.value.length;

  if (length < 2 || length > 100) {
    state.orderNameInput.valid = false;
    state.orderNameInput.error = 'Длина имени от 2 до 100';
    return false;
  }

  state.orderNameInput.valid = true;
  return true;
};

const validateOrderEmailInput = (state) => {
  const pattern = /^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/;

  if (!state.orderEmailInput.value.match(pattern)) {
    state.orderEmailInput.valid = false;
    state.orderEmailInput.error = 'Значение не соостветствует формату email';
    return false;
  }

  state.orderEmailInput.valid = true;
  return true;
};

const validateOrderPhoneNumberInput = (state) => {
  const pattern = /^\+?[78][-\(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/;

  if (!state.orderPhoneNumberInput.value.match(pattern)) {
    state.orderPhoneNumberInput.valid = false;
    state.orderPhoneNumberInput.error = 'Значение не соостветствует формату тел.номера';
    return false;
  }

  state.orderPhoneNumberInput.valid = true;
  return true;
};

const validateChangeForm = (state) => {
  const validationNameResult = validateOrderNameInput(state);
  const validationEmailResult = validateOrderEmailInput(state);
  const validationPhoneResult = validateOrderPhoneNumberInput(state);

  return validationNameResult && validationEmailResult && validationPhoneResult;
};

const change = () => {
  const currentRatesData = getCurrentRatesData();

  const changeForm = document.getElementById('change-form');

  const operationSelect = document.getElementById('operation');
  const operationType = operationSelect[operationSelect.selectedIndex].value;
  const operation = (operationType === 'sell') ? sell : buy;
  
  const currencySelect = document.getElementById('currency');
  const currencyId = parseInt(currencySelect[currencySelect.selectedIndex].value, 10);
  const rateData = currentRatesData.find((item) => item.currencyId === currencyId);

  const changeValueInput = document.getElementById('change-value-input');
  const changeValueIso = operationType === 'sell' ? rateData.currencyIso : 'RUB';

  const orderNameInput = document.getElementById('order-name-input');
  const orderPhoneNumberInput = document.getElementById('order-phone-number-input');
  const orderEmailInput = document.getElementById('order-email-input');

  const state = {
    value: null,
    rateData,
    operationType,
    operation,
    changeValueIso,
    afterSelect: true,
    changeValueInput: {
      valid: true,
    },
    orderNameInput: {},
    orderPhoneNumberInput: {},
    orderEmailInput: {}
  };

  changeValueInput.addEventListener('keyup', (e) => {
    state.changeValueInput.value = changeValueInput.value;

    if (validateChangeValueInput(state)) {
      state.changeValueInput.valid = true;
      state.value = state.changeValueInput.value === '' ? null : parseFloat(state.changeValueInput.value);
    } else {
      state.changeValueInput.valid = false;
    }

    state.afterSelect = false;

    renderConverter(state);
  });

  operationSelect.addEventListener('change', (e) => {
    const currencyId = parseInt(currencySelect[currencySelect.selectedIndex].value, 10);
    const rateData = currentRatesData.find((item) => item.currencyId === currencyId);
    const operationType = operationSelect[operationSelect.selectedIndex].value;
    const operation = operationType === 'sell' ? sell : buy;
    const changeValueIso = operationType === 'sell' ? rateData.currencyIso : 'RUB';

    state.value = null;
    state.changeValueInput.valid = true;
    state.changeValueIso = changeValueIso;
    state.operationType = operationType;
    state.operation = operation;
    state.afterSelect = true;

    renderConverter(state);
  });

  currencySelect.addEventListener('change', (e) => {
    const currencyId = parseInt(currencySelect[currencySelect.selectedIndex].value, 10);
    const rateData = currentRatesData.find((item) => item.currencyId === currencyId);
    const changeValueIso = state.operationType === 'sell' ? rateData.currencyIso : 'RUB';

    state.value = null;
    state.changeValueIso = changeValueIso;
    state.changeValueInput.valid = true;
    state.rateData = rateData;
    state.afterSelect = true;

    renderConverter(state);
  });

  changeForm.addEventListener('submit', (e) => {
    state.orderNameInput.value = orderNameInput.value;
    state.orderPhoneNumberInput.value = orderPhoneNumberInput.value;
    state.orderEmailInput.value = orderEmailInput.value;

    if (!validateChangeForm(state)) {
      renderChangeForm(state);
      e.preventDefault();
      return false;
    }
  });

  renderConverter(state);
};

change();
