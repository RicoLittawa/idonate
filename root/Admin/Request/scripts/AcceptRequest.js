let count = 0;
/***********************************Populate select options***********************************************/
const populateSelectOptions = (select, product, quantity, unit, type) => {
  select.empty();
  select.append("<option value=''>Select Product</option>");

  for (let i = 0; i < product.length; i++) {
    const productValue = product[i];
    const quantityValue = quantity[i];
    const unitValue = unit[i];
    const typeValue = type[i];

    let optionText = `${productValue} (${quantityValue})`;

    if (quantityValue <= 0) {
      optionText = `${productValue} (Out of stock)`;
    }

    if (unitValue && typeValue) {
      optionText = `${productValue} ${typeValue} (${quantityValue} ${unitValue})`;
    }

    const option = new Option(optionText);
    select.append(option);
  }
};

const populateData = (select, category) => {
  $.ajax({
    url: "../include/getproduct.php",
    method: "GET",
    dataType: "json",
    success: (response) => {
      const product = response[`${category}Product`];
      const quantity = response[`${category}Quantity`];
      const unit = response[`${category}Unit`];
      const type = response[`${category}Type`];

      populateSelectOptions(select, product, quantity, unit, type);
    },
  });
};

const populateCanNoodles = (select) => {
  populateData(select, 'CanNoodles');
};

const populateHygineEssentials = (select) => {
  populateData(select, 'HygineEssential');
};

const populateInfantItems = (select) => {
  populateData(select, 'InfantItems');
};

const populateDrinkingWater = (select) => {
  populateData(select, 'DrinkingWater');
};

const populateMeatGrains = (select) => {
  populateData(select, 'MeatGrains');
};

const populateMedicine = (select) => {
  populateData(select, 'Medicine');
};

const populateOthers = (select) => {
  populateData(select, 'Others');
};

/***********************************Get others data***********************************************/

/***********************************Add new product***********************************************/
const appendNewProduct = (
  tableBody,
  buttontype,
  categoryAttribute,
  selectClassName,
  quantityClassname
) => {
  let remove =
    count > 0
      ? '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>'
      : "";
  let selectOption = $(
    `<select class="form-select ${selectClassName}"></select>`
  );
  let html = `
        <tr>
          <td>${selectOption.prop("outerHTML")}
          </td>
          <td>
            <div class="d-flex justify-content-center border">
              <button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="${categoryAttribute}"><i class="fa-solid fa-minus"></i></button>
              <input type="number" class="form-control quantity ${quantityClassname}" value="0" data-input-category="${categoryAttribute}">
              <button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="${categoryAttribute}"><i class="fa-solid fa-plus"></i></button>
            </div>
          </td>
          <td>${remove}</td>
        </tr>
      `;
  tableBody.append(html);
  let select;
  switch (buttontype) {
    case "01":
      select = tableBody.find(`tr:last-child .${selectClassName}`);
      populateCanNoodles(select);
      break;
    case "02":
      select = tableBody.find(`tr:last-child  .${selectClassName}`);
      populateHygineEssentials(select);
      break;
    case "03":
      select = tableBody.find(`tr:last-child  .${selectClassName}`);
      populateInfantItems(select);
      break;
    case "04":
      select = tableBody.find(`tr:last-child  .${selectClassName}`);
      populateDrinkingWater(select);
      break;
    case "05":
      select = tableBody.find(`tr:last-child  .${selectClassName}`);
      populateMeatGrains(select);
      break;
    case "06":
      select = tableBody.find(`tr:last-child  .${selectClassName}`);
      populateMedicine(select);
      break;
    default:
      select = tableBody.find(`tr:last-child  .${selectClassName}`);
      populateOthers(select);
  }
};
/***********************************Add new product***********************************************/

/***********************************Remove new added rows of table************************************************/
$(document).on("click", ".remove", function () {
  $(this).closest("tr").remove();
});
/***********************************Remove new added rows of table************************************************/

/***********************************Add new row when button is click***********************************************/
const addNewRow = (
  buttonId,
  number,
  CategoryName,
  selectClassName,
  quantityClassname,
  invalidProduct,
  invalidQuantity
) => {
  $(document).on("click", buttonId, (e) => {
    e.stopImmediatePropagation();
    let tableBody = $(`tbody[data-body-category="${CategoryName}"]`);
    count++;
    appendNewProduct(
      tableBody,
      number,
      CategoryName,
      selectClassName,
      quantityClassname,
      invalidProduct,
      invalidQuantity
    );
  });
};
addNewRow(
  "#can-noodles",
  "01",
  "CanNoodles",
  "can-noodles-product",
  "can-noodles-quantity"
);
addNewRow(
  "#hygine-essentials",
  "02",
  "Hygine",
  "hygine-essentials-product",
  "hygine-essentials-quantity"
);
addNewRow(
  "#infant-items",
  "03",
  "InfantItems",
  "infant-items-product",
  "infant-items-quantity"
);
addNewRow(
  "#drinking-water",
  "04",
  "DrinkingWater",
  "drinking-water-product",
  "drinking-water-quantity"
);
addNewRow(
  "#meat-grains",
  "05",
  "MeatGrains",
  "meat-grains-product",
  "meat-grains-quantity"
);
addNewRow(
  "#medicine",
  "06",
  "Medicine",
  "medicine-product",
  "medicine-quantity"
);
addNewRow("#others", "07", "Others", "others-product", "others-quantity");
/***********************************Add new row when button is click***********************************************/

/***********************************Minus and plus button functionality***********************************************/
$(document).on("click", ".btnAdd, .btnMinus", function (event) {
  event.stopImmediatePropagation();
  const targetRow = $(this).closest("tr");
  const type = $(this).data("btn-category");
  const $quantity = targetRow.find(`.quantity[data-input-category="${type}"]`);
  let value = parseInt($quantity.val(), 10) || 0;
  value += $(this).hasClass("btnAdd") ? 1 : value > 0 ? -1 : 0;
  $quantity.val(value);
});
/***********************************Minus and plus button functionality***********************************************/

/***********************************Populate product options for existing select elements***********************************************/
populateCanNoodles($(".can-noodles-product"));
populateHygineEssentials($(".hygine-essentials-product"));
populateInfantItems($(".infant-items-product"));
populateDrinkingWater($(".drinking-water-product"));
populateMeatGrains($(".meat-grains-product"));
populateMedicine($(".medicine-product"));
populateOthers($(".others-product"));
/***********************************Populate product options for existing select elements***********************************************/

/***********************************Submit data***********************************************/
$(document).on("submit", (e) => {
  e.preventDefault();
  let request_id = $("#request_id").val();
  let categoryFields = {
    CanNoodles: {
      product: [],
      quantity: [],
    },
    HygineEssentials: {
      product: [],
      quantity: [],
    },
    InfantItems: {
      product: [],
      quantity: [],
    },
    DrinkingWater: {
      product: [],
      quantity: [],
    },
    MeatGrains: {
      product: [],
      quantity: [],
      type: [],
      unit: [],
    },
    Medicine: {
      product: [],
      quantity: [],
      type: [],
      unit: [],
    },
    Others: {
      product: [],
      quantity: [],
      type: [],
      unit: [],
    },
  };

  let isInvalid = false;

  /***********************************Check if input fields are empty if not then push data to category object***********************************************/
  const checkIfEmpty = (
    classNameProduct,
    classNameQuantity,
    inputFieldProduct,
    inputFieldQuantity
  ) => {
    $(classNameProduct).each((index, element) => {
      if ($(element).val() == "") {
        $(element).addClass("is-invalid");
        isInvalid = true;
      } else {
        inputFieldProduct.push($(element).val());
        $(element).removeClass("is-invalid");
      }
    });
    $(classNameQuantity).each((index, element) => {
      if ($(element).val() <= 0) {
        $(element).addClass("is-invalid");
        isInvalid = true;
      } else {
        inputFieldQuantity.push($(element).val());
        $(element).removeClass("is-invalid");
      }
    });
  };
  checkIfEmpty(
    ".can-noodles-product",
    ".can-noodles-quantity",
    categoryFields.CanNoodles.product,
    categoryFields.CanNoodles.quantity
  );
  checkIfEmpty(
    ".hygine-essentials-product",
    ".hygine-essentials-quantity",
    categoryFields.HygineEssentials.product,
    categoryFields.HygineEssentials.quantity
  );
  checkIfEmpty(
    ".infant-items-product",
    ".infant-items-quantity",
    categoryFields.InfantItems.product,
    categoryFields.InfantItems.quantity
  );
  checkIfEmpty(
    ".drinking-water-product",
    ".drinking-water-quantity",
    categoryFields.DrinkingWater.product,
    categoryFields.DrinkingWater.quantity
  );
  checkIfEmpty(
    ".meat-grains-product",
    ".meat-grains-quantity",
    categoryFields.MeatGrains.product,
    categoryFields.MeatGrains.quantity
  );
  checkIfEmpty(
    ".medicine-product",
    ".medicine-quantity",
    categoryFields.Medicine.product,
    categoryFields.Medicine.quantity
  );
  checkIfEmpty(
    ".others-product",
    ".others-quantity",
    categoryFields.Others.product,
    categoryFields.Others.quantity
  );
  /***********************************Check if input fields are empty if not then push data to category object***********************************************/

  /***********************************Save to data***********************************************/
  let data = {
    submitProcess: "",
    request_id: request_id,
    CanNoodlesProduct: categoryFields.CanNoodles.product,
    CanNoodlesQuantity: categoryFields.CanNoodles.quantity,
    HygineProduct: categoryFields.HygineEssentials.product,
    HygineQuantity: categoryFields.HygineEssentials.quantity,
    InfantProduct: categoryFields.InfantItems.product,
    InfantQuantity: categoryFields.InfantItems.quantity,
    DrinkingWaterProduct: categoryFields.DrinkingWater.product,
    DrinkingWaterQuantity: categoryFields.DrinkingWater.quantity,
    MeatGrainsProduct: categoryFields.MeatGrains.product,
    MeatGrainsQuantity: categoryFields.MeatGrains.quantity,
    MedicineProduct: categoryFields.Medicine.product,
    MedicineQuantity: categoryFields.Medicine.quantity,
    OthersProduct: categoryFields.Others.product,
    OthersQuantity: categoryFields.Others.quantity,
  };

  /****************Alert function********************************************************************/
  const alertMessage = (title, text, icon) => {
    Swal.fire({
      title: title,
      text: text,
      icon: icon,
      confirmButtonColor: "#20d070",
      confirmButtonText: "OK",
      allowOutsideClick: false,
    });
  };
  const resetBtnLoadingState = () => {
    $('button[type="submit"]').prop("disabled", false);
    $(".submit-text").text("Process");
    $(".spinner-border").addClass("d-none");
  };
  /****************Alert function********************************************************************/

  /***********************************Save to data***********************************************/ /***********************************Check if out of stock***********************************************/
  const checkIfOutOfStock = (quantity, product, itemName, quantityField) => {
    for (let i = 0; i < quantity.length; i++) {
      $(quantityField).each((i, element) => {
        if (+quantity[i] > +product[i]) {
          alertMessage(
            "Warning",
            `We dont have enough stocks of ${itemName[i]}`,
            "warning"
          );
          $(element).addClass("is-invalid");
          isInvalid = true;
        } else {
          $(element).removeClass("is-invalid");
        }
      });
    }
  };
  /***********************************Check if out of stock***********************************************/

  /***********************************Check product if exist and compare input to quantity of the product***********************************************/
  const checkProductsIfExist = (categoryFields) => {
    for (const category in categoryFields) {
      if (categoryFields[category].product.length > 0) {
        $.ajax({
          url: "../include/getproduct.php",
          method: "GET",
          dataType: "json",
          success: (response) => {
            switch (category) {
              case "CanNoodles":
                const commonCanNoodles = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.CanNoodlesProduct.indexOf(productValue);
                    return response.CanNoodlesQuantity[index];
                  }
                );
                const cnTotalQuantity = categoryFields[category].quantity;
                const cnName = categoryFields[category].product;
                const cnQuantityData = $(".can-noodles-quantity");
                checkIfOutOfStock(
                  cnTotalQuantity,
                  commonCanNoodles,
                  cnName,
                  cnQuantityData
                );
                break;
              case "HygineEssentials":
                const commonHygine = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.HygineEssentialProduct.indexOf(productValue);
                    return response.HygineEssentialQuantity[index];
                  }
                );
                const hyTotalQuantity = categoryFields[category].quantity;
                const hyName = categoryFields[category].product;
                const hyQuantityData = $(".hygine-essentials-quantity");
                checkIfOutOfStock(
                  hyTotalQuantity,
                  commonHygine,
                  hyName,
                  hyQuantityData
                );
                break;
              case "InfantItems":
                const commonInfant = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.InfantItemsProduct.indexOf(productValue);
                    return response.InfantItemsQuantity[index];
                  }
                );
                const iiTotalQuantity = categoryFields[category].quantity;
                const iiName = categoryFields[category].product;
                const iiQuantityData = $(".infant-items-quantity");
                checkIfOutOfStock(
                  iiTotalQuantity,
                  commonInfant,
                  iiName,
                  iiQuantityData
                );
                break;
              case "DrinkingWater":
                const commonDrinks = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.DrinkingWaterProduct.indexOf(productValue);
                    return response.DrinkingWaterQuantity[index];
                  }
                );
                const dwTotalQuantity = categoryFields[category].quantity;
                const dwName = categoryFields[category].product;
                const dwQuantityData = $(".drinking-water-quantity");
                checkIfOutOfStock(
                  dwTotalQuantity,
                  commonDrinks,
                  dwName,
                  dwQuantityData
                );
                break;
              case "MeatGrains":
                const commonMeatGrains = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.MeatGrainsProduct.indexOf(productValue);
                    return response.MeatGrainsQuantity[index];
                  }
                );
                const mgTotalQuantity = categoryFields[category].quantity;
                const mgName = categoryFields[category].product;
                const mgQuantityData = $(".meat-grains-quantity");
                checkIfOutOfStock(
                  mgTotalQuantity,
                  commonMeatGrains,
                  mgName,
                  mgQuantityData
                );
                break;
              case "Medicine":
                const commonMedicine = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.MedicineProduct.indexOf(productValue);
                    return response.MedicineQuantity[index];
                  }
                );
                const meTotalQuantity = categoryFields[category].quantity;
                const meName = categoryFields[category].product;
                const meQuantityData = $(".medicine-quantity");
                checkIfOutOfStock(
                  meTotalQuantity,
                  commonMedicine,
                  meName,
                  meQuantityData
                );
                break;
              case "Others":
                const commonOthers = categoryFields[category].product.map(
                  (productValue) => {
                    const index = response.OthersProduct.indexOf(productValue);
                    return response.OthersQuantity[index];
                  }
                );
                const otTotalQuantity = categoryFields[category].quantity;
                const otName = categoryFields[category].product;
                const otQuantityData = $(".others-quantity");
                checkIfOutOfStock(
                  otTotalQuantity,
                  commonOthers,
                  otName,
                  otQuantityData
                );
                break;
            }
          },
          error: () => {
            console.log("Failed to get products data.");
          },
        });
      }
    }
    setTimeout(() => {
      if (!isInvalid) {
        Swal.fire({
          title: "Confirm",
          text: "Click yes to confirm",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#20d070",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, process it",
          reverseButtons: true,
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "include/ProcessRequest.php",
              method: "POST",
              data: data,
              beforeSend: () => {
                $('button[type="submit"]').prop("disabled", true);
                $(".submit-text").text("Processing...");
                $(".spinner-border").removeClass("d-none");
              },
              success: (data) => {
                if (data == "success") {
                  setTimeout(() => {
                    resetBtnLoadingState();
                    alertMessage(
                      "Success",
                      "Your request is created",
                      "success"
                    );
                    setTimeout(() => {
                      window.location.href = "Request.php";
                    }, 1000);
                  }, 1500);
                } else {
                  resetBtnLoadingState();
                  alertMessage("Error", data, "error");
                }
              },
              error: (xhr, status, error) => {
                resetBtnLoadingState();
                alertMessage("Error", xhr.responseText, "error");
              },
            });
          }
        });
      }
    }, 500);
  };
  checkProductsIfExist(categoryFields);
  /***********************************Check product if exist and compare input to quantity of the product***********************************************/
});
