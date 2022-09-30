// Đối tượng `Validator`
function Validator(options) {
  var selectorRules = {};

  function getParent(element, selector) {
    while (element.parentElement) {
      if (element.parentElement.matches(selector)) {
        return element.parentElement;
      }

      element = element.parentElement;
    }
  }

  // Hàm thực hiện validate
  function validate(inputElement, rule) {
    var errorElement = getParent(
      inputElement,
      options.formGroupSelector
    ).querySelector(options.errorSelector);
    var errorMessage;

    // Lấy ra các rules của selector
    var rules = selectorRules[rule.selector];

    // Lặp qua từng rule & kiểm tra
    // Nếu có lỗi thì dừng việc kiểm tra
    for (var i = 0; i < rules.length; ++i) {
      switch (inputElement.type) {
        case "radio":
        case "checkbox":
          errorMessage = rules[i](
            formElement.querySelector(rule.selector + ":checked")
          );
          break;

        default:
          errorMessage = rules[i](inputElement.value);
          break;
      }

      if (errorMessage) break;
    }

    if (errorMessage) {
      errorElement.innerText = errorMessage;
      inputElement.classList.add("is-invalid");
    } else {
      errorElement.innerText = "";
      inputElement.classList.remove("is-invalid");
    }

    // Convert về boolean
    // true => không có lỗi
    // false => có lỗi
    return !errorMessage;
  }

  // Lấy element của form cần validate
  var formElement = document.querySelector(options.form);

  if (formElement) {
    // Lặp qua mỗi rule và xử lý (lắng nghe sự kiện blur, input, ...)
    options.rules.forEach(function (rule) {
      // Lưu lại các rules cho mỗi input
      if (Array.isArray(selectorRules[rule.selector])) {
        selectorRules[rule.selector].push(rule.test);
      } else {
        selectorRules[rule.selector] = [rule.test];
      }

      var inputElements = formElement.querySelectorAll(rule.selector);

      Array.from(inputElements).forEach(function (inputElement) {
        // Xử lý trường hợp blur khỏi input
        inputElement.onblur = function () {
          validate(inputElement, rule);
        };

        // Xử lý trường hợp mỗi khi người dùng nhập vào input
        inputElement.oninput = function () {
          var errorElement = getParent(
            inputElement,
            options.formGroupSelector
          ).querySelector(options.errorSelector);

          errorElement.innerText = "";
          getParent(inputElement, options.formGroupSelector).classList.remove(
            "invalid"
          );
        };
      });
    });

    // Khi submit form
    formElement.onsubmit = function (e) {
      e.preventDefault();

      var isValidForm = true;

      // Lặp qua từng rules và validate
      options.rules.forEach(function (rule) {
        var inputElement = formElement.querySelector(rule.selector);
        var isValid = validate(inputElement, rule);

        if (!isValid) {
          isValidForm = false;
        }
      });

      if (isValidForm) {
        // Trường hợp submit với javascript
        if (typeof options.onSubmit === "function") {
          // // Lấy các fields có attribute là name và không có attribute là disabled
          // var enableInputs = formElement.querySelectorAll(
          //   "[name]:not([disabled])"
          // );

          // // Convert NodeLists sang Array để có thể sử dụng method reduce()
          // // Lấy các values của form
          // var formValues = Array.from(enableInputs).reduce(function (
          //   values,
          //   input
          // ) {
          //   switch (input.type) {
          //     case "radio":
          //       values[input.name] = formElement.querySelector(
          //         "input[name='" + input.name + "']:checked"
          //       ).value;
          //       break;

          //     case "checkbox":
          //       if (!Array.isArray(values[input.name])) {
          //         values[input.name] = [];
          //       }

          //       if (input.matches(":checked")) {
          //         values[input.name].push(input.value);
          //       }
          //       break;

          //     case "file":
          //       values[input.name] = input.files;
          //       break;

          //     default:
          //       values[input.name] = input.value;
          //       break;
          //   }
          //   return values;
          // },
          // {});

          options.onSubmit();
        }
        // Trường hợp submit với hành vi mặc định
        else {
          formElement.submit();
        }
      }
    };
  }
}

/**
 *
 * Helper function
 */
function removeAscent(str) {
  if (str === null || str === undefined) return str;
  str = str.toLowerCase();
  str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
  str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
  str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
  str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
  str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
  str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
  str = str.replace(/đ/g, "d");
  return str;
}

/**
 * Nguyên tắc của các rules:
 * 1. Khi có lỗi => Trả ra message lỗi
 * 2. Khi hợp lệ => Không trả ra gì cả (undefined)
 */
Validator.isRequired = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      return value ? undefined : message || "Vui lòng nhập trường này";
    },
  };
};

Validator.isEmail = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return regex.test(value)
        ? undefined
        : message || "Trường này phải là email";
    },
  };
};

Validator.minLength = function (selector, min, message) {
  return {
    selector: selector,
    test: function (value) {
      return value.length >= min
        ? undefined
        : message || `Vui lòng nhập tối thiểu ${min} ký tự`;
    },
  };
};

Validator.isConfirmed = function (selector, getConfirmedValue, message) {
  return {
    selector: selector,
    test: function (value) {
      return value === getConfirmedValue()
        ? undefined
        : message || "Giá trị nhập vào không chính xác";
    },
  };
};

Validator.isNumber = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^\d+$/;
      return regex.test(value)
        ? undefined
        : message || "Trường này chỉ bao gồm các ký tự số";
    },
  };
};

Validator.isCharacters = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^[A-Za-z\s]+$/;
      return regex.test(removeAscent(value))
        ? undefined
        : message || "Trường này chỉ bao gồm ký tự chữ";
    },
  };
};

Validator.isDateOfBirth = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var inputDate = new Date(value).setHours(0, 0, 0, 0);
      var todaysDate = new Date().setHours(0, 0, 0, 0);

      return inputDate <= todaysDate
        ? undefined
        : message || "Ngày sinh không hợp lệ";
    },
  };
};

Validator.isPhoneNumber = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,5}$/im;
      return regex.test(value)
        ? undefined
        : message || "Số điện thoại không hợp lệ";
    },
  };
};