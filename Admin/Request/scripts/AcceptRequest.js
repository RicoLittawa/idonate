$(document).ready(() => {
    let count = 0;
    //Get Can/Noodles
    const populateCanNoodles = (select) => {
        $.ajax({
            url: '../include/getproduct.php',
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                select.empty();
                select.append("<option value=''>Select Product</option>");
                for (let i = 0; i < response.CanNoodlesProduct.length; i++) {
                    let product = response.CanNoodlesProduct[i];
                    let qty = response.CanNoodlesQuantity[i];
                    let optionText = product + " (" + qty + " pcs)";
                    if (qty == 0) {
                        optionText += ` - Out of stock`;
                    }
                    let option = new Option(optionText, product);
                    select.append(option);
                }
            }
        });
    }
    //Get Hygine Essentials
    const populateHygineEssentials = (select) => {
        $.ajax({
            url: '../include/getproduct.php',
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                select.empty();
                select.append("<option value=''>Select Product</option>");
                for (let i = 0; i < response.HygineEssentialProduct.length; i++) {
                    let product = response.HygineEssentialProduct[i];
                    let qty = response.HygineEssentialQuantity[i];
                    let optionText = product + " (" + qty + " pcs)";
                    if (qty == 0) {
                        optionText += " - Out of stock";
                    }
                    let option = new Option(optionText, product);
                    select.append(option);
                }
            }
        });
    }
    //Get Infant  Items
    const populateInfantItems = (select) => {
        $.ajax({
            url: '../include/getproduct.php',
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                select.empty();
                select.append("<option value=''>Select Product</option>");
                for (let i = 0; i < response.InfantItemsProduct.length; i++) {
                    let product = response.InfantItemsProduct[i];
                    let qty = response.InfantItemsQuantity[i];
                    let optionText = product + " (" + qty + " pcs)";
                    if (qty == 0) {
                        optionText += " - Out of stock";
                    }
                    let option = new Option(optionText, product);
                    select.append(option);
                }
            }
        });
    }
    //Get Drinking water
    const populateDrinkingWater = (select) => {
        $.ajax({
            url: '../include/getproduct.php',
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                select.empty();
                select.append("<option value=''>Select Product</option>");
                for (let i = 0; i < response.DrinkingWaterProduct.length; i++) {
                    let product = response.DrinkingWaterProduct[i];
                    let qty = response.DrinkingWaterQuantity[i];
                    let optionText = product + " (" + qty + " pcs)";
                    if (qty == 0) {
                        optionText += " - Out of stock";
                    }
                    let option = new Option(optionText, product);
                    select.append(option);
                }
            }
        });
    }
    //Get Meat/Grains
    const populateMeatGrains = (select) => {
        $.ajax({
            url: '../include/getproduct.php',
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                select.empty();
                select.append("<option value=''>Select Product</option>");
                for (let i = 0; i < response.MeatGrainsProduct.length; i++) {
                    let product = response.MeatGrainsProduct[i];
                    let qty = response.MeatGrainsQuantity[i];
                    let unit = response.MeatGrainsUnit[i];
                    let optionText = product + " (" + qty + " " + unit + ") ";
                    if (qty == 0) {
                        optionText += " - Out of stock";
                    }
                    let option = new Option(optionText, product);
                    select.append(option);
                }
            }
        });
    }
    //Get Medicine
    const populateMedicine = (select) => {
        $.ajax({
            url: '../include/getproduct.php',
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                select.empty();
                select.append("<option value=''>Select Product</option>");
                for (let i = 0; i < response.MedicineProduct.length; i++) {
                    let product = response.MedicineProduct[i];
                    let qty = response.MedicineQuantity[i];
                    let unit = response.MedicineUnit[i];
                    let optionText = product + " (" + qty + " " + unit + ")";
                    if (qty == 0) {
                        optionText += " - Out of stock";
                    }
                    let option = new Option(optionText, product);
                    select.append(option);
                }
            }
        });
    }
    //Get Others
    const populateOthers = (select) => {
        $.ajax({
            url: '../include/getproduct.php',
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                select.empty();
                select.append("<option value=''>Select Product</option>");
                for (let i = 0; i < response.OthersProduct.length; i++) {
                    let product = response.OthersProduct[i];
                    let qty = response.OthersQuantity[i];
                    let unit = response.OthersUnit[i];
                    let optionText = product + " (" + qty + " " + unit + ")";
                    if (qty == 0) {
                        optionText += " - Out of stock";
                    }
                    let option = new Option(optionText, product);
                    select.append(option);
                }
            }
        });
    }
    //Function to add new table
    const appendNewProduct = (tableBody, buttontype) => {
        let html = "";
        let remove = "";
        if (buttontype === '01') {
            html += '<tr>';
            html += '<td><select class="form-control product" data-product="CanNoodles"><option value="">Select Product</option></select></td>';
            html += `<td><div class="d-flex justify-content-center border">
                        <button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="CanNoodles"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" class="form-control quantity" value="0" data-input-category="CanNoodles">
                        <button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="CanNoodles"><i class="fa-solid fa-plus"></i></button>
                    </div></td>`;
            if (count > 0) {
                remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
            }
            html += '<td>' + remove + '</td>'
            tableBody.append(html);
            let select = tableBody.find('tr:last-child .product');
            populateCanNoodles(select);
        } else if (buttontype === '02') {
            html += '<tr>';
            html += '<td><select class="form-control product" data-product="Hygine"><option value="">Select Product</option></select></td>';
            html += `<td><div class="d-flex justify-content-center border">
                        <button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="Hygine"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" class="form-control quantity" value="1" data-input-category="Hygine">
                        <button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="Hygine"><i class="fa-solid fa-plus"></i></button>
                    </div></td>`;
            if (count > 0) {
                remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
            }
            html += '<td>' + remove + '</td>'
            tableBody.append(html);
            let select = tableBody.find('tr:last-child .product');
            populateHygineEssentials(select);
        } else if (buttontype === '03') {
            html += '<tr>';
            html += '<td><select class="form-control product" data-product="InfantItems"><option value="">Select Product</option></select></td>';
            html += `<td><div class="d-flex justify-content-center border">
                        <button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="InfantItems"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" class="form-control quantity" value=0 data-input-category="InfantItems">
                        <button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="InfantItems"><i class="fa-solid fa-plus"></i></button>
                    </div></td>`;
            if (count > 0) {
                remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
            }
            html += '<td>' + remove + '</td>'
            tableBody.append(html);
            let select = tableBody.find('tr:last-child .product');
            populateInfantItems(select);
        } else if (buttontype === '04') {
            html += '<tr>';
            html += '<td><select class="form-control product" data-product="DrinkingWater"><option value="">Select Product</option></select></td>';
            html += `<td><div class="d-flex justify-content-center border">
                        <button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="DrinkingWater"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" class="form-control quantity" value=0 data-input-category="DrinkingWater">
                        <button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="DrinkingWater"><i class="fa-solid fa-plus"></i></button>
                    </div></td>`;
            if (count > 0) {
                remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
            }
            html += '<td>' + remove + '</td>'
            tableBody.append(html);
            let select = tableBody.find('tr:last-child .product');
            populateDrinkingWater(select);
        } else if (buttontype === '05') {
            html += '<tr>';
            html += '<td><select" class="form-control product" data-product="MeatGrains"><option value="">Select Product</option></select></td>';
            html += `<td><div class="d-flex justify-content-center border">
                        <button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="MeatGrains"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" class="form-control quantity" value=0 data-input-category="MeatGrains">
                        <button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="MeatGrains"><i class="fa-solid fa-plus"></i></button>
                    </div></td>`;
            if (count > 0) {
                remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
            }
            html += '<td>' + remove + '</td>'
            tableBody.append(html);
            let select = tableBody.find('tr:last-child .product');
            populateMeatGrains(select);
        } else if (buttontype === '06') {
            html += '<tr>';
            html += '<td><select class="form-control product" data-product="Medicine"><option value="">Select Product</option></select></td>';
            html += `<td><div class="d-flex justify-content-center border">
                        <button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="Medicine"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" class="form-control quantity" value=0 data-input-category="Medicine">
                        <button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="Medicine"><i class="fa-solid fa-plus"></i></button>
                    </div></td>`;
            if (count > 0) {
                remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
            }
            html += '<td>' + remove + '</td>'
            tableBody.append(html);
            let select = tableBody.find('tr:last-child .product');
            populateMedicine(select);
        } else if (buttontype === '07') {
            html += '<tr>';
            html += '<td><select class="form-control product" data-product="Others"><option value="">Select Product</option></select></td>';
            html += `<td><div class="d-flex justify-content-center border">
                        <button type="button" class="btnMinus btn btn-sm btn-flat" data-btn-category="Others"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" class="form-control quantity" value=0 data-input-category="Others">
                        <button type="button" class="btnAdd btn btn-sm btn-flat" data-btn-category="Others"><i class="fa-solid fa-plus"></i></button>
                    </div></td>`;
            if (count > 0) {
                remove = '<button type="button" class="btn btn-danger remove btn-rounded"><i class="fa-solid fa-minus"></i></button>';
            }
            html += '<td>' + remove + '</td>'
            tableBody.append(html);
            let select = tableBody.find('tr:last-child .product');
            populateOthers(select);
        }
    }

    //Remove added table row
    $(document).on('click', '.remove', function() {
        $(this).closest('tr').remove();
    })


    //Append new Table
    $(document).on('click', '.addNewRow', function(e) {
        e.stopImmediatePropagation();
        let $this = $(this);
        let type = $this.data('btn-category');
        let tableBody = $('tbody[data-body-category="' + type + '"]');
        if ($this.hasClass('addNewRow')) {
            switch (type) {
                case 'CanNoodles':
                    count++;
                    appendNewProduct(tableBody, '01');
                    break;
                case 'Hygine':
                    count++;
                    appendNewProduct(tableBody, '02');
                    break;
                case 'InfantItems':
                    count++;
                    appendNewProduct(tableBody, '03');
                    break;
                case 'DrinkingWater':
                    count++;
                    appendNewProduct(tableBody, '04');
                    break;
                case 'MeatGrains':
                    count++;
                    appendNewProduct(tableBody, '05');
                    break;
                case 'Medicine':
                    count++;
                    appendNewProduct(tableBody, '06');
                    break;
                case 'Others':
                    count++;
                    appendNewProduct(tableBody, '07');
                    break;
            }
        }
    });


    // Populate product options for existing select elements
    let productSelects = $('.product');
    productSelects.each(function() {
        let product = $(this).data('product');
        switch (product) {
            case 'CanNoodles':
                populateCanNoodles($(this));
                break;
            case 'Hygine':
                populateHygineEssentials($(this));
                break;
            case 'InfantItems':
                populateInfantItems($(this));
                break;
            case 'DrinkingWater':
                populateDrinkingWater($(this));
                break;
            case 'MeatGrains':
                populateMeatGrains($(this));
                break;
            case 'Medicine':
                populateMedicine($(this));
                break;
            case 'Others':
                populateOthers($(this));
                break;
        }
    });


    //Add and minus quantity input fields
    $(document).on('click', '.btnAdd, .btnMinus', function(event) {
        event.stopImmediatePropagation(); // stop event propagation to prevent multiple triggers
        let $this = $(this);
        let $targetRow = $this.closest('tr');
        let type = $this.data('btn-category');
        let $quantity = $targetRow.find('.quantity[data-input-category="' + type + '"]');
        let value = parseInt($quantity.val()) || 0;

        if ($this.hasClass('btnAdd')) {
            value++;
        } else if (value > 0) {
            value--;
        }

        $quantity.val(value);
    });

    //Get data to each category field

    $(document).submit('#addToProcess', (e) => {
        e.preventDefault();
        let categoryFields = {
            'CanNoodles': {
                'product': [],
                'quantity': []
            },
            'Hygine': {
                'product': [],
                'quantity': []
            },
            'Infant': {
                'product': [],
                'quantity': []
            },
            'Drinks': {
                'product': [],
                'quantity': []
            },
            'MeatGrain': {
                'product': [],
                'quantity': []
            },
            'Medicine': {
                'product': [],
                'quantity': []
            },
            'Others': {
                'product': [],
                'quantity': []
            }
        }
        let isInvalid = false;

        //Push value of elements to objects array
        let selectedProducts = $('.product');
        let selectedProductsQuantity = $('.quantity');

        //Push to Product
        selectedProducts.each((index, element) => {
            let product = $(element).data('product');
            switch (product) {
                case 'CanNoodles':
                    categoryFields.CanNoodles.product.push($(element).val());
                    if ($(element).val() == "") {
                        $(element).addClass('is-invalid');
                        isInvalid = true;
                    } else {
                        $(element).removeClass('is-invalid');
                    }
                    break;
                case 'Hygine':
                    categoryFields.Hygine.product.push($(element).val());
                    if ($(element).val() == "") {
                        $(element).addClass('is-invalid');
                        isInvalid = true;
                    } else {
                        $(element).removeClass('is-invalid');
                    }
                    break;
                case 'InfantItems':
                    categoryFields.Infant.product.push($(element).val());
                    if ($(element).val() == "") {
                        $(element).addClass('is-invalid');
                        isInvalid = true;
                    } else {
                        $(element).removeClass('is-invalid');
                    }
                    break;
                case 'DrinkingWater':
                    categoryFields.Drinks.product.push($(element).val());
                    if ($(element).val() == "") {
                        $(element).addClass('is-invalid');
                        isInvalid = true;
                    } else {
                        $(element).removeClass('is-invalid');
                    }
                    break;
                case 'MeatGrains':
                    categoryFields.MeatGrain.product.push($(element).val());
                    if ($(element).val() == "") {
                        $(element).addClass('is-invalid');
                        isInvalid = true;
                    } else {
                        $(element).removeClass('is-invalid');
                    }
                    break;
                case 'Medicine':
                    categoryFields.Medicine.product.push($(element).val());
                    if ($(element).val() == "") {
                        $(element).addClass('is-invalid');
                        isInvalid = true;
                    } else {
                        $(element).removeClass('is-invalid');
                    }
                    break;
                case 'Others':
                    categoryFields.Others.product.push($(element).val());
                    if ($(element).val() == "") {
                        $(element).addClass('is-invalid');
                        isInvalid = true;
                    } else {
                        $(element).removeClass('is-invalid');
                    }
                    break;
            }

        });

        //Validation and push data for quantity
        selectedProductsQuantity.each((index, element) => {
            let quantity = $(element).data('input-category');
            switch (quantity) {
                case 'CanNoodles':
                    categoryFields.CanNoodles.quantity.push($(element).val());
                    if ($(element).val() <= 0) {
                        swal.fire({
                            title: 'Warning',
                            text: 'Please add quantity for the selected product',
                            icon: 'warning',
                            confirmButtonColor: '#20d070'
                        })
                        isInvalid = true;
                    }
                    break;
                case 'Hygine':
                    categoryFields.Hygine.quantity.push($(element).val());
                    if ($(element).val() <= 0) {
                        swal.fire({
                            title: 'Warning',
                            text: 'Please add quantity for the selected product',
                            icon: 'warning',
                            confirmButtonColor: '#20d070'
                        })
                        isInvalid = true;
                    }
                    break;
                case 'InfantItems':
                    categoryFields.Infant.quantity.push($(element).val());
                    if ($(element).val() <= 0) {
                        swal.fire({
                            title: 'Warning',
                            text: 'Please add quantity for the selected product',
                            icon: 'warning',
                            confirmButtonColor: '#20d070'
                        })
                        isInvalid = true;
                    }
                    break;
                case 'DrinkingWater':
                    categoryFields.Drinks.quantity.push($(element).val());
                    if ($(element).val() <= 0) {
                        swal.fire({
                            title: 'Warning',
                            text: 'Please add quantity for the selected product',
                            icon: 'warning',
                            confirmButtonColor: '#20d070'
                        })
                        isInvalid = true;
                    }
                    break;
                case 'MeatGrains':
                    categoryFields.MeatGrain.quantity.push($(element).val());
                    if ($(element).val() <= 0) {
                        swal.fire({
                            title: 'Warning',
                            text: 'Please add quantity for the selected product',
                            icon: 'warning',
                            confirmButtonColor: '#20d070'
                        })
                        isInvalid = true;
                    }
                    break;
                case 'Medicine':
                    categoryFields.Medicine.quantity.push($(element).val());
                    if ($(element).val() <= 0) {
                        swal.fire({
                            title: 'Warning',
                            text: 'Please add quantity for the selected product',
                            icon: 'warning',
                            confirmButtonColor: '#20d070'
                        })
                        isInvalid = true;
                    }
                    break;
                case 'Others':
                    categoryFields.Others.quantity.push($(element).val());
                    if ($(element).val() <= 0) {
                        swal.fire({
                            title: 'Warning',
                            text: 'Please add quantity for the selected product',
                            icon: 'warning',
                            confirmButtonColor: '#20d070'
                        })
                        isInvalid = true;
                    }
                    break;
            }
        });

        let request_id = $('#request_id').val();


        //save to data
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

        }

        //Check product if exist and compare input to quantity of the product
        const checkProductsIfExist = (categoryFields) => {
            for (const category in categoryFields) {
                if (categoryFields[category].product.length > 0) {
                    $.ajax({
                        url: '../include/getproduct.php',
                        method: 'GET',
                        dataType: 'json',
                        success: (response) => {
                            switch (category) {
                                case 'CanNoodles':
                                    const commonCanNoodles = categoryFields[category].product.map(productValue => {
                                        const index = response.CanNoodlesProduct.indexOf(productValue);
                                        return response.CanNoodlesQuantity[index];
                                    });
                                    for (let i = 0; i < categoryFields[category].quantity.length; i++) {
                                        $('.quantity[data-input-category="CanNoodles"]').each(function(i) {
                                            if (+categoryFields[category].quantity[i] > +commonCanNoodles[i]) {
                                                swal.fire({
                                                    title: 'Warning',
                                                    html: `<h5>We only have <strong>${commonCanNoodles[i]}</strong> available <strong>${categoryFields[category].product[i]}</strong> </h5>`,
                                                    icon: 'warning',
                                                    confirmButtonColor: '#20d070' //
                                                });
                                                isInvalid = true;
                                            }
                                        });
                                    }
                                    break;
                                case 'Hygine':
                                    const commonHygine = categoryFields[category].product.map(productValue => {
                                        const index = response.HygineEssentialProduct.indexOf(productValue);
                                        return response.HygineEssentialQuantity[index];
                                    });
                                    for (let i = 0; i < categoryFields[category].quantity.length; i++) {
                                        $('.quantity[data-input-category="Hygine"]').each(function(i) {
                                            if (+categoryFields[category].quantity[i] > +commonHygine[i]) {
                                                swal.fire({
                                                    title: 'Warning',
                                                    html: `<h5>We only have <strong>${commonHygine[i]}</strong> available <strong>${categoryFields[category].product[i]}</strong> </h5>`,
                                                    icon: 'warning',
                                                    confirmButtonColor: '#20d070' //
                                                });
                                                isInvalid = true;
                                            }
                                        });
                                    }
                                    break;
                                case 'Infant':
                                    const commonInfant = categoryFields[category].product.map(productValue => {
                                        const index = response.InfantItemsProduct.indexOf(productValue);
                                        return response.InfantItemsQuantity[index];
                                    });
                                    for (let i = 0; i < categoryFields[category].quantity.length; i++) {
                                        $('.quantity[data-input-category="InfantItems"]').each(function(i) {
                                            if (+categoryFields[category].quantity[i] > +commonInfant[i]) {
                                                swal.fire({
                                                    title: 'Warning',
                                                    html: `<h5>We only have <strong>${commonInfant[i]}</strong> available <strong>${categoryFields[category].product[i]}</strong> </h5>`,
                                                    icon: 'warning',
                                                    confirmButtonColor: '#20d070' //
                                                });
                                                isInvalid = true;
                                            }
                                        });
                                    }
                                    break;
                                case 'Drinks':
                                    const commonDrinks = categoryFields[category].product.map(productValue => {
                                        const index = response.DrinkingWaterProduct.indexOf(productValue);
                                        return response.DrinkingWaterQuantity[index];
                                    });
                                    for (let i = 0; i < categoryFields[category].quantity.length; i++) {
                                        $('.quantity[data-input-category="DrinkingWater"]').each(function(i) {
                                            if (+categoryFields[category].quantity[i] > +commonDrinks[i]) {
                                                swal.fire({
                                                    title: 'Warning',
                                                    html: `<h5>We only have <strong>${commonDrinks[i]}</strong> available <strong>${categoryFields[category].product[i]}</strong> </h5>`,
                                                    icon: 'warning',
                                                    confirmButtonColor: '#20d070' //
                                                });
                                                isInvalid = true;
                                            }
                                        });
                                    };
                                    break;
                                case 'MeatGrain':
                                    const commonMeatGrains = categoryFields[category].product.map(productValue => {
                                        const index = response.MeatGrainsProduct.indexOf(productValue);
                                        return response.MeatGrainsQuantity[index];
                                    });
                                    for (let i = 0; i < categoryFields[category].quantity.length; i++) {
                                        $('.quantity[data-input-category="MeatGrains"]').each(function(i) {
                                            if (+categoryFields[category].quantity[i] > +commonMeatGrains[i]) {
                                                swal.fire({
                                                    title: 'Warning',
                                                    html: `<h5>We only have <strong>${commonMeatGrains[i]}</strong> available <strong>${categoryFields[category].product[i]}</strong> </h5>`,
                                                    icon: 'warning',
                                                    confirmButtonColor: '#20d070' //
                                                });
                                                isInvalid = true;
                                            }
                                        });
                                    };
                                    break;
                                case 'Medicine':
                                    const commonMedicine = categoryFields[category].product.map(productValue => {
                                        const index = response.MedicineProduct.indexOf(productValue);
                                        return response.MedicineQuantity[index];
                                    });
                                    for (let i = 0; i < categoryFields[category].quantity.length; i++) {
                                        $('.quantity[data-input-category="Medicine"]').each(function(i) {
                                            if (+categoryFields[category].quantity[i] > +commonMedicine[i]) {
                                                swal.fire({
                                                    title: 'Warning',
                                                    html: `<h5>We only have <strong>${commonMedicine[i]}</strong> available <strong>${categoryFields[category].product[i]}</strong> </h5>`,
                                                    icon: 'warning',
                                                    confirmButtonColor: '#20d070' //
                                                });
                                                isInvalid = true;
                                            }
                                        });
                                    };
                                    break;
                                case 'Others':
                                    const commonOthers = categoryFields[category].product.map(productValue => {
                                        const index = response.OthersProduct.indexOf(productValue);
                                        return response.OthersQuantity[index];
                                    });
                                    for (let i = 0; i < categoryFields[category].quantity.length; i++) {
                                        $('.quantity[data-input-category="Others"]').each(function(i) {
                                            if (+categoryFields[category].quantity[i] > +commonOthers[i]) {
                                                swal.fire({
                                                    title: 'Warning',
                                                    html: `<h5>We only have <strong>${commonOthers[i]}</strong> available <strong>${categoryFields[category].product[i]}</strong> </h5>`,
                                                    icon: 'warning',
                                                    confirmButtonColor: '#20d070' //
                                                });
                                                isInvalid = true;
                                            }
                                        });
                                    };
                                    break;

                            }
                        },
                        error: () => {
                            console.log('Failed to get products data.');
                        }
                    });
                }
            }

            setTimeout(() => {
                if (!isInvalid) {
                    $.ajax({
                        url: 'include/ProcessRequest.php',
                        method: 'POST',
                        data: data,
                        beforeSend: () => {
                            $('button[type="submit"]').prop('disabled', true);
                            $('.submit-text').addClass('d-none');
                            $('.spinner-border').removeClass('d-none');
                        },
                        success: (data) => {
                            if (data == "success") {
                                setTimeout(() => {
                                    $('button[type="submit]"').prop("disabled", false);
                                    $('.submit-text').removeClass('d-none');
                                    $('.spinner-border').addClass('d-none');
                                    Swal.fire({
                                        title: 'Success',
                                        text: "Your request is created",
                                        icon: 'success',
                                        confirmButtonColor: '#20d070',
                                        confirmButtonText: 'OK',
                                        allowOutsideClick: false
                                    });
                                    setTimeout(() => {
                                        window.location.href="../Request.php";
                                    }, 1000)
                                }, 1500)
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data,
                                    icon: 'error',
                                    confirmButtonColor: '#20d070',
                                    confirmButtonText: 'OK',
                                    allowOutsideClick: false
                                });
                            }
                        },
                        error: (xhr, status, error) => {
                            Swal.fire({
                                title: 'Error',
                                text: xhr.responseText,
                                icon: 'error',
                                confirmButtonColor: '#20d070',
                                confirmButtonText: 'OK',
                                allowOutsideClick: false
                            })

                        }
                    });
                }
            }, 500)

        };

        checkProductsIfExist(categoryFields);
    })
    // End of button
});