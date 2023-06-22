const canNoodlesTable = () => {
  const html = `
    <table class="table cnTB col table-bordered" id="cnTB">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="cnBody" id="cnBody">
            <tr>
                <td><input type="text" class="form-control name_items pnCN" id="pnCN"></td>
                <td><input type="number" class="form-control qCN" id="qCN"></td>
                <td><button type="button" class="btn btn-success addCN btn-rounded" id="addCN"><i class="fa-solid fa-plus"></i></button></td>
            </tr>
        </tbody>
    </table>`;
  return html;
};
const hygineEssentialTable = () => {
  const html = `
    <table class="table hyTB col table-bordered" id="hyTB">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="hyBody" id="hyBody">
            <tr>
                <td><input type="text" class="form-control name_items pnHY" id="pnHY"></td>
                <td><input type="number" class="form-control qHY" id="qHY"></td>
                <td><button type="button" class="btn btn-success addHY btn-rounded" id="addHY"><i class="fa-solid fa-plus"></i></button></td>
            </tr>
        </tbody>
    </table>`;
  return html;
};
const infantItemsTable = () => {
  let html = "";
  html += `
    <table class="table iiTB col table-bordered" id="iiTB">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="iiBody" id="iiBody">
            <tr>
                <td><input type="text" class="form-control name_items pnII" id="pnII"></td>
                <td><input type="number" class="form-control qII" id="qII"></td>
                <td><button type="button" class="btn btn-success addII btn-rounded" id="addII"><i class="fa-solid fa-plus"></i></button></td>
            </tr>
        </tbody>
    </table>`;
  return html;
};
const drinkingWaterTable = () => {
  const html = `
    <table class="table dwTB col table-bordered" id="dwTB">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="dwBody" id="dwBody">
            <tr>
                <td><input type="text" class="form-control name_items pnDW" id="pnDW"></td>
                <td><input type="number" class="form-control qDW" id="qDW"></td>
                <td><button type="button" class="btn btn-success addDW btn-rounded" id="addDW"><i class="fa-solid fa-plus"></i></button></td>
            </tr>
        </tbody>
    </table>`;
  return html;
};
const meatGrainsTable = () => {
  const html = `
    <table class="table mgTB col table-bordered" id="mgTB">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="mgBody" id="mgBody">
            <tr>
                <td><input type="text" class="form-control name_items pnMG" id="pnMG"></td>
                <td>
                <select id="typeMG" class="form-select typeMG">
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
              </div>
               </td>
                <td><button type="button" class="btn btn-success addMG btn-rounded" id="addMG"><i class="fa-solid fa-plus"></i></button></td>
            </tr>
        </tbody>
    </table>`;
  return html;
};
const medicineTable = () => {
  const html = `
    <table class="table meTB col table-bordered" id="meTB">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="meBody" id="meBody">
            <tr>
                <td><input type="text" class="form-control name_items pnME" id="pnME"></td>
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
              </div>
               </td>
                <td><button type="button" class="btn btn-success addME btn-rounded" id="addME"><i class="fa-solid fa-plus"></i></button></td>
            </tr>
        </tbody>
    </table>`;
  return html;
};
const othersTable = () => {
  const html = `
    <table class="table otTB col table-bordered" id="otTB">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="otBody" id="otBody">
            <tr>
                <td><input type="text" class="form-control pnOT" id="pnOT"></td>
                <td><input type="text" class="form-control typeOT" id="typeOT"></td>
                <td><input type="number" class="form-control qOT" id="qOT"></td>
                <td><input type="text" class="form-control unitOT" id="unitOT"></td>
                <td><button type="button" class="btn btn-success addOT btn-rounded" id="addOT"><i class="fa-solid fa-plus"></i></button></td>
            </tr>
        </tbody>
    </table> `;

  return html;
};

$("#can-noodles").html(canNoodlesTable());
$("#hygine-essentials").html(hygineEssentialTable());
$("#infant-items").html(infantItemsTable());
$("#drinking-water").html(drinkingWaterTable());
$("#meat-grains").html(meatGrainsTable());
$("#medicine").html(medicineTable());
$("#others").html(othersTable());

const dynamicOtherOptions = (selectClass, inputClass, divClass) => {
  $(document).on("change", selectClass, function(event) {
    if ($(event.target).val() === "other") {
      $(event.target).siblings(divClass).show();
    } else {
      $(event.target).siblings(divClass).hide();
    }
  });

  $(document).on("keyup", inputClass, function(event) {
    if (event.keyCode === 32) {
      // Spacebar key
      if ($(event.target).val() === "") {
        $(event.target).addClass("is-invalid");
        return false;
      } else {
        $(event.target).removeClass("is-invalid");

        var otherValue = $(event.target).val();
        $(event.target)
          .parent()
          .siblings(selectClass)
          .find("option[value='other']")
          .text(otherValue)
          .val(otherValue); // Set the value of the "other" option
        $(event.target).parent().hide();
      }
    }
  });
};

  

dynamicOtherOptions(".typeMG", ".otherTypeMG", ".dynamicTypeMG");
dynamicOtherOptions(".unitMG", ".otherUnitMG", ".dynamicUnitMG");
dynamicOtherOptions(".typeME", ".otherTypeME", ".dynamicTypeME");
dynamicOtherOptions(".unitME", ".otherUnitME", ".dynamicUnitME");
