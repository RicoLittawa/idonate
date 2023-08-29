//Populate product
const addProduct = (product) => {
  $("#product").val(product);
};
//Populate opiton
const addToOption = (option, id) => {
  $(id).append(option);
};
//Populate select options
let currentYear = new Date().getFullYear();
let arrayYear = Array.from(Array(10), (_, i) => currentYear + i);
arrayYear.forEach((item) => {
  let yearOption = $("<option></option>")
    .html(item)
    .attr("selected", item == currentYear);
  addToOption(yearOption, "#year");
});
//Populate month
let month = [
  "January",
  "Febuary",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];
let monthOption = null, //Options
  dayOption = null;

//Map to month variable and pass to option value  
let mapMonth = month.map((mon) => {
  monthOption += `<option value="${mon}">${mon}</option>`;
});

//Populate days
for (let i = 1; i < 32; i++) {
  dayOption += `<option value=${i}>${i}</option>`;
}

addToOption(monthOption, "#month");
addToOption(dayOption, "#day");
