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
  selectClassName
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
          <td>${selectOption.prop("outerHTML")}</td>
          <td>
            <div class="d-flex justify-content-center border">
              <button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="${categoryAttribute}"><i class="fa-solid fa-minus"></i></button>
              <input type="number" class="form-control quantity" value="0" data-input-category="${categoryAttribute}">
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
const addNewRow = (buttonId, number, CategoryName, selectClassName) => {
  $(document).on("click", buttonId, (e) => {
    e.stopImmediatePropagation();
    let tableBody = $(`tbody[data-body-category="${CategoryName}"]`);
    count++;
    appendNewProduct(tableBody, number, CategoryName, selectClassName);
  });
};
addNewRow("#can-noodles", "01", "CanNoodles", "can-noodles-product");
addNewRow("#hygine-essentials", "02", "Hygine", "hygine-essentials-product");
addNewRow("#infant-items", "03", "InfantItems", "infant-items-product");
addNewRow("#drinking-water", "04", "DrinkingWater", "drinking-water-product");
addNewRow("#meat-grains", "05", "MeatGrains", "meat-grains-product");
addNewRow("#medicine", "06", "Medicine", "medicine-product");
addNewRow("#others", "07", "Others", "others-product");
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
    Hygine: {
      product: [],
      quantity: [],
    },
    Infant: {
      product: [],
      quantity: [],
    },
    Drinks: {
      product: [],
      quantity: [],
    },
    MeatGrain: {
      product: [],
      quantity: [],
    },
    Medicine: {
      product: [],
      quantity: [],
    },
    Others: {
      product: [],
      quantity: [],
    },
  };
  let isInvalid = false;

/***********************************Check if input fields are empty if not then push data to category object***********************************************/
  const checkIfEmpty = (
    classNameProduct,
    classNameQuantity,
    inputFieldProduct,
    inputFieldQuantity,
    errorMessageClass,
    errorMessageQuantity
  ) => {
    $(classNameProduct).each((index, element) => {
      if ($(element).val() == "") {
        $(errorMessageClass).html(
          "<span class'text-danger'>Please select a product</span>"
        );
        $(classNameProduct).addClass("is-invalid");
        isInvalid = true;
      } else {
        inputFieldProduct.push($(element).val());
        $(classNameProduct).removeClass("is-invalid");
        $(errorMessageClass).html(``);
      }
    });
    $(classNameQuantity).each((index, element) => {
      if ($(element).val() == 0) {
        $(errorMessageQuantity).html(
          "<span class'text-danger'>Please add a value</span>"
        );
        $(classNameQuantity).addClass("is-invalid");
        isInvalid = true;
      } else {
        inputFieldQuantity.push($(element).val());
        $(classNameQuantity).removeClass("is-invalid");
        $(errorMessageQuantity).html(``);
      }
    });
  };
  checkIfEmpty(
    ".can-noodles-product",
    ".can-noodles-quantity",
    categoryFields.CanNoodles.product,
    categoryFields.CanNoodles.quantity,
    ".cn-invalid-product",
    ".cn-invalid-quantity"
  );
  checkIfEmpty(
    ".hygine-essentials-product",
    ".hygine-essentials-quantity",
    categoryFields.Hygine.product,
    categoryFields.Hygine.quantity,
    ".hy-invalid-product",
    ".hy-invalid-quantity"
  );
  checkIfEmpty(
    ".infant-items-product",
    ".infant-items-quantity",
    categoryFields.Infant.product,
    categoryFields.Infant.quantity,
    ".ii-invalid-product",
    ".ii-invalid-quantity"
  );
  checkIfEmpty(
    ".drinking-water-product",
    ".drinking-water-quantity",
    categoryFields.Drinks.product,
    categoryFields.Drinks.quantity,
    ".dw-invalid-product",
    ".dw-invalid-quantity"
  );
  checkIfEmpty(
    ".meat-grains-product",
    ".meat-grains-quantity",
    categoryFields.MeatGrain.product,
    categoryFields.MeatGrain.quantity,
    ".mg-invalid-product",
    ".mg-invalid-quantity"
  );
  checkIfEmpty(
    ".medicine-product",
    ".medicine-quantity",
    categoryFields.Medicine.product,
    categoryFields.Medicine.quantity,
    ".me-invalid-product",
    ".me-invalid-quantity"
  );
  checkIfEmpty(
    ".others-product",
    ".others-quantity",
    categoryFields.Others.product,
    categoryFields.Others.quantity,
    ".ot-invalid-product",
    ".ot-invalid-quantity"
  );
  /***********************************Check if input fields are empty if not then push data to category object***********************************************/

/***********************************Save to data***********************************************/
let data = {
    submitProcess: "",
    request_id: request_id,
    CanNoodlesProduct: categoryFields.CanNoodles.product,
    CanNoodlesQuantity: categoryFields.CanNoodles.quantity,
    HygineProduct: categoryFields.Hygine.product,
    HygineQuantity: categoryFields.Hygine.quantity,
    InfantProduct: categoryFields.Infant.product,
    InfantQuantity: categoryFields.Infant.quantity,
    DrinkingWaterProduct: categoryFields.Drinks.product,
    DrinkingWaterQuantity: categoryFields.Drinks.quantity,
    MeatGrainsProduct: categoryFields.MeatGrain.product,
    MeatGrainsQuantity: categoryFields.MeatGrain.quantity,
    MedicineProduct: categoryFields.Medicine.product,
    MedicineQuantity: categoryFields.Medicine.quantity,
    OthersProduct: categoryFields.Others.product,
    OthersQuantity: categoryFields.Others.quantity,
  };
/***********************************Save to data***********************************************/

/***********************************Check if out of stock***********************************************/
  const checkIfOutOfStock = (
    quantity,
    product,
    productField,
    quantityField,
    classTableProduct,
    classTableQuantity
  ) => {
    for (let i = 0; i < quantity.length; i++) {
      $(quantityField).each(function (i) {
        if (+quantity[i] > +product[i]) {
          $(productField).addClass("is-invalid");
          $(quantityField).addClass("is-invalid");
          $(classTableProduct).html(
            `<span class'text-danger'>We dont have enough stocks<span/>`
          );
          $(classTableQuantity).html(
            `<span class'text-danger'>Please input a different quantity<span/>`
          );
          isInvalid = true;
        } else {
          $(productField).removeClass("is-invalid");
          $(classTableProduct).html(``);
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
                const cnPnData = $(".can-noodles-product");
                const cnQuantityData = $(".can-noodles-quantity");
                const cnClassProduct = $(".cn-invalid-product");
                const cnClassQuantity = $(".cn-invalid-quantity");
                checkIfOutOfStock(
                  cnTotalQuantity,
                  commonCanNoodles,
                  cnPnData,
                  cnQuantityData,
                  cnClassProduct,
                  cnClassQuantity
                );
                break;
              case "Hygine":
                const commonHygine = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.HygineEssentialProduct.indexOf(productValue);
                    return response.HygineEssentialQuantity[index];
                  }
                );
                const hyTotalQuantity = categoryFields[category].quantity;
                const hyPnData = $(".hygine-essentials-product");
                const hyQuantityData = $(".hygine-essentials-quantity");
                const hyClassProduct = $(".hy-invalid-product");
                const hyClassQuantity = $(".hy-invalid-quantity");

                checkIfOutOfStock(
                  hyTotalQuantity,
                  commonHygine,
                  hyPnData,
                  hyQuantityData,
                  hyClassProduct,
                  hyClassQuantity
                );
                break;
              case "Infant":
                const commonInfant = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.InfantItemsProduct.indexOf(productValue);
                    return response.InfantItemsQuantity[index];
                  }
                );
                const iiTotalQuantity = categoryFields[category].quantity;
                const iiPnData = $(".infant-items-product");
                const iiQuantityData = $(".infant-items-quantity");
                const iiClassProduct = $(".ii-invalid-product");
                const iiClassQuantity = $(".ii-invalid-quantity");
                checkIfOutOfStock(
                  iiTotalQuantity,
                  commonInfant,
                  iiPnData,
                  iiQuantityData,
                  iiClassProduct,
                  iiClassQuantity
                );
                break;
              case "Drinks":
                const commonDrinks = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.DrinkingWaterProduct.indexOf(productValue);
                    return response.DrinkingWaterQuantity[index];
                  }
                );
                const dwTotalQuantity = categoryFields[category].quantity;
                const dwPnData = $(".drinking-water-product");
                const dwQuantityData = $(".drinking-water-quantity");
                const dwClassProduct = $(".dw-invalid-product");
                const dwClassQuantity = $(".dw-invalid-quantity");
                checkIfOutOfStock(
                  dwTotalQuantity,
                  commonDrinks,
                  dwPnData,
                  dwQuantityData,
                  dwClassProduct,
                  dwClassQuantity
                );
                break;
              case "MeatGrain":
                const commonMeatGrains = categoryFields[category].product.map(
                  (productValue) => {
                    const index =
                      response.MeatGrainsProduct.indexOf(productValue);
                    return response.MeatGrainsQuantity[index];
                  }
                );
                const mgTotalQuantity = categoryFields[category].quantity;
                const mgPnData = $(".meat-grains-product");
                const mgQuantityData = $(".meat-grains-quantity");
                const mgClassProduct = $(".mg-invalid-product");
                const mgClassQuantity = $(".mg-invalid-quantity");               
                 checkIfOutOfStock(
                  mgTotalQuantity,
                  commonMeatGrains,
                  mgPnData,
                  mgQuantityData,
                  mgClassProduct,
                  mgClassQuantity
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
                const mePnData = $(".medicine-product");
                const meQuantityData = $(".medicine-quantity");
                const meClassProduct = $(".me-invalid-product");
                const meClassQuantity = $(".me-invalid-quantity");
                checkIfOutOfStock(
                  meTotalQuantity,
                  commonMedicine,
                  mePnData,
                  meQuantityData,
                  meClassProduct,
                  meClassQuantity
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
                const otPnData = $(".others-product");
                const otQuantityData = $(".others-quantity");
                const otClassProduct = $(".ot-invalid-product");
                const otClassQuantity = $(".ot-invalid-quantity");                
                checkIfOutOfStock(
                  otTotalQuantity,
                  commonOthers,
                  otPnData,
                  otQuantityData,
                  otClassProduct,
                  otClassQuantity
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
    setTimeout(()=>{
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
      }else{
        swal.fire("Warning", "Please recheck the data you inputted","warning")
      }
    },500)
  };
  checkProductsIfExist(categoryFields);
  /***********************************Check product if exist and compare input to quantity of the product***********************************************/
});
