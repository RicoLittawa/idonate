const productUnit = {
  //Data for unit option
  "Can & Noodles": ["N/A", "Others"],
  "Hygiene Essentials": ["N/A", "Others"],
  "Infant Items": ["N/A", "Others"],
  "Drinking Water": [
    "N/A",
    "250ml",
    "300ml",
    "350ml",
    "500ml",
    "1L",
    "1.5L",
    "2L",
    "2.5L",
    "3L",
    "4L",
    "5L",
    "6L",
    "Others",
  ],
  "Meat & Grains": ["N/A", "Kilograms", "Grams", "Sacks", "Others"],
  Medicine: ["N/A", "MILLIGRAMS", "MICROGRAMS", "Others"],
  Others: ["N/A", "Others"],
};
const populateSelectOptions = (data, optionClass) => {
  //Populate each select options
  data.forEach((item) => {
    const option = $("<option></option>").val(item).text(item);
    optionClass.append(option);
  });
};
$(document).on("change", ".category-name", (event) => {
  //Populate unit options base on category
  const categoryName = $(event.target).val();
  const unitClass = $(event.target).closest("tr").find(".product-unit");
  unitClass.empty(); // Clear previous options in .product-unit select element
  if (productUnit.hasOwnProperty(categoryName)) {
    const unitArray = productUnit[categoryName];
    populateSelectOptions(unitArray, unitClass);
  } else {
    // Handle the case when the selected category is not found in productUnit
    // For example, you could display a default message or do nothing
  }
});
const dynamicOtherOptions = (selectClass, inputClass, divClass) => {
  //When others is selected it will show inputfield to add name of other category
  $(document).on("change", selectClass, function (event) {
    if ($(event.target).val() === "Others") {
      $(event.target).siblings(divClass).show();
    } else {
      $(event.target).siblings(divClass).hide();
    }
  });

  $(document).on("keyup", inputClass, function (event) {
    if (event.key === " ") {
      // Spacebar key
      if ($(event.target).val() === "") {
        $(event.target).addClass("is-invalid");
        return false;
      } else {
        $(event.target).removeClass("is-invalid");
        let otherValue = $(event.target).val();
        $(event.target)
          .parent()
          .siblings(selectClass)
          .find("option[value='Others']")
          .text(otherValue)
          .val(otherValue); // Set the value of the "other" option
        $(event.target).parent().hide();
      }
    }
  });
};
dynamicOtherOptions(
  ".category-name",
  ".category-name-others",
  ".othersSelected"
);
dynamicOtherOptions(".product-unit", ".unit-others", ".unit-othersSelected"); //Execute dynamicOtherOptions
const populateCategory = (selectElement) => {
  //Get data for category option
  $.ajax({
    url: "include/PopulateCategory.php",
    method: "GET",
    dataType: "json",
    success: (data) => {
      populateSelectOptions(data, selectElement);
    },
  });
};
populateCategory($(".category-name")); //Initial value of category select option
let count = 0; //Initialize row count from 0-
const newTableRow = () => {
  //Add new table row
  let html = "";
  let remove = "";
  if (count > 0) {
    remove = "<button class='remove btn btn-danger'>Remove</button>";
  }
  html = `<tr>
  <td><select class="form-select category-name">
  <option value="">Select Category</option>
  </select>
  <div class="othersSelected" style="display: none;">
    <label for="otherInput">Other:</label>
    <input type="text" id="otherInput" class="form-control category-name-others" />
  </div></td>
  <td><input type="text" class="form-control product-name"></td>
  <td> <select class="form-select product-unit">
  <option value="">Select Unit</option></select>
  <div class="unit-othersSelected" style="display: none;">
    <label for="unitotherInput">Other:</label>
    <input type="text" id="unitotherInput" class="form-control unit-others" />
  </div></td>
  <td><input type="number" class="form-control product-quantity"></td>
  <td>${remove}</td></tr>`;
  const newRow = $(html);
  const selectElement = newRow.find(".category-name");
  populateCategory(selectElement);
  return newRow;
};
$(document).on("click", "#addNewField", () => {
  //Add new rows
  count++;
  $(".add-items tbody").append(newTableRow());
});
$(document).on("click", ".remove", function () {
  //Remove rows from the table
  $(this).closest("tr").remove();
});

//Save data to database
$(document).on("submit", "#add-form", (e) => {
  e.preventDefault();
  //Donor Details
  let ref_id = $("#reference_id").val();
  let fname = $("#fname").val();
  let region = $("#region").val();
  let province = $("#province").val();
  let municipality = $("#municipality").val();
  let barangay = $("#barangay").val();
  let contact = $("#contact").val();
  let email = $("#email").val();
  let donation_date = $("#donation_date").val();
  let isInvalid = false; //tracks all input field if valid or not
  //Alert Function
  const alertMessage = (title, text, icon) => {
    //Show alert messages
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
    //Reset loading state
    $('button[type="submit"]').prop("disabled", false);
    $(".submit-text").text("Save");
    $(".spinner-border").addClass("d-none");
  };

  let productField = {
    category: [],
    product: [],
    quantity: [],
    unit: [],
  };

  const pushProductToObject = (inputField, classSelector) => {
    //Push data to productfField object
    $(classSelector).each((index, element) => {
      productField[inputField].push($(element).val());
    });
  };

  pushProductToObject("category", ".category-name");
  pushProductToObject("product", ".product-name");
  pushProductToObject("quantity", ".product-quantity");
  pushProductToObject("unit", ".product-unit");


  let informationData= {
    saveBtn: "",
    category:productField.category,
    product:productField.product,
    quantity:productField.quantity,
    unit:productField.unit,
    ref_id:ref_id,
    fname:fname,
    province:province,
    municipality:municipality,
    barangay:barangay,
    region:region,
    email:email,
    donation_date:donation_date,
    contact:contact
  }


  //Object for products to pass data to the ajax call

  //Custom Validators/Regex
  //  const emailVali =
  //    /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  //  const regex = /^\d{11}$/;
  //Donor information validation
  //  const checksDonorInfoIfEmpty = (fieldName, idField) => {
  //    if (fieldName === "") {
  //      $(idField).addClass("is-invalid");
  //      isInvalid = true;
  //    } else {
  //      if (idField === "#email") {
  //        if (!emailVali.test(fieldName)) {
  //          alertMessage("Warning", "Invalid email address", "warning");
  //          $(idField).addClass("is-invalid");
  //          isInvalid = true;
  //          return;
  //        }
  //      } else if (idField === "#contact") {
  //        if (!regex.test(fieldName)) {
  //          alertMessage("Warning", "Invalid contact number", "warning");
  //          $(idField).addClass("is-invalid");
  //          isInvalid = true;
  //          return;
  //        }
  //      }
  //      $(idField).removeClass("is-invalid");
  //    }
  //    if (
  //      $("#fname").val() !== "" &&
  //      $("#lname").val() !== "" &&
  //      $("#email").val() !== "" &&
  //      $("#contact").val() !== "" &&
  //      $("#donation_date").val() !== ""
  //    ) {
  //      if (!regex.test(fieldName)) {
  //        return;
  //      }
  //      if (!$(".selectCateg:checked").length) {
  //        alertMessage("warning", "Please select a category", "warning");
  //        isInvalid = true;
  //      }
  //    }
  //  };
  //Validate using function
  //  checksDonorInfoIfEmpty(fname, "#fname");
  //  checksDonorInfoIfEmpty(email, "#email");
  //  checksDonorInfoIfEmpty(region, "#region");
  //  checksDonorInfoIfEmpty(province, "#province");
  //  checksDonorInfoIfEmpty(municipality, "#municipality");
  //  checksDonorInfoIfEmpty(barangay, "#barangay");
  //  checksDonorInfoIfEmpty(contact, "#contact");
  //  checksDonorInfoIfEmpty(donation_date, "#donation_date");
  //  if (isInvalid) {
  //    return false; //prevent form from submitting if any input is invalid
  //  }

  //Use ajax call to save data to the database
  Swal.fire({
    title: "Confirm",
    text: "Click yes to confirm",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#20d070",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, add it",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "include/add.inc.php",
        method: "POST",
        data: informationData,
        dataType: "json",
        // beforeSend: () => {
        //   $('button[type="submit"]').prop("disabled", true);
        //   $(".submit-text").text("Saving...");
        //   $(".spinner-border").removeClass("d-none");
        // },
        success: (response) => {
        console.log(response)
          // if (response.status === "Success") {
          //   setTimeout(() => {
          //     // Enable the submit button and hide the loading animation
          //     resetBtnLoadingState();
          //     alertMessage(response.status, response.message, response.icon);
          //     setTimeout(() => {
          //       window.location.href = "Donors.php";
          //     }, 1500);
          //   }, 1000);
          // } else {
          //   resetBtnLoadingState();
          //   alertMessage(response.status, response.message, response.icon);
          // }
        },
        error: (xhr, status, error) => {
          // Handle errors
          resetBtnLoadingState();
          alertMessage("Error", xhr.responseText, "error");
        },
      });
    }
  });
});
