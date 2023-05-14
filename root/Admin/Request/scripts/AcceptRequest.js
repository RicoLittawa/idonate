let count = 0;
/***********************************Populate select options***********************************************/
const selectOptionPopulated = (select, product, quantity) => {
  select.empty();
  select.append("<option value=''>Select Product</option>");
  for (let i = 0; i < product.length; i++) {
    let productValue = product[i];
    let quantityValue = quantity[i];
    let optionText = productValue + " (" + quantityValue + " pcs)";
    if (quantityValue <= 0) {
      optionText = `${productValue} (Out of stock)`;
    }
    let option = new Option(optionText, productValue);
    select.append(option);
  }
};
/***********************************Populate select options***********************************************/

/***********************************Get can noodles data***********************************************/
const populateCanNoodles = (select) => {
  $.ajax({
    url: "../include/getproduct.php",
    method: "GET",
    dataType: "json",
    success: (response) => {
      let product = response.CanNoodlesProduct;
      let quantity = response.CanNoodlesQuantity;
      selectOptionPopulated(select, product, quantity);
    },
  });
};
/***********************************Get can noodles data***********************************************/

/***********************************Get hygine essentials data***********************************************/
const populateHygineEssentials = (select) => {
  $.ajax({
    url: "../include/getproduct.php",
    method: "GET",
    dataType: "json",
    success: (response) => {
      let product = response.HygineEssentialProduct;
      let quantity = response.HygineEssentialQuantity;
      selectOptionPopulated(select, product, quantity);
    },
  });
};
/***********************************Get hygine essentials data***********************************************/

/***********************************Get infant items data***********************************************/
const populateInfantItems = (select) => {
  $.ajax({
    url: "../include/getproduct.php",
    method: "GET",
    dataType: "json",
    success: (response) => {
      let product = response.InfantItemsProduct;
      let quantity = response.InfantItemsQuantity;
      selectOptionPopulated(select, product, quantity);
    },
  });
};
/***********************************Get infant items data***********************************************/

/***********************************Get drinking water data***********************************************/
const populateDrinkingWater = (select) => {
  $.ajax({
    url: "../include/getproduct.php",
    method: "GET",
    dataType: "json",
    success: (response) => {
      let product = response.DrinkingWaterProduct;
      let quantity = response.DrinkingWaterQuantity;
      selectOptionPopulated(select, product, quantity);
    },
  });
};
/***********************************Get drinking water data***********************************************/

/***********************************Get meat grains data***********************************************/
const populateMeatGrains = (select) => {
  $.ajax({
    url: "../include/getproduct.php",
    method: "GET",
    dataType: "json",
    success: (response) => {
      let product = response.MeatGrainsProduct;
      let quantity = response.MeatGrainsQuantity;
      selectOptionPopulated(select, product, quantity);
    },
  });
};
/***********************************Get meat grains data***********************************************/

/***********************************Get medicine data***********************************************/
const populateMedicine = (select) => {
  $.ajax({
    url: "../include/getproduct.php",
    method: "GET",
    dataType: "json",
    success: (response) => {
      let product = response.MedicineProduct;
      let quantity = response.MedicineQuantity;
      selectOptionPopulated(select, product, quantity);
    },
  });
};
/***********************************Get medicine data***********************************************/

/***********************************Get others data***********************************************/
const populateOthers = (select) => {
  $.ajax({
    url: "../include/getproduct.php",
    method: "GET",
    dataType: "json",
    success: (response) => {
      let product = response.OthersProduct;
      let quantity = response.OthersQuantity;
      selectOptionPopulated(select, product, quantity);
    },
  });
};
/***********************************Get others data***********************************************/

/***********************************Add new product***********************************************/
const appendNewProduct = (
  tableBody,
  buttontype,
  categoryAttribute,
  selectClassName,
  quantityClassname,
  invalidProduct,
  invalidQuantity
) => {
  let remove =
    count > 0
      ? '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>'
      : "";
  let selectOption = $(
    `<select class="form-control ${selectClassName}"></select>`
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
  "can-noodles-quantity",
  "cn-invalid-product",
  "cn-invalid-quantity"
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
  /***********************************Save to data***********************************************/ /***********************************Check if out of stock***********************************************/
  const checkIfOutOfStock = (quantity, product, itemName, quantityField) => {
    for (let i = 0; i < quantity.length; i++) {
      $(quantityField).each( (i,element)=> {
        if (+quantity[i] > +product[i]) {
          swal.fire(
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
                $('button[type="submit"]').prop("disabled", false);
                $(".submit-text").text("Process");
                $(".spinner-border").addClass("d-none");
                Swal.fire({
                  title: "Success",
                  text: "Your request is created",
                  icon: "success",
                  confirmButtonColor: "#20d070",
                  confirmButtonText: "OK",
                  allowOutsideClick: false,
                });
                setTimeout(() => {
                  window.location.href = "Request.php";
                }, 1000);
              }, 1500);
            } else {
              Swal.fire({
                title: "Error",
                text: data,
                icon: "error",
                confirmButtonColor: "#20d070",
                confirmButtonText: "OK",
                allowOutsideClick: false,
              });
            }
          },
          error: (xhr, status, error) => {
            Swal.fire({
              title: "Error",
              text: xhr.responseText,
              icon: "error",
              confirmButtonColor: "#20d070",
              confirmButtonText: "OK",
              allowOutsideClick: false,
            });
          },
        });
      }
    }, 500);
  };
  checkProductsIfExist(categoryFields);
  /***********************************Check product if exist and compare input to quantity of the product***********************************************/
});