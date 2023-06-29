const selectElement = (locationName, selector, codeName, nextSelector) => {
  $(selector).on("change", (event) => {
    const code = $(event.target).val();
    if (code) {
      $.ajax({
        url: "../include/region.php",
        type: "POST",
        data: `${codeName}=${code}`,
        success: function (data) {
          // Store the current value of the nextSelector
          const currentValue = $(nextSelector).val();
          
          // Clear the options except the first one (assumed to be "--select--" or empty value)
          $(nextSelector).find('option:not(:first-child)').remove();
          
          // Append the new provinces
          $(nextSelector).append(data);
          
          // Set the previously selected value (if it exists)
          if (currentValue) {
            $(nextSelector).val(currentValue);
          }
        },
      });
    } else {
      // Show "--" as the default option
      $(nextSelector).html('<option value="">-Select-</option>');
      
      swal.fire("Warning", `Select ${locationName}`, "warning");
    }
  });
};

selectElement('Region', "#region", "regCode", "#province");
selectElement('Province', "#province", "provCode", "#municipality");
selectElement('Municipality', "#municipality", "citymunCode", "#barangay");
