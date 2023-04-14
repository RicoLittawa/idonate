$(document).ready(()=>{
      /**********Populate donors table */

    let table = $('#table_data').DataTable({
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        ajax: {
          url: 'include/DataForDataTables/donorsdata.php',
          error: function(xhr, error, thrown) {
            if (xhr.status === 404) {
              $('#table_data').html('<p>No data available</p>');
            } else {
              alert('There was an error retrieving data. Please try again.');
            }
          }
        },

        columns: [{
            data: null,
            render: function(data, type, row) {
              if (row.emailStatus === 'not sent') {
                return `<input type = "checkbox"
                name = "single_select"
                class = "single_select form-check-input"
                data-email = "${row.donorEmail}"
                data-name = "${row.donorName}"
                data-id = "${row.donorId}">`;
              } else {
                return `<a href="updatedonate.php?editdonate=${row.donorId}"><i class="fa-solid fa-pen-to-square text-success"></i></a>`;
              }
            }
          },
          {
            data: 'donorName'
          },
          {
            data: 'donorEmail',
          },
          {
            data: 'donorContact'
          },
          {
            data: 'donationDate'
          },
          {
            data: 'emailStatus',
            render: (data, type, row) => {
              return data !== 'not sent' ? '<span class="badge badge-success">Sent</span>' :
                `<button type="button" class="btn btn-secondary email_button col btn-rounded" name="email_button" data-id="${row.donorId}" 
              data-email="${row.donorEmail}" data-name="${row.donorName}"  data-action="single">Send</button>`;
            }
          },
          {
            data: 'certificate',
            render: (data, type, row) => {
              return data !== 'cert empty' ? `<button type="button" class="btn btn-secondary btn-rounded" data-donor-id="${row.donorId}" id="btnCert">
              <i class="fa-solid fa-print"></i></button>` :
                '<span class="badge badge-warning user-select-none not-allowed">N/A</span'
            }
          },
          {
            data: null,
            render: function(data, type, row) {
              return `<a href="#"><i class="fa-solid fa-trash text-danger"></i></a>`;
            }
          }

        ],
        order: [
          [3, 'desc']
        ],
        displayLength: 10,
        language: {
          "emptyTable": "No data available"
        }

      });

      // Custom search
      $("#customSearch").on("keyup", (event) => {
        table.search($(event.target).val()).draw();
      });

      //date filter

      $('#dateFilter').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        },
        autoUpdateInput: false
      }, function(start, end, label) {
        if (label === 'Today') {
          $('#dateLabel').html('Today');
        } else {
          if (start.format('MM/DD/YYYY') === end.format('MM/DD/YYYY')) {
            $('#dateLabel').html(start.format('MMMM Do YYYY'));
          } else {
            $('#dateLabel').html(start.format('MMMM Do YYYY') + ' - ' + end.format('MMMM Do YYYY'));
          }
        }
      });

      $('#dateFilter').on('apply.daterangepicker', function(ev, picker) {
        if (picker.chosenLabel === 'Today') {
          $('#dateLabel').html('Today');
        } else {
          if (picker.startDate.format('MM/DD/YYYY') === picker.endDate.format('MM/DD/YYYY')) {
            $('#dateLabel').html(picker.startDate.format('MMMM Do YYYY'));
          } else {
            $('#dateLabel').html(picker.startDate.format('MMMM Do YYYY') + ' - ' + picker.endDate.format('MMMM Do YYYY'));
          }
        }
      });

      $('#dateFilter').on('cancel.daterangepicker', function(ev, picker) {
        $('#dateFilter').html('<span id="dateLabel">Date</span><i id="dateIcon" class="fa fa-caret-down me-2"></i>');

      });


      $('#dateFilter').on('click', function() {
        $('#dateIcon').toggleClass('up');
      });



 /**********Send certificate through email */

    $(document).on('click','.email_button', (event)=>{        
        const $this = $(event.target);
        let action = $this.data("action");
        let email_data = [];
    
    
        if (action == 'single') {
          email_data.push({
            email: $this.data("email"),
            name: $this.data("name"),
            uID: $this.data('id'),
          });
          $('#bulk_email').attr('disabled', true);
        } else {
          let $checkedBoxes = $('.single_select:checked');
          if ($checkedBoxes.length === 0) {
            $this.attr('disabled', true);
            return;
          }
    
          $checkedBoxes.each((index,element)=>  {
            const $this = $(element);
            email_data.push({
              email: $this.data("email"),
              name: $this.data('name'),
              uID: $this.data('id'),
            });
          });
        }
    
        $.ajax({
          url: "include/sendcerti.php",
          method: "POST",
          data: {
            email_data: email_data
          },
          beforeSend: function() {
            $this.attr('disabled', true);
            $this.html('Sending...');
            $this.addClass('btn btn-outline-danger');
          },
          success: function(data) {
           
            if (data == 'Inserted') {
                $this.attr('disabled', false);
                $this.removeClass('btn btn-outline-danger');
                $this.addClass('btn btn-outline-success');
                $this.html('Sent');
              Swal.fire({
                icon: 'success',
                title: 'Sent',
                text: 'Email has been sent',
                timer: 1500,

              })
                table.ajax.reload();
            } else {
              $this.text(data);
            }
          }
        });
    
      });
})