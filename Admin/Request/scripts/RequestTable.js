$(document).ready(() => {
    $(document).on('click', '#acceptBtn', (event) => {
      let requestId = $(event.target).attr('data-request');
      window.location.href = "RecieveRequest.php?requestId=" + requestId;
    });
    $(document).on('click', '#viewReceiptBtn', (event) => {
      let viewReciept = $(event.target).attr('data-request');
      window.location.href = "ViewRequestReceipt.php?requestId=" + viewReciept;
    });
    $('.closeModal').click(() => {
      $('#exampleModal').modal('hide');
      $('.main-content').removeClass('blur-filter-class');
      $('.sidebar').removeClass('blur-filter-class');
    });
    //Populate datatables
    let table = $('#table_data').DataTable({
      responsive: true,
      ajax: 'include/RequestDataForDataTables.php',
      columns: [{
          data: 'reference',
          render: (data, type, row) => {
            return row.dateTrimmed + "-00" + row.reference
          }
        },
        {
          data: 'Fullname',
          render: (data, type, row) => {
            return row.firstname + " " + row.lastname
          }
        },

        {
          data: 'position'
        },
        {
          data: 'evacuees_qty'
        },
        {
          data: 'requestdate'
        },
        {
          data: 'receivedate',
          render: (data, type, row) => {
            return data === null ? `<span class="badge badge-danger user-select-none not-allowed">N/A</span>` : data;
          },
        },

        {
          data: 'status',
          render: (data, type, row) => {
            if (data === 'Request was processed') {
              return `<span style="cursor:pointer;" class="badge badge-info" data-status="${row.status}" data-request=${row.reference} onclick="changeStatus(this)">${data}</span>`
            } else if (data === 'Ready for Pick-up') {
              return `<span style="cursor:pointer;" class="badge badge-warning" data-status="${row.status}" data-request=${row.reference} onclick="changeStatus(this)">${data}</span>`
            } else if (data === 'Request completed') {
              return `<span class="badge badge-success user-select-none not-allowed">${data}</span>`
            } else {
              return `<span class="badge badge-danger user-select-none not-allowed">${data}</span>`

            }
          }
        },

        {
          data: 'reference',
          render: function(data, type, row) {
            if (row.status === 'pending') {
              return `<button type="button" id="acceptBtn" data-request=${row.reference} class="btn btn-success btn-rounded">Accept</button>`;
            } else {
              return `<button type="button" id="viewReceiptBtn" data-request=${row.reference} class="btn btn-success btn-rounded">View</button>`;
            }
          }
        }
      ],
      order: [
        [0, 'desc']
      ],
      displayLength: 10,

    });
    //Update Status
    $('#saveStatus').click(() => {
      let reference = $('#reference').val();
      let selectStatus = $('#selectStatus').val();
      $.ajax({
        url: 'include/UpdateRequestStatus.php',
        method: 'POST',
        data: {
          saveStatus: '',
          reference: reference,
          selectStatus: selectStatus
        },
        success: (data) => {
          console.log(data);
        }
      });
    })

  })

  const changeStatus = (element) => {
    let reference = $(element).data('request');
    let status = $(element).data('status');
    $('#exampleModal').modal('show');
    $('.main-content').addClass('blur-filter-class');
    $('.sidebar').addClass('blur-filter-class');
    $('#reference').val(reference);
    $('#selectStatus option[value="' + status + '"]').prop('selected', true);
    $('#selectStatus').find(':selected').text(status);
  };