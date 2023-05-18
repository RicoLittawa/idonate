/****************function to identify each button and add dynamic row to table***********************************/
let count = 0;
const addRowButton = (buttonType) => {
  let html = "";
  let remove = "";
  if (count > 0) {
    remove =
      '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
  }
  if (buttonType === "buttonCN") {
    html = `<tr><td><input type="text" class="form-control name_items pnCN" id="pnCN"></td><td><input type="number" class="form-control qCN" id="qCN"></td>;
  <td>${remove}</td></tr>`;
    return html;
  } else if (buttonType === "buttonHY") {
    html = `<tr><td><input type="text" class="form-control name_items pnHY" id="pnHY"></td><td><input type="number" class="form-control qHY" id="qHY"></td>
      <td>${remove}</td></tr>`;
    return html;
  } else if (buttonType === "buttonII") {
    html = `<tr><td><input type="text" class="form-control name_items pnII" id="pnII"></td><td><input type="number" class="form-control qII" id="qII"></td>
      <td>${remove}</td></tr>`;
    return html;
  } else if (buttonType === "buttonDW") {
    html = `<tr><td><input type="text" class="form-control name_items pnDW" id="pnDW"></td><td><input type="number" class="form-control qDW" id="qDW"></td>
      <td>${remove}</td></tr>`;
    return html;
  } else if (buttonType === "buttonMG") {
    html = `<tr><td><input type="text" class="form-control name_items pnMG" id="pnMG"></td>
      <td><select id="typeMG" class="form-select typeMG">
      <option value="">--</option>
      <option value="Fresh">Fresh</option>
      <option value="Frozen">Frozen</option>
      <option value="other">Other</option>
    </select>
    <div class="dynamicTypeMG" style="display: none;">
      <label for="otherInput">Other:</label>
      <input type="text" id="otherInput" class="form-control otherTypeMG" />
    </div>
    
    </td>
      <td><input type="number" class="form-control qMG" id="qMG"></td>
      <td>
      <select id="unitMG" class="form-select unitMG">
      <option value="">--</option>
      <option value="Kilograms">Kilograms</option>
      <option value="Grams">Grams</option>
      <option value="Sacks">Sacks</option>
      <option value="other">Other</option>
    </select>
    <div class="dynamicUnitMG" style="display: none;">
      <label for="otherInput">Other:</label>
      <input type="text" id="otherInput" class="form-control otherUnitMG" />
    </div></td>
      <td>${remove}</td></tr>`;
    return html;
  } else if (buttonType === "buttonME") {
    html = `<tr><td><input type="text" class="form-control name_items pnME" id="pnME"></td>
      <td>
      <select id="typeME" class="form-select typeME">
        <option value="">--</option>
        <option value="Liquid">Liquid</option>
        <option value="Tablet">Tablet</option>
        <option value="Capsules">Capsules</option>
        <option value="other">Other</option>
      </select>
      <div class="dynamicTypeME" style="display: none;">
        <label for="otherInput">Other:</label>
        <input type="text" id="otherInput" class="form-control otherTypeME" />
      </div></td>
      <td><input type="number" class="form-control qME" id="qME"></td>
      <td>
      <select id="unitME" class="form-select unitME">
      <option value="">--</option>
      <option value="Milligrams">Milligrams</option>
      <option value="Grams">Grams</option>
      <option value="Micrograms">Micrograms</option>
      <option value="other">Other</option>
    </select>
    <div class="dynamicUnitME" style="display: none;">
      <label for="otherInput">Other:</label>
      <input type="text" id="otherInput" class="form-control otherUnitME" />
    </div></td>
      <td>${remove}</td></tr>`;
    return html;
  } else if (buttonType === "buttonOT") {
    html = `<tr><td><input type="text" class="form-control pnOT" id="pnOT"></td>
      <td><input type="text" class="form-control typeOT" id="typeOT"></td>
      <td><input type="number" class="form-control qOT" id="qOT"></td>
      <td><input type="text" class="form-control unituOT" id="unituOT"></td>
      <td>${remove}</td></tr>`;
    return html;
  }
};
/****************Runction to identify each button and add dynamic row to table***********************************/

/****************Remove row on specific table********************************************************************/
$(document).on("click", ".remove", function () {
  $(this).closest("tr").remove();
});
/****************Remove row on specific table********************************************************************/

/****************Append new rows********************************************************************/
const appendTableRows = (buttonId, buttonBody, generatedRow) => {
  $(document).on("click", buttonId, function () {
    count++;
    $(buttonBody).append(addRowButton(generatedRow));
  });
};
appendTableRows("#addCN", "#cnBody", "buttonCN");
appendTableRows("#addHY", "#hyBody", "buttonHY");
appendTableRows("#addII", "#iiBody", "buttonII");
appendTableRows("#addDW", "#dwBody", "buttonDW");
appendTableRows("#addMG", "#mgBody", "buttonMG");
appendTableRows("#addME", "#meBody", "buttonME");
appendTableRows("#addOT", "#otBody", "buttonOT");
/****************Append new rows********************************************************************/

/****************Save Data********************************************************************/

$(document).submit((e) => {
  e.preventDefault();
  /****************Donor Details********************************************************************/

  let ref_id = $("#reference_id").val();
  let fname = $("#fname").val();
  let region = $("#region").val();
  let province = $("#province").val();
  let municipality = $("#municipality").val();
  let barangay = $("#barangay").val();
  let contact = $("#contact").val();
  let email = $("#email").val();
  let donation_date = $("#donation_date").val();
  /****************Donor Details********************************************************************/

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
    $(".submit-text").text("Save");
    $(".spinner-border").addClass("d-none");
  };
  /****************Alert function********************************************************************/

  let isInvalid = false; //tracks all input field

  /****************Check if there are checked checkbox and push data to the specific object base on value of checkbox********************************************************************/
  const inputFields = {
    CanNoodles: { pn: [], q: [] },
    HygineEssentials: { pn: [], q: [] },
    InfantItems: { pn: [], q: [] },
    DrinkingWater: { pn: [], q: [] },
    MeatGrains: { pn: [], q: [], type: [], unit: [] },
    Medicine: { pn: [], q: [], type: [], unit: [] },
    Others: { pn: [], q: [], type: [], unit: [] },
  };
  const boxes = [
    {
      id: "#box1",
      category: "CanNoodles",
      fields: [
        { selector: ".pnCN", prop: "pn" },
        { selector: ".qCN", prop: "q" },
      ],
    },
    {
      id: "#box2",
      category: "HygineEssentials",
      fields: [
        { selector: ".pnHY", prop: "pn" },
        { selector: ".qHY", prop: "q" },
      ],
    },
    {
      id: "#box3",
      category: "InfantItems",
      fields: [
        { selector: ".pnII", prop: "pn" },
        { selector: ".qII", prop: "q" },
      ],
    },
    {
      id: "#box4",
      category: "DrinkingWater",
      fields: [
        { selector: ".pnDW", prop: "pn" },
        { selector: ".qDW", prop: "q" },
      ],
    },
    {
      id: "#box5",
      category: "MeatGrains",
      fields: [
        { selector: ".pnMG", prop: "pn" },
        { selector: ".typeMG", prop: "type" },
        { selector: ".qMG", prop: "q" },
        { selector: ".unitMG", prop: "unit" },
      ],
    },
    {
      id: "#box6",
      category: "Medicine",
      fields: [
        { selector: ".pnME", prop: "pn" },
        { selector: ".typeME", prop: "type" },
        { selector: ".qME", prop: "q" },
        { selector: ".unitME", prop: "unit" },
      ],
    },
    {
      id: "#box7",
      category: "Others",
      fields: [
        { selector: ".pnOT", prop: "pn" },
        { selector: ".typeOT", prop: "type" },
        { selector: ".qOT", prop: "q" },
        { selector: ".unitOT", prop: "unit" },
      ],
    },
  ];
  for (const box of boxes) {
    if ($(box.id).is(":checked")) {
      for (const field of box.fields) {
        $(field.selector).each((index, element) => {
          inputFields[box.category][field.prop].push($(element).val());
          if ($(element).val() == "") {
            alertMessage(
              "Warning",
              `Please input a value for ${box.category}.`,
              "warning"
            );
            $(element).addClass("is-invalid");
            isInvalid = true;
          } else {
            $(element).removeClass("is-invalid");
          }
        });
      }
    } else {
      for (const field of box.fields) {
        $(field.selector).each((index, element) => {
          if ($(element).val() != "") {
            isInvalid = true;
            alertMessage(
              "Warning",
              `Please input a value for ${box.category}.`,
              "warning"
            );
          }
        });
      }
    }
  }
  /****************Check if there are checked checkbox and push data to the specific object base on value of checkbox********************/

  /****************Custom Validators********************/
  const emailVali =
    /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  const varnumbers = /^\d+$/;

  /****************Custom Validators********************/

  /****************Donor Information Validation********************************************************************/
  const checksDonorInfoIfEmpty = (fieldName, idField) => {
    if (fieldName === "") {
      isInvalid = true;
      $(idField).addClass("is-invalid");
    } else {
      if (idField === "#email") {
        if (!emailVali.test(fieldName)) {
          isInvalid = true;
          alertMessage("Warning", "Invalid email address", "warning");
          $(idField).addClass("is-invalid");
          return;
        }
      }
      if (idField === "#contact") {
        if (!varnumbers.test(fieldName)) {
          isInvalid = true;
          alertMessage("Warning", "Invalid contact number", "warning");
          $(idField).addClass("is-invalid");
          return;
        } else if (fieldName.length > 11) {
          isInvalid = true;
          alertMessage("warning", "Invalid contact number", "warning");
          $(idField).addClass("is-invalid");
          return;
        }
      }
      $(idField).removeClass("is-invalid");
    }
    if (
      $("#fname").val() !== "" &&
      $("#lname").val() !== "" &&
      $("#email").val() !== "" &&
      $("#contact").val() !== ""
    ) {
      if (!$(".selectCateg:checked").length) {
        isInvalid = true;
        alertMessage("warning", "Please select a category", "warning");
      }
    }
  };
  let result = [];
  let x = 0;
  $(".selectCateg:checked").each(function () {
    result[x++] = $(this).val();
  });

  checksDonorInfoIfEmpty(fname, "#fname");
  checksDonorInfoIfEmpty(email, "#email");
  checksDonorInfoIfEmpty(region, "#region");
  checksDonorInfoIfEmpty(province, "#province");
  checksDonorInfoIfEmpty(municipality, "#municipality");
  checksDonorInfoIfEmpty(barangay, "#barangay");
  checksDonorInfoIfEmpty(contact, "#contact");
  checksDonorInfoIfEmpty(donation_date, "#donation_date");
  /****************Donor Information Validation********************************************************************/

  /****************Checks if there no checked checkbox********************************************************************/

  /****************Checks if there no checked checkbox********************************************************************/

  if (isInvalid) {
    return false; //prevent form from submitting if any input is invalid
  }
  let inputData = {
    saveBtn: "",
    result: result,
    ref_id: ref_id,
    fname: fname,
    region: region,
    province: province,
    municipality: municipality,
    barangay: barangay,
    contact: contact,
    email: email,
    donation_date: donation_date,
    pnCN_arr: inputFields.CanNoodles.pn,
    qCN_arr: inputFields.CanNoodles.q,
    pnHY_arr: inputFields.HygineEssentials.pn,
    qHY_arr: inputFields.HygineEssentials.q,
    pnII_arr: inputFields.InfantItems.pn,
    qII_arr: inputFields.InfantItems.q,
    pnDW_arr: inputFields.DrinkingWater.pn,
    qDW_arr: inputFields.DrinkingWater.q,
    pnMG_arr: inputFields.MeatGrains.pn,
    typeMG_arr: inputFields.MeatGrains.type,
    qMG_arr: inputFields.MeatGrains.q,
    unitMG_arr: inputFields.MeatGrains.unit,
    pnME_arr: inputFields.Medicine.pn,
    typeME_arr: inputFields.Medicine.type,
    qME_arr: inputFields.Medicine.q,
    unitME_arr: inputFields.Medicine.unit,
    pnOT_arr: inputFields.Others.pn,
    typeOT_arr: inputFields.Others.type,
    qOT_arr: inputFields.Others.q,
    unitOT_arr: inputFields.Others.unit,
  };

  /***********************Save data to database*******************************/

  Swal.fire({
    title: "Confirm",
    text: "Click yes to confirm",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#20d070",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, update it",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "include/add.inc.php",
        method: "POST",
        data: inputData,
        dataType: "json",
        beforeSend: () => {
          $('button[type="submit"]').prop("disabled", true);
          $(".submit-text").text("Saving...");
          $(".spinner-border").removeClass("d-none");
        },
        success: (response) => {
          if (response.status === "Success") {
            setTimeout(() => {
              // Enable the submit button and hide the loading animation
              resetBtnLoadingState();
              alertMessage(response.status, response.message, response.icon);
              setTimeout(() => {
                window.location.href = "Donors.php";
              }, 1500);
            }, 100);
          } else {
            resetBtnLoadingState();
            alertMessage(response.status, response.message, response.icon);
          }
        },
        error: (xhr, status, error) => {
          // Handle errors
          resetBtnLoadingState();
          alertMessage("Error", xhr.responseText, "error");
        },
      });
    }
  });

  /***********************Save data to database*******************************/
});
