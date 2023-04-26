  const selectElement = (locationName,selector, codeName, nextSelector) => {
    $(selector).on("change",  (event)=> {
      const code = $(event.target).val();
      if (code) {
        $.ajax({
          url: "../include/region.php",
          type: "POST",
          data: `${codeName}=${code}`,
          success: function (data) {
            $(nextSelector).html(data);
          },
        });
      } else {
        swal.fire("Warning", `Select ${locationName}`, "warning");
      }
    });
  };
  selectElement('Region',"#region", "regCode", "#province");
  selectElement('Province',"#province", "provCode", "#municipality");
  selectElement('Municipality',"#municipality", "citymunCode", "#barangay");
