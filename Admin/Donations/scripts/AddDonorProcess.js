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
    html +=
      '<tr><td><input type="text" class="form-control name_items pnCN" id="pnCN"></td><td><input type="number" class="form-control qCN" id="qCN"></td>';
    html += "<td>" + remove + "</td></tr>";
    return html;
  } else if (buttonType === "buttonHY") {
    html +=
      '<tr><td><input type="text" class="form-control name_items pnHY" id="pnHY"></td><td><input type="number" class="form-control qHY" id="qHY"></td>';
    html += "<td>" + remove + "</td></tr>";
    return html;
  } else if (buttonType === "buttonII") {
    html +=
      '<tr><td><input type="text" class="form-control name_items pnII" id="pnII"></td><td><input type="number" class="form-control qII" id="qII"></td>';
    html += "<td>" + remove + "</td></tr>";
    return html;
  } else if (buttonType === "buttonDW") {
    html +=
      '<tr><td><input type="text" class="form-control name_items pnDW" id="pnDW"></td><td><input type="number" class="form-control qDW" id="qDW"></td>';
    html += "<td>" + remove + "</td></tr>";
    return html;
  } else if (buttonType === "buttonMG") {
    html +=
      '<tr><td><input type="text" class="form-control name_items pnMG" id="pnMG"></td>' +
      '<td><select class="form-control typeMG" name="typeMG" id="typeMG">' +
      '<option value="">--</option>' +
      '<option value="Frozen">Frozen</option>' +
      '<option value="Fresh">Fresh</option>' +
      '<option value="None">None</option>' +
      "</select></td>" +
      '<td><input type="number" class="form-control qMG" id="qMG"></td>' +
      '<td><select class="form-control unitMG" name="unitMG" id="unitMG">' +
      '<option value="">--</option>' +
      '<option value="Kilograms">Kilograms</option>' +
      '<option value="Grams">Grams</option>' +
      "</select></td>";
    html += "<td>" + remove + "</td></tr>";
    return html;
  } else if (buttonType === "buttonME") {
    html +=
      '<tr><td><input type="text" class="form-control name_items pnME" id="pnME"></td>' +
      '<td><select class="form-control typeME" name="typeME" id="typeME">' +
      '<option value="">--</option>' +
      '<option value="Tablet">Tablet</option>' +
      '<option value="Capsule">Capsule</option>' +
      '<option value="Liquid">Liquid</option>' +
      '<option value="None">None</option>' +
      "</select></td>" +
      '<td><input type="number" class="form-control qME" id="qME"></td>' +
      '<td><select class="form-control unitME" name="unitME" id="unitME">' +
      '<option value="">--</option>' +
      '<option value="Milligrams">Milligrams</option>' +
      '<option value="Grams">Grams</option>' +
      '<option value="Micrograms">Micrograms</option>' +
      '<option value="None">None</option>' +
      "</select></td>";
    html += "<td>" + remove + "</td></tr>";
    return html;
  } else if (buttonType === "buttonOT") {
    html +=
      '<tr><td><input type="text" class="form-control pnOT" id="pnOT"></td>' +
      '<td><input type="text" class="form-control typeOT" id="typeOT"></td>' +
      '<td><input type="number" class="form-control qOT" id="qOT"></td>' +
      '<td><input type="text" class="form-control unituOT" id="unituOT"></td>';
    html += "<td>" + remove + "</td></tr>";
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

  /****************Category objects********************************************************************/

  let result = [];
  let x = 0;
  $(".selectCateg:checked").each(function () {
    result[x++] = $(this).val();
  });

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
        { selector: ".unitME", prop: "unit" }
      ],
    },
    {
      id: "#box7",
      category: "Others",
      fields: [
        { selector: ".pnOT", prop: "pn" },
        { selector: ".typeOT", prop: "type" },  
        { selector: ".qOT", prop: "q" },
        { selector: ".unitOT", prop: "unit" }
      ],
    },
  ];

  const alertMessage= (Message)=>{
    Swal.fire({
      title: 'Warning',
      text: Message,
      icon: 'warning',
      confirmButtonColor: '#20d070'  
    });
  }

  let isInvalid = false;

  for (const box of boxes) {
    if ($(box.id).is(":checked")) {
      for (const field of box.fields) {
        $(field.selector).each((index, element) => {
          inputFields[box.category][field.prop].push($(element).val());
          if ($(element).val() == "") {
            alertMessage(`Please input a value for ${box.category}.`)
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
            alertMessage(`Please select a category.`)
          }
        });
      }
    }
  }
  /****************Check if there are checked checkbox and push data to the specific object base on value of checkbox********************/

  /****************Donor Information Validation********************************************************************/
  


  
});
